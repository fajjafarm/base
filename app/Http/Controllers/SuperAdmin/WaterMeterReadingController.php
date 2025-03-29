<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\WaterMeterReading;
use App\Models\PlantroomList;
use Illuminate\Http\Request;

class WaterMeterReadingController extends SuperAdminController
{
    public function create()
    {
        $plantrooms = PlantroomList::all(['plantroom_id', 'plantroom_name']);
        return view('superadmin.water_meter.create', compact('plantrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plantroom_id' => 'required|exists:plantroom_list,plantroom_id',
            'reading' => 'required|numeric',
            'recorded_at' => 'required|date',
        ]);

        WaterMeterReading::create($validated);

        return redirect()->route('superadmin.dashboard')->with('success', 'Water meter reading added successfully.');
    }
}