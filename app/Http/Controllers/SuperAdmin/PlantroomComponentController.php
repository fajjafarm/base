<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\PlantroomList;
use App\Models\PlantroomComponent;
use Illuminate\Http\Request;

class PlantroomComponentController extends SuperAdminController
{
    public function create($plantroom_id)
    {
        $plantroom = PlantroomList::findOrFail($plantroom_id);
        return view('superadmin.plantroom.components.create', compact('plantroom'));
    }

    public function store(Request $request, $plantroom_id)
    {
        $validated = $request->validate([
            'components' => 'required|array',
            'components.*.type' => 'required|in:filter,strainer,cl_injector,ph_injector,pac_injector,pump',
            'components.*.number' => 'required|integer|min:1',
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

        return redirect()->route('superadmin.dashboard')->with('success', 'Components added successfully.');
    }
}