<?php
namespace App\Http\Controllers\API\InstallationApp;

use App\Http\Controllers\Controller;
use App\Site;
use App\Cell;
use Illuminate\Http\Request;

class SiteController extends Controller
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

    public function showCells()
    {
        $cells = Cell::all();
        foreach ($cells as $cell){
            echo $cell;
        }
        return $cells;
    }
}
