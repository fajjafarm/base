<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\ThermalSuite;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuperAdminThermalSuiteController extends SuperAdminController
{
    public function create()
    {
        $clients = Client::all(['client_id', 'company_name']);
        return view('superadmin.thermal_suite.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'thermal_name' => 'required|string|max:255',
            'thermal_type' => 'required|string|max:255',
            'sauna_temp' => 'required|numeric',
            'steamroom_temp' => 'required|numeric',
            'lounger_temp' => 'required|numeric',
            'check_interval' => 'required|integer',
            'notes' => 'nullable|string|max:1000',
        ]);

        ThermalSuite::create([
            'id' => Str::ulid(),
            'client_id' => $validated['client_id'],
            'thermal_name' => $validated['thermal_name'],
            'thermal_type' => $validated['thermal_type'],
            'sauna_temp' => $validated['sauna_temp'],
            'steamroom_temp' => $validated['steamroom_temp'],
            'lounger_temp' => $validated['lounger_temp'],
            'check_interval' => $validated['check_interval'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('superadmin.dashboard')->with('success', 'Thermal suite added successfully.');
    }
}