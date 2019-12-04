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
    public function showAlertsDashBoard()
    {
        return view('alerts.alerts_dash');
    }
    //display alert list
    public function showFullAlertslist()
    {
        $cellData = Cell::with('site')->get();
        return view('alerts.alertlist', compact('cellData'));
    }
    //display alert list
    public function showAlertsByTypes()
    {
        $cellData = Cell::with('site')->get();
        return view('alerts.alerts_types', compact('cellData'));
    }
    //display alert list
    public function showAlertsByStatus()
    {
        $cellData = Cell::with('site')->get();
        return view('alerts.alerts_status', compact('cellData'));
    }

    //display alert list per cell
    public function showCellAlertslist($cell_id)
    {
        return view('alerts.cell_alerts');
    }

    //display alert list per site
    public function showSiteAlertslist($site_id)
    {
        return view('alerts.site_alerts');
    }
}
