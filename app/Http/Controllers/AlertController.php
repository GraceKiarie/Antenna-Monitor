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
    public function showAlertslist()
    {
        $cellData = Cell::with('site')->get();
        return view('sites.alertlist', compact('cellData'));
    }

    /*public function cronjob()
    {
        $currentTime = Carbon::now();
        $now = Carbon::now();
        $last30min = $now->subHours(18);
        //dd(strtotime($last30min->format('H:i:s')));
        $cell_id = Monitor::whereBetween('installation_time', [strtotime($last30min->format('H:i:s')), strtotime($currentTime->format('H:i:s'))])
            ->pluck('cell_id')->toArray();
        dd($cell_id);
        //check monitor data
        $alerts = MonitorData::whereIn('cell_id', $cell_id)
            ->select('heading','roll','pitch','voltage','cell_id')
            ->distinct('cell_id')
            ->get();
       //dd($alerts);// 1575382853 1575383030 1575397459 1575381931

        foreach ($alerts as $alert) {

            //Low voltage alert
            if ($alert->voltage < 3) {
                Alert::create([
                    'cell_id' => $alert->cell_id,
                    'qr_number' => $alert->qr_number,
                    'alert_type' => 'Low Voltage',
                    'value' => $alert->voltage,
                    'status' => 'Pending',
                ]);
            }
            //Voltage Drop alert
            $cell = MonitorData::where('cell_id', $alert->cell_id)->orderBy('created_at', 'desc')
              ->limit(2)->get();
            //dd($cell);
            $currentVoltage=$cell[0]['voltage'];
            $previousVoltage=$cell[1]['voltage'];

            if (($previousVoltage -$currentVoltage) > 0.0026) {
                Alert::create([
                    'cell_id' => $alert->cell_id,
                    'qr_number' => $alert->qr_number,
                    'alert_type' => 'Voltage Drop',
                    'value' => $currentVoltage,
                    'status' => 'Pending',
                ]);
            }

            //heading alert
            $cell = Cell::where('cell_id', $alert->cell_id)->first();

            if ($alert->heading > ($cell->heading + 1) || $alert->heading < ($cell->heading - 1)) {
                Alert::create([
                    'cell_id' => $alert->cell_id,
                    'qr_number' => $alert->qr_number,
                    'alert_type' => 'Heading',
                    'value' => $alert->heading,
                    'status' => 'Pending',
                ]);
            }
            //Pitch Alert

            if ($alert->pitch > ($cell->pitch + 1) || $alert->pitch < ($cell->pitch - 1)) {
                Alert::create([
                    'cell_id' => $alert->cell_id,
                    'qr_number' => $alert->qr_number,
                    'alert_type' => 'Pitch',
                    'value' => $alert->pitch,
                    'status' => 'Pending',
                ]);
            }
            //Roll Alert

            if ($alert->roll > ($cell->roll + 1) || $alert->roll < ($cell->roll - 1)) {
                Alert::create([
                    'cell_id' => $alert->cell_id,
                    'qr_number' => $alert->qr_number,
                    'alert_type' => 'Roll',
                    'value' => $alert->roll,
                    'status' => 'Pending',
                ]);
            }

        }
        return "success";

    }*/

}