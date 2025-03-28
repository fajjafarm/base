<?php

namespace App\Http\Controllers;

use App\Models\PlantroomList;
use App\Models\PlantroomComponent;
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
            'description' => 'nullable|string|max:1000',
            'filters' => 'required|array|max:10',
            'filters.*' => 'nullable|string|max:255',
            'strainers' => 'required|array|max:10',
            'strainers.*' => 'nullable|string|max:255',
            'cl_injectors' => 'required|array',
            'cl_injectors.*' => 'nullable|string|max:255',
            'ph_injectors' => 'required|array',
            'ph_injectors.*' => 'nullable|string|max:255',
            'pac_injectors' => 'required|array',
            'pac_injectors.*' => 'nullable|string|max:255',
        ]);

        $plantroom = new PlantroomList;
        $plantroom->plantroom_id = Str::ulid();
        $plantroom->client_id = $validatedData['client_id'];
        $plantroom->plantroom_name = $validatedData['plantroom_name'];
        $plantroom->description = $validatedData['description'];
        $plantroom->save();

        // Save components
        foreach (['filters' => 'filter', 'strainers' => 'strainer', 'cl_injectors' => 'cl_injector', 
                  'ph_injectors' => 'ph_injector', 'pac_injectors' => 'pac_injector'] as $input => $type) {
            foreach ($validatedData[$input] as $number => $desc) {
                if ($desc) {
                    PlantroomComponent::create([
                        'plantroom_id' => $plantroom->plantroom_id,
                        'component_type' => $type,
                        'component_number' => $number + 1,
                        'description' => $desc,
                    ]);
                }
            }
        }

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