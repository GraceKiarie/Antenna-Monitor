<?php
namespace App\Http\Controllers\API\InstallationApp;

use App\Http\Controllers\Controller;
use App\InstallationImage;
use App\Monitor;
use App\MonitorData;
use App\Site;
use App\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\ApiTraits;

class InstallationController extends Controller
{
    use ApiTraits;

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
        $cells = Cell::where('site_id','=',$request->get('site_id'))->where('technology' ,'=',$request->get('technology'))->select('sector_id','cell_id','cell_name')->get();
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
        if(MonitorData::where('cell_id' ,'=', $request->get('cell_id'))->exists()){
            return response()->json(['status' => 'success','data'=>'match found'],200);
        }else{
            return response()->json(['status' => 'failure','data'=>'no data available'],404);
        }
    }

    public function uploadImage( Request $request)
    {
        $request->validate([
            'image' => 'required',
            'cell_id' => 'required',

        ]);
        $file = $request->file('image');
        $random = rand(1000000, 400000000) . "_" . rand(1000000, 400000000);
        $name =   $name = $random . "." . $file->extension();;
        $file->move( 'Storage/app/installationMessages/', $name);

        $image=InstallationImage::create([
            'cell_id' => $request->get('cell_id'),
            'image' => $name,
        ]);
        if($image){
            return response()->json(['status'=> 'success','message'=>'upload successful']);
        }
    }
    public function getNearbySites(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'long' => 'required',
        ]);

        $lat = $request->get('lat');  //-4.03375
        $long = $request->get('long'); //39.6864
        $radius = 1;

         $sites =$this->nearbySites($lat,$long, $radius);
         if ($sites){
             return response()->json(['status'=>'success','data'=> $sites],200);
         }
         else{
             return response()->json(['status'=>'success','message'=> 'something went wrong'],200);
         }
    }

}
