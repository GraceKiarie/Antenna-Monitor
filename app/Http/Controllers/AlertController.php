<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Cell;
use App\Monitor;
use App\MonitorData;
use Carbon\Carbon;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlertController extends Controller
{
    //display alert list
    public function showFullAlertslist()
    {
        $alertData = Alert::all();
        $cellData = $this->cellData();

        return view('alerts.alertlist', compact('cellData', 'alertData'));
    }

    //display alert list
    public function showMonitorInstallations()
    {
        $instData = Monitor::all();

        return view('alerts.monitor_inst', compact('instData'));
    }

    //display sitelist
    public function showCellOptimizationsList()
    {
        $cellIDs = DB::table('alerts')->distinct()->where('status', '=', 'optimization')->get(['cell_id']);

        $id_array = json_decode( json_encode($cellIDs), true);
        $cellData = DB::table('cells')->whereIn('cell_id', $id_array)->get();

        $alertData = DB::table('alerts')->where('status', '=', 'optimization')->get();
        return view('sites.cell_opt', compact('cellData', 'alertData'));
    }

    public function cellData()
    {
        $cellIDs = DB::table('alerts')->distinct()->get(['cell_id']);

        $id_array = json_decode( json_encode($cellIDs), true);
        $cellData = DB::table('cells')->whereIn('cell_id', $id_array)->get();

        return $cellData;
    }
    //display alert list by types
    public function showAlertsByTypes()
    {
        $alertData = Alert::all();
        $cellData = $this->cellData();
        return view('alerts.alerts_types',compact('cellData', 'alertData'));
    }
    
    //display alert list by status
    public function showAlertsByStatus()
    {
        $alertData = Alert::all();
        $cellData = $this->cellData();
        return view('alerts.alerts_status',compact('cellData', 'alertData'));
    }

    //display alert list per cell
    public function showCellAlertslist($cell_id)
    {
        $cellData = $this->cellData();
        $cellAlerts = DB::table('alerts')->where('cell_id', '=', $cell_id)->get();
        return view('alerts.cell_alerts',compact('cellData', 'alertData'));
    }

    //display alert list per site
    public function showSiteAlertslist($site_id)
    {
        return view('alerts.site_alerts');
    }
}