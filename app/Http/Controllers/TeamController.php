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
        return view('auth.teamlist', compact('teams'));
    }

    public function showAddTeamForm()
    {
        $cons = Contractor::all();
        return view('auth.register_team',compact('cons'));
    }
}
