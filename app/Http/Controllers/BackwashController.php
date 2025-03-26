<?php

namespace App\Http\Controllers;
use App\Models\PoolList;
use App\Models\Backwash;
use Illuminate\Http\Request;

class BackwashController extends Controller
{
    public function index($poolID)
    {
     //   if (isset($poolID)) {
        $backwashes = Backwash::where('pool_id', $poolID)->orderBy('created_at', 'desc')->get();
       // $poolName = PoolList::where('pool_name', $poolID)->get();
       $poolID=$poolID;
        $poolName = PoolList::where('pool_id', $poolID)->value('pool_name');
        return view('backwashes.index', compact('backwashes','poolID','poolName'));
       // }else {
      //  $backwashes = Backwash::all();
      //  return view('backwashes.index', compact('backwashes'));
      //  }
        
    }

    public function create($poolID)
    {
        $backwashTypes = [
            'Scheduled','Corrective Action', 'Code Brown', 'Service'
        ];
        $backwashTypes = [
            'Scheduled','Corrective Action', 'Code Brown', 'Service'
        ];
        $pumpStatus = [
            'Running','Off - Standby', 'Off - Maintenance'
        ];
        $poolID = $poolID;
        $poolName = PoolList::where('pool_id', $poolID)->value('pool_name');
        $backwashes = Backwash::all();
        return view('backwashes.create', compact('backwashes', 'backwashTypes', 'pumpStatus','poolID', 'poolName'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pool_id' => 'required|exists:pool_list,pool_id',
            'filter1_before_pressure' => 'nullable|numeric',
            'filter1_after_pressure' => 'nullable|numeric',
            'filter1_backwashed' => 'boolean',
            'basket1_cleaned' => 'boolean',
            'filter2_before_pressure' => 'nullable|numeric',
            'filter2_after_pressure' => 'nullable|numeric',
            'filter2_backwashed' => 'boolean',
            'basket2_cleaned' => 'boolean',
            'filter3_before_pressure' => 'nullable|numeric',
            'filter3_after_pressure' => 'nullable|numeric',
            'filter3_backwashed' => 'boolean',
            'basket3_cleaned' => 'boolean',
            'reason_for_backwash' => 'required|string',
            'pump1_status' => 'required|string',
            'pump2_status' => 'required|string',
            'pump3_status' => 'required|string',
            'issues' => 'nullable|string'
        ]);

        Backwash::create($validatedData+ ['performed_by' => auth()->id()]);

        return redirect()->back()->with('success', 'Backwash record created successfully.');
    }
}