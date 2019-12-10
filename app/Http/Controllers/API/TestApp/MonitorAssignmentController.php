<?php

namespace App\Http\Controllers\API\TestApp;

use App\Http\Controllers\Controller;

use App\MonitorAssignment;
use App\User;
use Illuminate\Http\Request;

class MonitorAssignmentController extends Controller
{
    public function listInstallationEngineers()
    {
        $engineers = User::where('role_id' ,3)->get();
        
        return response()->json(['status' => 'success' , 'data'=>$engineers],200);

    }

    public function assignMonitors(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'qr_number' => 'required',
        ]);

        $qr_numbers = $request->get('qr_number');

        foreach ($qr_numbers as $qr_number)
        {
            MonitorAssignment::create([
                'user_id' => $request->get('user_id'),
                'qr_number' => $qr_number,

            ]);
        }

        return response()->json(['status' => 'success' , 'data' => ['message' => 'Assignment successful!' ]]);


        
    } 
}
