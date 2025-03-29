<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\PoolList;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PoolController extends SuperAdminController
{
    public function create()
    {
        $clients = Client::all(['client_id', 'company_name']);
        return view('superadmin.pool.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'pool_name' => 'required|string|max:255',
        ]);

        PoolList::create([
            'id' => Str::ulid(),
            'client_id' => $validated['client_id'],
            'pool_name' => $validated['pool_name'],
        ]);

        return redirect()->route('superadmin.dashboard')->with('success', 'Pool added successfully.');
    }
}