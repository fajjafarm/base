<?php

namespace App\Http\Controllers;

use App\Models\PlantroomList;
use App\Models\PlantroomComponent;
use App\Models\BackwashLog;
use Illuminate\Http\Request;

class BackwashLogController extends Controller
{
    public function create($plantroom_id)
    {
        $plantroom = PlantroomList::with('components')->findOrFail($plantroom_id);
        $reasons = ['Scheduled', 'High Pressure', 'Water Clarity', 'Water Balance', 'Maintenance', 'Code Brown'];
        $strainerActions = ['cleaned', 'changed', 'nothing'];
        $injectorActions = ['checked', 'cleaned', 'changed', 'nothing'];

        return view('backwash.create', compact('plantroom', 'reasons', 'strainerActions', 'injectorActions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plantroom_id' => 'required|exists:plantroom_list,plantroom_id',
            'reason' => 'required|in:Scheduled,High Pressure,Water Clarity,Water Balance,Maintenance,Code Brown',
            'notes' => 'nullable|string|max:1000',
            'filters' => 'nullable|array',
            'filters.*.component_id' => 'required_with:filters.*.pressure_before|exists:plantroom_components,id',
            'filters.*.pressure_before' => 'nullable|numeric',
            'filters.*.pressure_after' => 'nullable|numeric',
            'strainers' => 'nullable|array',
            'strainers.*.component_id' => 'required_with:strainers.*.action|exists:plantroom_components,id',
            'strainers.*.action' => 'nullable|in:cleaned,changed,nothing',
            'injectors' => 'nullable|array',
            'injectors.*.component_id' => 'required_with:injectors.*.action|exists:plantroom_components,id',
            'injectors.*.action' => 'nullable|in:checked,cleaned,changed,nothing',
        ]);

        // Log each component action
        if (isset($validated['filters'])) {
            foreach ($validated['filters'] as $filter) {
                if ($filter['pressure_before'] || $filter['pressure_after']) {
                    BackwashLog::create([
                        'plantroom_id' => $validated['plantroom_id'],
                        'component_id' => $filter['component_id'],
                        'reason' => $validated['reason'],
                        'pressure_before' => $filter['pressure_before'],
                        'pressure_after' => $filter['pressure_after'],
                        'user_id' => auth()->id(),
                        'notes' => $validated['notes'],
                    ]);
                }
            }
        }

        if (isset($validated['strainers'])) {
            foreach ($validated['strainers'] as $strainer) {
                if ($strainer['action'] && $strainer['action'] !== 'nothing') {
                    BackwashLog::create([
                        'plantroom_id' => $validated['plantroom_id'],
                        'component_id' => $strainer['component_id'],
                        'reason' => $validated['reason'],
                        'strainer_action' => $strainer['action'],
                        'user_id' => auth()->id(),
                        'notes' => $validated['notes'],
                    ]);
                }
            }
        }

        if (isset($validated['injectors'])) {
            foreach ($validated['injectors'] as $injector) {
                if ($injector['action'] && $injector['action'] !== 'nothing') {
                    BackwashLog::create([
                        'plantroom_id' => $validated['plantroom_id'],
                        'component_id' => $injector['component_id'],
                        'reason' => $validated['reason'],
                        'injector_action' => $injector['action'],
                        'user_id' => auth()->id(),
                        'notes' => $validated['notes'],
                    ]);
                }
            }
        }

        return redirect()->route('backwashes.index', $validated['plantroom_id'])
            ->with('success', 'Backwash log recorded successfully.');
    }

    public function index($plantroom_id)
    {
        $plantroom = PlantroomList::findOrFail($plantroom_id);
        $backwashes = BackwashLog::where('plantroom_id', $plantroom_id)
            ->with('component', 'user')
            ->orderBy('performed_at', 'desc')
            ->get();

        return view('backwash.index', compact('plantroom', 'backwashes'));
    }
}