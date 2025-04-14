<?php

namespace App\Http\Controllers;

use App\Models\WaterMeter;
use App\Models\WaterMeterReading;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WaterMeterReadingController extends Controller
{
    public function index(Request $request, $water_meter_id = null)
    {
        $waterMeters = WaterMeter::select(['water_meter_id', 'location'])->get();
        $waterMeter = $water_meter_id ? WaterMeter::findOrFail($water_meter_id) : null;
        $readings = $waterMeter ? $waterMeter->readings()->orderBy('reading_date', 'asc')->get() : collect();

        $chartData = [];
        if ($waterMeter) {
            // Group readings by date to aggregate same-day readings
            $dailyReadings = $readings->groupBy(fn($reading) => Carbon::parse($reading->reading_date)->format('Y-m-d'));

            $previousValue = null;
            $previousDate = null;

            foreach ($dailyReadings as $date => $dayReadings) {
                // Use the latest reading of the day (highest reading_value)
                $reading = $dayReadings->sortByDesc('reading_date')->first();
                $currentValue = floatval($reading->reading_value);

                if ($previousValue !== null) {
                    $usage = $currentValue - $previousValue;
                    if ($usage >= 0) {
                        $daysDiff = Carbon::parse($date)->diffInDays($previousDate);
                        $dailyUsage = $daysDiff > 0 ? $usage / $daysDiff : $usage;
                        $chartData[] = [
                            'date' => $date,
                            'usage' => round($dailyUsage, 2),
                        ];
                    }
                }

                $previousValue = $currentValue;
                $previousDate = $date;
            }
        }

        // Reverse readings for table display (newest first)
        $readings = $readings->sortByDesc('reading_date');

        return view('water-meter.readings.index', compact('waterMeter', 'waterMeters', 'readings', 'chartData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'water_meter_id' => 'required|exists:water_meters,water_meter_id',
            'reading_value' => 'required|numeric|min:0',
            'reading_date' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        WaterMeterReading::create([
            'water_meter_id' => $validated['water_meter_id'],
            'reading_value' => $validated['reading_value'],
            'reading_date' => $validated['reading_date'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('water-meter.readings.index', $validated['water_meter_id'])
            ->with('success', 'Reading added successfully.');
    }
}