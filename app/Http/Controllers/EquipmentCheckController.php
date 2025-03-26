<?php

namespace App\Http\Controllers;

use App\Models\EmergencyEquipmentCheck;
use Illuminate\Http\Request;

class EquipmentCheckController extends Controller
{
    public function index()
    {
        $equipmentTypes = [
            'Torpedo Buoy', 'Rope', 'Reach Poles', 'Defib', 'Mask', 
            'Goggles', 'Gloves', 'Apron', 'Drench Shower', 'Eye Wash', 'First Aid Stock', 'First Aid Grab Bag'
        ];
        
        
        $equipmentLocations = [
            'Spa Pool', 'Hotel Pool', 'Hot Tub', 'Spa Pool Plantroom', 'Hotel Pool Plantroom', 
            'Hot Tub Plantroom'
        ];
        
        return view('equipment-check', compact('equipmentLocations', 'equipmentTypes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'equipment_type' => 'required',
            'equipment_location' => 'required',
            'condition' => 'required',
            'comments' => 'nullable|string'
        ]);

        $equipmentCheck = new EmergencyEquipmentCheck([
            'equipment_type' => $request->input('equipment_type'),
            'equipment_location' => $request->input('equipment_location'),
            'condition' => $request->input('condition'),
            'comments' => $request->input('comments')              
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Water balance test submitted successfully.',
            'data' => $equipmentCheck
        ]);
        $equipmentCheck->save();

        $validatedData->save();
    EmergencyEquipmentCheck::create($validatedData);
        
        return redirect()->back()->with('success', 'Equipment check recorded successfully!');
    }
}