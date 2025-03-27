// app/Http/Controllers/PlantroomController.php
<?php

namespace App\Http\Controllers;

use App\Models\PlantroomList;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlantroomController extends Controller
{
    public function create($clientID)
    {
        $companyName = Client::where('client_id', $clientID)->first('company_name');
        return view('plantroom.create', compact('clientID', 'companyName'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|string',
            'plantroom_name' => 'required|string|max:255',
            'plantroom_type' => 'required|string|max:255',
            'filters' => 'required|numeric',
            'strainers' => 'required|numeric',
            'cl_injector' => 'required|string|max:255',
            'ph_injector' => 'required|string|max:255',
            'pac_injector' => 'required|string|max:255',
            'info' => 'string|max:255'
        ]);

        $plantroom = new PlantroomList;
        $plantroom->plantroom_id = Str::ulid(); // Generate ULID
        $plantroom->fill($validatedData);
        $plantroom->save();

        return redirect()->back()->with('success', 'Plantroom added successfully.');
    }

    public function getPlantroomMenu(Request $request)
    {
        $clientId = $request->query('client_id');

        $plantrooms = PlantroomList::when($clientId, fn($query) => $query->where('client_id', $clientId))
            ->select('plantroom_id', 'plantroom_name')
            ->orderBy('plantroom_name')
            ->get();

        return view('partials.plantroom-menu', compact('plantrooms'));
    }
}