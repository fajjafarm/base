<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\PlantroomList;
use App\Models\PlantroomComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperAdminPlantroomComponentController extends SuperAdminController
{
    public function create($plantroom_id)
    {
        $plantroom = PlantroomList::findOrFail($plantroom_id);
        return view('superadmin.plantroom.components.create', compact('plantroom'));
    }

    public function storeCounts(Request $request, $plantroom_id)
    {
        $validated = $request->validate([
            'counts.filter' => 'required|integer|min:0',
            'counts.strainer' => 'required|integer|min:0',
            'counts.cl_injector' => 'required|integer|min:0',
            'counts.ph_injector' => 'required|integer|min:0',
            'counts.pac_injector' => 'required|integer|min:0',
            'counts.pump' => 'required|integer|min:0',
        ]);

        // Store counts in session for the details form
        Session::put("component_counts_{$plantroom_id}", $validated['counts']);

        return redirect()->route('superadmin.plantroom.components.details', $plantroom_id);
    }

    public function details($plantroom_id)
    {
        $plantroom = PlantroomList::findOrFail($plantroom_id);
        $counts = Session::get("component_counts_{$plantroom_id}");

        if (!$counts) {
            return redirect()->route('superadmin.plantroom.components.create', $plantroom_id)
                ->with('error', 'Please specify component counts first.');
        }

        return view('superadmin.plantroom.components.details', compact('plantroom', 'counts'));
    }

    public function store(Request $request, $plantroom_id)
    {
        $validated = $request->validate([
            'components' => 'required|array|min:1',
            'components.*.type' => 'required|in:filter,strainer,cl_injector,ph_injector,pac_injector,pump',
            'components.*.number' => 'required|string|max:255', // Changed to string to allow names
            'components.*.description' => 'nullable|string|max:255',
        ]);

        foreach ($validated['components'] as $component) {
            PlantroomComponent::create([
                'plantroom_id' => $plantroom_id,
                'component_type' => $component['type'],
                'component_number' => $component['number'],
                'description' => $component['description'],
            ]);
        }

        // Clear session counts after saving
        Session::forget("component_counts_{$plantroom_id}");

        return redirect()->route('superadmin.dashboard')->with('success', 'Components added successfully.');
    }
}