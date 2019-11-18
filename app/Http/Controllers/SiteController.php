<?php

namespace App\Http\Controllers;

use App\Site;
use App\Cell;
use Illuminate\Http\Request;

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
            if (!empty($row_data[1])) {
                $node_id = $row_data[1];
            } else {
                $node_id = $row_data[2];
            }

            if (!empty($row_data) && !Site::where(['site_id' => $row_data[4]])->exists()) {

                // save sites
                $data = [
                    'node_id' => $node_id,
                    'node_name' => $row_data[3],
                    'site_id' => $row_data[4],
                    'site_name' => $row_data[5],
                    'lac' => $row_data[8],
                    'mcc' => $row_data[9],
                    'vendor' => $row_data[12],
                    'lat' => $row_data[14],
                    'long' => $row_data[15]
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

            if ($row_data) {

                // save cells
                $data = [
                    'site_id' =>$row_data[4],
                    'cell_name' => $row_data[6],
                    'cell_id' => $row_data[7],
                    'mnc' => $row_data[10],
                    'status' => $row_data[11],
                    'technology' => $row_data[13],
                    'bcch_uarfcn_earfcn' => $row_data[16],
                    'bsci_psc_pci' => $row_data[17],
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

    //display sitelist
    public function showSitelist()
    {
        $sites = Site::all();
        return view('sites.sitelist', compact('sites'));
    }

    //display sitelist
    public function showCellsList()
    {
        $cells = Cell::all();
        return view('sites.celllist', compact('cells'));
    }

    //display upload sitelist
    public function showUploadSitelist()
    {
        return view('sites.upload-sites');
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
