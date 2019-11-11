<?php

namespace App\Http\Controllers\API\TestApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Monitor;
Use App\Report;

class TestController extends Controller
{
    /**
     * qr_number scan test
     *
     * @param  [string] qr_number
     */

    public function qrTest(Request $request)
    {
        $code = Monitor::where('qr_number', '=', $request->get('qr_number'))->exists();
        if($code){
            return response()->json(['status' => 'success','message'=> ' match found in the database '],200);

        }else{
            return response()->json(['status' => 'failure','message'=> 'wrong code '],404);
        }

    }

    /**
     * imsi scan test
     *
     * @param  [string] imsi
     */

    public function ImsiTest(Request $request)
    {
        $code = Monitor::where('imsi', '=', $request->get('imsi') )->where('qr_number', '=', $request->get('qr_number'))->pluck('voltage')->first();
        //dd($code);
        if($code){
            return response()->json(['status' => 'success','message'=> $code],200);

        }else{
            return response()->json(['status' => 'failure','message'=> 'wrong code '],404);
        }

    }
}
