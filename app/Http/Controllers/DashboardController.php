<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMainDashBoard()
    {
        $cells = Cell::all();
        // GET ALERTS DATA
        $new =  DB::table('alerts')->where('status', '=', 'new')->get();
        $pending =  DB::table('alerts')->where('status', '=', 'pending')->get();
        $optimizations =  DB::table('alerts')->where('status', '=', 'optimization')->get();
        $closed =  DB::select("SELECT *
                                FROM PUBLIC.alerts
                                WHERE PUBLIC.alerts.status = 'closed'
                                AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1");

        $new_install =  DB::table('installation_reports')->where('status', '=', 'new')->get();
        $years_install =  $this->getThisYearInstallations();

        // PIE CHART DATA
        $pc_data = $this->pieChartData();

        // BAR CHART
        $bc_data = $this->barGraphData();

        // LINE GRAPH - AZIMUTH DATA
        $lc_azim = $this->lineGraphAzimuth();
        $lc_tilt = $this->lineGraphTilt();
        $lc_roll = $this->lineGraphRoll();
        $lc_volt = $this->lineGraphVolts();
        $lc_signal = $this->lineGraphSignal();
        $lc_comm = $this->lineGraphComm();

        return view('dashboard.dash', compact('cells',
                                              'new', 
                                              'pending', 
                                              'optimizations', 
                                              'closed', 
                                              'new_install',
                                              'years_install',
                                              'pc_data',
                                              'bc_data',
                                              'lc_azim',
                                              'lc_tilt',
                                              'lc_roll',
                                              'lc_volt',
                                              'lc_signal',
                                              'lc_comm'
                                            ));
    }

    // DASHBOARD DATA QUERIES
    public function getThisYearInstallations()
    {
        // CARD DATA
        $card_data = DB::select("SELECT COUNT(PUBLIC.installation_reports.id) AS install_count
                                    FROM PUBLIC.installation_reports
                                    WHERE DATE_PART('year', PUBLIC.installation_reports.created_at) > DATE_PART('year', NOW()) - 1");
        return $card_data;
    }

    // DASHBOARD DATA QUERIES
    public function pieChartData()
    {
        // PIE CHART DATA
        $pc_data = DB::select("SELECT PUBLIC.alerts.alert_type, COUNT(PUBLIC.alerts.id) 
                                FROM PUBLIC.alerts 
                                GROUP BY PUBLIC.alerts.alert_type
                                ORDER BY PUBLIC.alerts.alert_type ASC");
        return $pc_data;
    }

    public function barGraphData()
    {
        // PIE CHART DATA
        $bc_data = DB::select("SELECT PUBLIC.alerts.cell_id, COUNT(PUBLIC.alerts.id) as num 
                                FROM PUBLIC.alerts 
                                GROUP BY PUBLIC.alerts.cell_id
                                ORDER BY num DESC
                                LIMIT 5");
        return $bc_data;
    }
    public function lineGraphAzimuth()
    {
        // PIE CHART DATA
        $lc_azim = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'azimuth'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS azimuth_count
                                GROUP BY mon"
                            );
        return $lc_azim;
    }

    public function lineGraphTilt()
    {
        // PIE CHART DATA
        $lc_tilt = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'tilt'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS tilt_count
                                GROUP BY mon"
                            );
        return $lc_tilt;
    }
    public function lineGraphRoll()
    {
        // PIE CHART DATA
        $lc_roll = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'roll'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS roll_count
                                GROUP BY mon"
                            );
        return $lc_roll;
    }

    public function lineGraphVolts()
    {
        // PIE CHART DATA
        $lc_volts = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'voltage'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS voltage_count
                                GROUP BY mon"
                            );
        return $lc_volts;
    }

    public function lineGraphSignal()
    {
        // PIE CHART DATA
        $lc_signal = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'signal'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS signal_count
                                GROUP BY mon"
                            );
        return $lc_signal;
    }
    public function lineGraphComm()
    {
        // PIE CHART DATA
        $lc_comm = DB::select("SELECT mon, COUNT(alert_count)
                                FROM (
                                    SELECT PUBLIC.alerts.created_at, DATE_PART('month', PUBLIC.alerts.created_at) AS mon, COUNT(PUBLIC.alerts.id) AS alert_count
                                    FROM PUBLIC.alerts
                                    WHERE PUBLIC.alerts.alert_type = 'signal'
                                    AND DATE_PART('year', PUBLIC.alerts.created_at) > DATE_PART('year', NOW()) - 1
                                    GROUP BY PUBLIC.alerts.created_at
                                    ORDER BY alerts.created_at ASC) AS signal_count
                                GROUP BY mon"
                            );
        return $lc_comm;
    }
}
