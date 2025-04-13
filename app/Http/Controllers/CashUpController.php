<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\CashUp;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CashUpController extends Controller
{
    /**
     * Display the cash-up form with expected takings from Trybe playground API.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch expected takings from Trybe playground API
        $expectedTakings = $this->fetchTrybeTakings();

        // Fallback data if API fails
        if (empty($expectedTakings)) {
            $expectedTakings = [
                'Juice Bar' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
                'Hotel Leisure' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
                'Playbarn' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
                'Spa Leisure' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
            ];
            Log::warning('Trybe playground API returned no data; using fallback values.');
        }

        return view('cash_up.cash_up', compact('expectedTakings'));
    }

    /**
     * Handle cash-up form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'denominations' => 'required|array',
            'denominations.*' => 'array',
            'denominations.*.*.quantity' => 'nullable|integer|min:0',
            'denominations.*.*.total' => 'nullable|numeric|min:0',
            'totals' => 'required|array',
            'totals.*.cash' => 'nullable|numeric|min:0',
            'totals.*.pdq' => 'nullable|numeric|min:0',
            'totals.*.amex' => 'nullable|numeric|min:0',
            'readings' => 'required|array',
            'readings.*.x' => 'nullable|numeric|min:0',
            'readings.*.z' => 'nullable|numeric|min:0',
        ]);

        // Fetch expected takings again for storage
        $expectedTakings = $this->fetchTrybeTakings();

        // Process and store data for each department
        foreach (['Juice Bar', 'Hotel Leisure', 'Playbarn', 'Spa Leisure'] as $department) {
            CashUp::create([
                'id' => (string) Str::ulid(),
                'date' => Carbon::today(),
                'department' => $department,
                'denominations' => $validated['denominations'][$department] ?? [],
                'cash_total' => $validated['totals'][$department]['cash'] ?? 0,
                'pdq_total' => $validated['totals'][$department]['pdq'] ?? 0,
                'amex_total' => $validated['totals'][$department]['amex'] ?? 0,
                'x_reading' => $validated['readings'][$department]['x'] ?? 0,
                'z_reading' => $validated['readings'][$department]['z'] ?? 0,
                'expected_takings' => $expectedTakings[$department] ?? ['cash' => 0, 'pdq' => 0, 'amex' => 0],
            ]);
        }

        return redirect()->route('cash-up.index')->with('success', 'Cash-up submitted successfully.');
    }

    /**
     * Fetch expected takings from Trybe playground API.
     *
     * @return array
     */
    protected function fetchTrybeTakings()
    {
        try {
            $siteId = config('services.trybe.playground_site_id');
            if (!$siteId) {
                Log::error('Trybe playground site_id not configured.');
                return [];
            }

            $response = Http::withHeaders([
                'X-API-Key' => config('services.trybe.playground_api_key'),
                'Accept' => 'application/json',
            ])->get('https://api.playground.try.be/shop/ledger_lines', [
                'site_id' => $siteId,
                'ledger_date' => Carbon::today()->format('Y-m-d'),
                'revenue_centre' => ['juice_bar', 'hotel_leisure', 'playbarn', 'spa_leisure'],
                'payment_processor' => ['manual', 'stripe', 'adyen'],
                'type' => 'charge',
            ]);

            if ($response->successful()) {
                $ledgerLines = $response->json();

                // Map revenue centres to departments and payment processors to payment types
                $takings = [
                    'Juice Bar' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
                    'Hotel Leisure' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
                    'Playbarn' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
                    'Spa Leisure' => ['cash' => 0.00, 'pdq' => 0.00, 'amex' => 0.00],
                ];

                $revenueCentreMap = [
                    'juice_bar' => 'Juice Bar',
                    'hotel_leisure' => 'Hotel Leisure',
                    'playbarn' => 'Playbarn',
                    'spa_leisure' => 'Spa Leisure',
                ];

                foreach ($ledgerLines as $line) {
                    $revenueCentre = $line['revenue_centre'] ?? null;
                    $paymentProcessor = $line['payment_processor'] ?? null;
                    $grossAmount = ($line['gross_amount'] ?? 0) / 100; // Convert from pence to pounds

                    // Skip if revenue centre or payment processor is missing or unmapped
                    if (!isset($revenueCentreMap[$revenueCentre])) {
                        continue;
                    }

                    $department = $revenueCentreMap[$revenueCentre];

                    // Map payment processor to payment type
                    if ($paymentProcessor === 'manual' && ($line['payment_processor_friendly'] ?? '') === 'Manual (Cash)') {
                        $takings[$department]['cash'] += $grossAmount;
                    } elseif (in_array($paymentProcessor, ['stripe', 'adyen'])) {
                        // Check for Amex (assume card_brand indicates Amex)
                        if (isset($line['card_brand']) && $line['card_brand'] === 'amex') {
                            $takings[$department]['amex'] += $grossAmount;
                        } else {
                            $takings[$department]['pdq'] += $grossAmount;
                        }
                    }
                }

                // Round to 2 decimal places
                foreach ($takings as $dept => $types) {
                    foreach ($types as $type => $amount) {
                        $takings[$dept][$type] = round($amount, 2);
                    }
                }

                return $takings;
            }

            Log::error('Trybe playground API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        } catch (\Exception $e) {
            Log::error('Trybe playground API exception: ' . $e->getMessage());
            return [];
        }
    }
}