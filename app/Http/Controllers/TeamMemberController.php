<?php
namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::whereNull('end_date')->get();
        return view('team-members.index', compact('teamMembers'));
    }

    public function show(TeamMember $teamMember)
    {
        $trainingLogs = $teamMember->trainingLogs()->latest()->get();
        $cprTrainings = $teamMember->cprTrainings()->latest()->get();
        
        return view('team-members.show', compact('teamMember', 'trainingLogs', 'cprTrainings'));
    }
}