<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $trainingByYear = $user->trainingSessions()
            ->selectRaw('YEAR(date) as year, SUM(duration) as total_hours')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        return view('users.show', compact('user', 'trainingByYear')); // Updated view path
    }
}
