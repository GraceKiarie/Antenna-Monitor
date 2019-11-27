<?php

namespace App\Http\Controllers;

use App\Cell;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //display alert list
    public function showAlertslist()
    {
        $cellData = Cell::with('site')->get();
        return view('sites.alertlist', compact('cellData'));
    }
}
