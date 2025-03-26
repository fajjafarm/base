<?php

namespace App\Http\Controllers;

use App\Models\TemperatureCheck;
use Illuminate\Http\Request;

class TemperatureCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temperatureChecks = DB::select('select * from teperature_checks');
        return view('temperatureChecks.index', compact('temperatureChecks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('temperatureChecks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'temperature' => 'required|numeric',
            'checked_by' => 'required|string|max:50',
        ]);

        TemperatureCheck::create($request->all());

        return redirect()->route('temperatureChecks.index')
                         ->with('success','Temperature Check created successfully.');
    }

    // Add other CRUD methods (show, edit, update, destroy) as needed
}