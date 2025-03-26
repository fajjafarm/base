<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TrainingSession;

class TrainingSessionController extends Controller
{
    public function create()
    {
        $users = User::all(); // Changed to User
        return view('training.create', compact('users')); // View remains same
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:Pool Rescue,First Aid,Departmental,Other',
            'custom_type' => 'required_if:type,Other',
            'date' => 'required|date',
            'duration' => 'required|numeric|min:0',
            'description' => 'nullable',
            'location' => 'required|string',
            'pool_depth' => 'nullable|numeric|min:0',
            'equipment_used' => 'array',
            'equipment_used.*' => 'in:Rope,Pole,Ruth Lee Manikin,Orange Manikin,First Aid Kit,Other',
            'custom_equipment' => 'required_if:equipment_used.*,Other',
            'trainer' => 'required|string',
            'users' => 'required|array', // Changed to 'users'
            'comments' => 'array'
        ]);

        $training = TrainingSession::create($validated);
        
        $syncData = [];
        foreach ($request->users as $userId) { // Changed to $request->users
            $syncData[$userId] = ['comments' => $request->comments[$userId] ?? ''];
        }
        $training->users()->sync($syncData); // Changed to users()

        return redirect()->route('training.create')->with('success', 'Training session recorded');
    }
}