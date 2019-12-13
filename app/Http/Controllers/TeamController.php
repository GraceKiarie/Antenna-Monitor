<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function showTeamList()
    {
        $teams = Team::all();
        $cons = Contractor::all();
        return view('auth.teamlist', compact('teams', 'cons'));
    }

    public function showAddTeamForm()
    {
        $cons = Contractor::all();
        return view('auth.register_team',compact('cons'));
    }
}
