<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\PlantroomList;
use App\Models\PlantroomComponent;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlantroomController extends SuperAdminController
{
    public function create()
    {
        $clients = Client::all(['client_id', 'company_name']);
        return view('superadmin.plantroom.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'plantroom_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $plantroom = PlantroomList::create([
            'plantroom_id' => Str::ulid(),
            'client_id' => $validated['client_id'],
            'plantroom_name' => $validated['plantroom_name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('superadmin.plantroom.components.create', $plantroom->plantroom_id)
            ->with('success', 'Plantroom created. Now add components.');
    }
}