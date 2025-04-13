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
        // If no water_meter_id, fetch all meters for dropdown
        $waterMeters = WaterMeter::all(['id', 'location']);
        $waterMeter = $water_meter_id ? WaterMeter::findOrFail($water_meter_id) : null;
        $readings = $waterMeter ? $waterMeter->readings()->orderBy('reading_date', 'desc')->get() : collect();

        // Calculate daily usage for chart
        $chartData = [];
        if ($waterMeter) {
            $previousReading = null;
            foreach ($readings as $index => $reading) {
                if ($previousReading) {
                    $daysDiff = Carbon::parse($reading->reading_date)->diffInDays($previousReading->reading_date);
                    $usage = $previousReading->reading_value - $reading->reading_value;

                    if ($usage < 0) {
                        // Skip negative usage (possible meter reset)
                        continue;
                    }

                    $dailyUsage = $daysDiff > 0 ? $usage / $daysDiff : $usage;
                    $chartData[] = [
                        'date' => Carbon::parse($reading->reading_date)->format('Y-m-d'),
                        'usage' => round($dailyUsage, 2),
                    ];
                }
                $previousReading = $reading;
            }
            // Reverse for chronological order
            $chartData = array_reverse($chartData);
        }

        return view('water-meter.readings.index', compact('waterMeter', 'waterMeters', 'readings', 'chartData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'water_meter_id' => 'required|exists:water_meters,id',
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