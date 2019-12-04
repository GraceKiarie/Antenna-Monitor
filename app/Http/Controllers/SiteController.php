<?php

namespace App\Http\Controllers;

use App\Site;
use App\Cell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function uploadCsvFile()
    {
        $path = request()->file('sitelist')->getRealPath(); //find the files location
        return $path;
    }

    public function saveSites()
    {
        $path = $this->uploadCsvFile();
        $file = fopen($path, "r"); //open file in read mode
        $count = 0;
        $failed = 0;

        while (!feof($file))//while its not end of the file opened do the following
        {
            $row_data = fgetcsv($file);


            if (!empty($row_data) && !Site::where(['site_id' => $row_data[2]])->exists()) {

                // save sites
                $data = [
                    'node_id' => $row_data[1],
                    'site_id' => $row_data[2],
                    'site_name' => $row_data[3],
                    'lac' => $row_data[7],
                    'mcc' => $row_data[8],
                    'vendor' => $row_data[11],
                    'lat' => $row_data[13],
                    'long' => $row_data[14]
                ];
                Site::create($data);
                $count++;

            } else {
                $failed++;
            }
        }
        fclose($file);
        return $count . $failed;
    }

    public function saveCells()
    {
        $path = $this->uploadCsvFile();
        $file = fopen($path, "r"); //open file in read mode
        $count = 0;
        $failed = 0;

        while (!feof($file))//while its not end of the file opened do the following
        {
            $row_data = fgetcsv($file);

            if ($row_data && !Cell::where(['cell_id' => $row_data[6]])->exists()) {

                // save cells
                $data = [
                    'site_id' =>$row_data[2],
                    'cell_name' => $row_data[4],
                    'sector_id' => $row_data[5],
                    'cell_id' => $row_data[6],
                    'mnc' => $row_data[9],
                    'status' => $row_data[10],
                    'technology' => $row_data[12],
                    'bcch_uarfcn_earfcn' => $row_data[15],
                    'bsci_psc_pci' => $row_data[16],
                    'heading' => $row_data[17],
                    'pitch' => $row_data[18],
                    'roll' => $row_data[19],
                ];
                Cell::create($data);
                $count++;
            } else {
                $failed++;
            }
        }
        fclose($file);
        return $count . $failed;
    }

    public function uploadSitelist()
    {
        $this->saveSites();
        $this->saveCells();
        $sites = Site::all();
        return redirect('/sites');
    }

    public function showSitesDashBoard()
    {
        return view('sites.sites_dash');
    }
    
    //display sitelist
    public function showSitelist()
    {
        $sites = Site::all();
        return view('sites.sitelist', compact('sites'));
    }

    //SHOW SITE DATA
    public function showSite($site_id)
    {
        $siteData = Cell::with('site')->where('site_id', '=', $site_id)->get();
        return view('sites.site_details', compact('siteData'));
    }

    public function showCellDetails($cell_id)
    {
        $cellData = Cell::with('site')->where('cell_id', '=', $cell_id)->first();
        return view('sites.cell_details', compact('cellData'));
    }

    //display sitelist
    public function showCellsList()
    {
        $cells = Cell::with('site')->get();
        return view('sites.celllist', compact('cells'));
    }

    //display upload sitelist
    public function showUploadSitelist()
    {
        return view('sites.upload-sites');
    }
}
