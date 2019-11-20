<?php
namespace App\Http\Controllers\API\InstallationApp;

use App\Http\Controllers\Controller;
use App\Monitor;
use App\Site;
use App\Cell;
use Illuminate\Http\Request;

class InstallationController extends Controller
{

    //display sitelist
    public function showSitelist()
    {
        $sites = Site::all();
        if($sites)
        {
            return response()->json(['status' => 'success','data'=>$sites],200);
        }else{
            return response()->json(['status' => 'failure','data'=>'no data'],404);
        }

    }

    public function listSiteTechnologies(Request $request)
    {
        $request->validate([
            'site_id' => 'required',
        ]);
        $site_id = $request->get('site_id');
        $technologies = Cell::where('site_id', '=', $site_id)->groupBY('technology')->pluck('technology');
        if($technologies){
            return response()->json(['status' => 'success','data'=>$technologies],200);
        }else{
            return response()->json(['status' => 'failure','data'=>'no data available'],404);
        }

    }

    public function listCells(Request $request)
    {
        $request->validate([
            'technology' => 'required',
            'site_id' => 'required',
        ]);
        $cells = Cell::where('site_id','=',$request->get('site_id'))->where('technology' ,'=',$request->get('technology'))->select('cell_id','cell_name')->get();
        if($cells){
            return response()->json(['status' => 'success','data'=>$cells],200);
        }else{
            return response()->json(['status' => 'failure','data'=>'no data available'],404);
        }

    }

    public function validateCellID(Request $request)
    {
        $request->validate([
            'cell_id' => 'required',
        ]);
        if(Monitor::where('cell_id' ,'=', $request->get('cell_id'))->exists()){
            return response()->json(['status' => 'success','data'=>'match found'],200);
        }else{
            return response()->json(['status' => 'failure','data'=>'no data available'],404);
        }

    }
}
