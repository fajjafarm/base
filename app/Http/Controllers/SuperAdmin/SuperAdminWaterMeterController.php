<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\WaterMeter;
use App\Models\PlantroomList;
use Illuminate\Http\Request;

class SuperAdminWaterMeterController extends SuperAdminController
{
    public function create()
    {
        $plantrooms = PlantroomList::all(['plantroom_id', 'plantroom_name']);
        return view('superadmin.water_meter.create', compact('plantrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plantroom_id' => 'nullable|exists:plantroom_list,plantroom_id',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        WaterMeter::create($validated);

        return redirect()->route('superadmin.dashboard')->with('success', 'Water meter location added successfully.');
    }
}