<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMainDashBoard()
    {
        return view('dashboard.dash');
    }

    public function showSitesDashBoard()
    {
        return view('sites.sites_dash');
    }

    public function showAlertsDashboard()
    {
        return view('sites.alerts_dash');
    }
}
