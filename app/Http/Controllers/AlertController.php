<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Cell;
use App\Monitor;
use App\MonitorData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    //display alert list
    public function showFullAlertslist()
    {
        $cellData = Cell::with('site')->get();
        return view('alerts.alertlist', compact('cellData'));
    }

    //display alert list by types
    public function showAlertsByTypes()
    {
        $cellData = Cell::with('site')->get();
        return view('alerts.alerts_types', compact('cellData'));
    }
    
    //display alert list by status
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