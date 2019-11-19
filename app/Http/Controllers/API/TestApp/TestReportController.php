<?php

namespace App\Http\Controllers\API\TestApp;

use App\Http\Controllers\Controller;
use App\Mail\TestReportEmail;
use App\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Mail\Mailable;
use App\Jobs\SendTestReportEmail;
use Carbon\Carbon;
class TestReportController extends Controller
{
    public function getData(Request $request)
    {

        //dd($data);


    }


    public function sendMail(Request $request, $id )
    {

        $user = User::where('id', '=', $id)->first();
        $data = [
            'imsi' => $request->get('imsi'),
            'qr_number' => $request->get('qr_number'),
            'voltage' => $request->get('voltage'),
            'csq' => $request->get('csq'),
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role->role_name,
        ];


        if ($data['voltage'] >4.8){
            $data['voltage_test'] = 'Passed';
        }else{
            $data['voltage_test'] = 'Failed';
        }
        if ($data['csq'] >7){
            $data['asu_test'] = 'Passed';
        }else{
            $data['asu_test'] = 'Failed';
        }
        if ($data['csq'] &&  $data['voltage_test'] == 'Passed'){
            $data['test'] = 'Pass';
        }else{
            $data['test'] = 'Fail';
        }
        $data['test_id'] =rand(100000, 900000).'ADC';

        $t =time();
        $data['date']=date("Y-m-d",$t);
        $data['time']=date('H:i:s',$t);

        $pdf = PDF::loadView('mails.test_report', compact('data'));

        // save mail to directory
        $filename = $data['name']."_".$data['qr_number'] . '_testReport.pdf';

        Storage::put('public/testReport/' . $filename, $pdf->output());
        $url = '/home/kiarie/Desktop/Antenna-Monitor/storage/app/public/testReport/' . $filename;

        Log::info("Request cycle without Queues started");

        $when = now()->addMinutes(5);
        Mail::to('gnjokikiarie@gmail.com')->later($when,new TestReportEmail($url));


        Log::info("Request cycle without Queues finished");
        return response()->json(['status'=>'success'],200);
    }
}
