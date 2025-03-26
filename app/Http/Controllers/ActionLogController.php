<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActionLog;

class ActionLogController extends Controller
{
    /**
     * Display a form to log an action for an out-of-range test.
     *
     * @param  int  $testId
     * @return \Illuminate\View\View
     */
    public function create($testId)
    {
        $actionTypes = [
            'Pool Test - error','Pool Test - warning', 'Equipment Check Query', 'PPE Query', 'Maintenance Query', 'Cleaning', 
            'Temperature - Low','Temperature - High', 'Water Balance - Corrosive','Water Balance - Sacle forming', 'Training', 'Servicing', 'Eye Wash', 'First Aid Stock', 'First Aid Grab Bag'
        ];
        $escalationTypes = [
            'Double Checked - No further action needed', 'Raised to Supervisor/Manager', 'Reported to Duty Manager', 'Reported to Maintenance', 'Training', 'Schedule External Servicing'
        ];
        $progressTypes = [
            'Not Started', 'In Progress', 'Unable to Complete', 'Complete'
        ];
        $logged_by = auth()->id();
        return view('actionlog.create', compact('testId', 'actionTypes','escalationTypes','progressTypes','logged_by'));
    }

    /**
     * Store the newly created action log in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    
    {
        $request->validate([
            'action_type' => 'required|string',
            'escalation' => 'nullable|string',
            'logged_by' => 'nullable|string',
            'progress' => 'nullable|string',
            'comments' => 'nullable|string'
             ]);

        ActionLog::create($request->all()+ ['logged_by' => auth()->id()]);

        return redirect()->route('actionlog.create', ['testId' => $request->test_id])->with('success', 'Action logged successfully!');
    }
}