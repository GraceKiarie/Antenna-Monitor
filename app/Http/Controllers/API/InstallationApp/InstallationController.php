<?php
namespace App\Http\Controllers\API\InstallationApp;

use App\Http\Controllers\Controller;
use App\Monitor;
use App\MonitorData;
use App\Site;
use App\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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

        ]);
        $file = $request->file('image');
        $random = rand(1000000, 400000000) . "_" . rand(1000000, 400000000);
        $name =   $name = $random . "." . $file->extension();;
        $path = Storage::put('installationImages/', $name
        );



        return $name;

    }

    public function getNearbySites()
    {

        $lat =114.99073;
        $long = 106.70797;
        $radius = 0.3;

        return $query= DB::table('sites')
            ->selectRaw('( 6371 * acos( cos( radians(?) ) *
                               cos( radians( lat ) )
                               * cos( radians( long ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( lat ) ) )
                             ) AS distance', [$lat, $long, $lat])
            ->havingRaw("distance < ?", [$radius])
            ->get();


    }
    public function scopeCloseTo()
    {
        $lat =114.99073;
        $long = 106.70797;
        $radius = 5;
       $query=Site::whereRaw('
       ST_Distance_Sphere(
            point(long, lat),
            point('.$long.', '.$lat.')
        )  < '.$radius.'
    ')->get();

       dd($query);
    }
}
