<?php
namespace App\Http\Controllers;

use App\Models\PoolList;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PoolController extends Controller
{
    public function create($clientID)
    {
        $companyName = Client::where('client_id', $clientID)->first('company_name');
        return view('pools.create',compact('clientID','companyName'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|string',
            'pool_name' => 'required|string|max:255',
            'pool_type' => 'required|string|max:255',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'depth' => 'required|numeric',
            'volume' => 'required|numeric',
            'ideal_dpd1' => 'required|numeric',
            'ideal_ph' => 'required|numeric',
            'ideal_alk' => 'required|numeric',
            'ideal_calc' => 'required|numeric',
            'ideal_water_temp' => 'required|numeric',
            'ideal_air_temp' => 'required|numeric',
        ]);

        $pool = new PoolList;
        $pool->pool_id = Str::ulid(); // Generate ULID
        $pool->fill($validatedData);
        $pool->save();

        return redirect()->back()->with('success', 'Pool added successfully.');
    }
}