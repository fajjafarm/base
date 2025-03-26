<?php

namespace App\Http\Controllers;

use App\Models\ThermalSuite;
use App\Models\ThermalSuiteCheck;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ThermalSuiteCheckController extends Controller
{
    public function create($thermal_suite_id)
    {
        $thermalSuite = ThermalSuite::findOrFail($thermal_suite_id);
        
        $lastCheck = $thermalSuite->lastCheck();
        $timeSinceLastCheck = $lastCheck 
            ? Carbon::parse($lastCheck->checked_at)->diffForHumans()
            : 'No previous checks recorded';
// Add paginated checks
$checks = $thermalSuite->checks()
->orderBy('checked_at', 'desc')
->paginate(20); 

return view('thermal_suite_checks.create', compact(
'thermalSuite', 
'timeSinceLastCheck',
'checks'
));
        //return view('thermal_suite_checks.create', compact('thermalSuite', 'timeSinceLastCheck'));
    }

    public function store(Request $request, $thermal_suite_id)
    {
        $validated = $request->validate([
            'status' => 'required|in:occupied_okay,occupied_issue,empty_okay,empty_issue',
            'extra_info' => 'nullable|string'
        ]);

        ThermalSuiteCheck::create([
            'thermal_suite_id' => $thermal_suite_id,
            'user_id' => auth()->id(),
            'status' => $validated['status'],
            'extra_info' => $validated['extra_info'],
        ]);

        return redirect()->back()
            ->with('success', 'Check recorded successfully');
    }
}