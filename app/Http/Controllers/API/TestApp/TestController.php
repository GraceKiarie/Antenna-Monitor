<?php

namespace App\Http\Controllers\API\TestApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MonitorData;
Use App\TestReport;

class TestController extends Controller
{
    /*
     * qr_number scan test
     * @param  [string] qr_number
     */
    public function qrTest(Request $request)
    {
        $qr_number = $request->get('qr_number');
        $code = MonitorData::where('qr_number', '=', $qr_number)->exists();
        if ($code) {
            return response()->json(['status' => 'success', 'data' => ['message' => 'match found', 'qr_number' => $qr_number]], 200);

        } else {
            return response()->json(['status' => 'failure', 'message' => 'match not found in the database'], 404);
        }

    }

    /*
     * imsi scan test
     * @param  [string] imsi
     * @param  [string] qr_number
     */

    public function ImsiTest(Request $request)
    {
        $imsi = $request->get('imsi');
        $qr_number = $request->get('qr_number');
        $code =MonitorData::where('imsi', '=', $imsi)->where('qr_number', '=', $qr_number)->select('voltage','csq')->first();

        if ($code) {
            return response()->json(['status' => 'success', 'data' => ['voltage' => $code->voltage, 'csq' => $code->csq, 'qr_number' => $qr_number, 'imsi' => $imsi]], 200);

        } else {
            return response()->json(['status' => 'failure', 'message' => 'communication not established '], 404);
        }
    }
}
