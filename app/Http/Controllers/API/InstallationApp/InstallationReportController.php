<?php

namespace App\Http\Controllers\API\InstallationApp;

use App\Http\Controllers\Controller;
use App\Jobs\SaveTestReportJob;
use App\Jobs\SendTestReportEmailJob;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InstallationReportController extends Controller
{
    public function sendMail(Request $request, $id )
    {

        $user = User::where('id', '=', $id)->first();
        $data = [
            'imsi' => $request->get('imsi'),
            'qr_number' => $request->get('qr_number'),
            'voltage' => $request->get('voltage'),
            'csq' => $request->get('csq'),
            'name' => $user->name,
            'user_id' => $user->id,
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
        if ($data['asu_test'] =='Passed' && $data['voltage_test'] == 'Passed'){
            $data['test'] = 'Pass';
        }else{
            $data['test'] = 'Fail';
        }
        $data['test_id'] =rand(100000, 900000).'ADC';

        $t =time();
        $data['date']=date("Y-m-d",$t);
        $data['time']=date('H:i:s',$t);

        //generate pdf and save to directory

        $pdf = PDF::loadView('mails.test_report', compact('data'));
        $filename = $data['name']."_".$data['qr_number'] . '_testReport.pdf';
        Storage::put('public/testReport/' . $filename, $pdf->output());
        $uri = '/home/kiarie/Desktop/Antenna-Monitor/storage/app/public/testReport/' . $filename;

        Log::info("Request cycle without Queues started");

        //save report info to db
        $savetodbJob = (new SaveTestReportJob($data))->delay(Carbon::now()->addSeconds(2));
        dispatch($savetodbJob );

        //send report to email
        $emailJob = (new SendTestReportEmailJob($uri))->delay(Carbon::now()->addSeconds(3));
        dispatch($emailJob);

        Log::info("Request cycle without Queues finished");
        return response()->json(['status'=>'success', 'data'=>$data],200);
    }
}
