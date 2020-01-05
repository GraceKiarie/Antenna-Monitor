<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Site;
use App\Cell;
use App\InstallationReport;
use App\MonitorData;
use App\TestReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        Log::info('New sitelist uploaded successfully',['type' =>'update','result' => 'success']);
        $sites = Site::all();
        return redirect('/sites');
    }

    //display sitelist
    public function showSitelist()
    {
        $sites = Site::all();
        $alerts = Alert::all();
        return view('sites.sitelist', compact('sites', 'alerts'));
    }

    //SHOW SITE DATA
    public function showSite($site_id)
    {
        $siteData = DB::table('sites')->where('site_id', '=', $site_id)->get();
        $cellData = DB::table('cells')->where('site_id', '=', $site_id)->get();

        $cell_ids = DB::table('cells')->distinct()->where('site_id', '=', $site_id)->get(['cell_id']);
        $id_array = json_decode( json_encode($cell_ids), true);

        $alertData = DB::table('alerts')->whereIn('cell_id', $id_array)->get();

        return view('sites.site_details', compact('siteData', 'cellData', 'alertData'));
    }

    //DISPLAY SITE REPORTS PAGE
    public function showSiteReports()
    {
        $installData = $this->getDataForSiteReports('installation_reports');
        $testData = $this->getDataForSiteReports('test_reports');
        return view('sites.site_reports', compact('installData', 'testData'));
    }

    private function getDataForSiteReports($table)
    {
        $userIDs = DB::table($table)->distinct()->get(['user_id']);
        $id_array = json_decode( json_encode($userIDs), true);
        $reportUsers = DB::table('users')->whereIn('id', $id_array)->get();

        if ($table == 'installation_reports') {
            $reportData = InstallationReport::all();
        } else {
            $reportData = TestReport::all();
        }

        foreach ($reportUsers as $user) {
            foreach ($reportData as $data) {
                if($data->user_id == $user->id){

                    // add  user name to test report collection
                    $data->user_name = $user->name;
                }
            }
        }
        return $reportData;
    }

    public function showCellDetails($cell_id)
    {
        $cellData = DB::table('cells')->where('cell_id', '=', $cell_id)->get();

        $site_id = DB::table('cells')->where('cell_id', '=', $cell_id)->get(['site_id']);
        $site_id = json_decode( json_encode($site_id), true);

        $siteInfo = DB::table('sites')->where('site_id', '=', $site_id)->get();

        $cellAlerts = DB::table('alerts')->where('cell_id', '=', $cell_id)->get();

        return view('sites.cell_details', compact('cellData', 'cellAlerts', 'siteInfo'));
    }

    //display sitelist
    public function showCellsList()
    {
        $cells = Cell::all();
        $alerts = Alert::all();
        return view('sites.celllist', compact('cells', 'alerts'));
    }

    //display upload sitelist
    public function showUploadSitelist()
    {
        return view('sites.upload-sites');
    }
}
