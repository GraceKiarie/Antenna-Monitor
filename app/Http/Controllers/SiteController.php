<?php

namespace App\Http\Controllers;

use App\AcceptanceReport;
use App\Alert;
use App\Site;
use App\Cell;
use App\InstallationReport;
use App\MonitorData;
use App\TestReport;
use DateInterval;
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
        Log::info('New sitelist uploaded :' . $count . '  Sites Added' ,['type' =>'create','result' => 'success']);
        return $count . $failed;
    }

    public function saveCells()
    {
        $path = $this->uploadCsvFile();
        $file = fopen($path, "r"); //open file in read mode
        $count = 0;
        $failed = 0;
        $updated = 0;

        while (!feof($file))//while its not end of the file opened do the following
        {
            $row_data = fgetcsv($file);

            if ($row_data) {

                if(Cell::where(['cell_id' => $row_data[6]])->exists())
                {
                    $cell = Cell::where('cell_id',$row_data[6])->first();
                    $cell->heading =$row_data[17];
                    $cell->pitch =$row_data[18];
                    $cell->roll =$row_data[19];
                    $cell->save();
                    $updated++;




                }else{
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

                }

            } else {
                $failed++;
            }
        }
        Log::info('New sitelist uploaded :'.$count . '  Cells Added',['type' =>'create','result' => 'success']);
        Log::info('New sitelist uploaded :' .$updated . '  Cells Updated',['type' =>'update','result' => 'success']);
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
        $installData = $this->getDataForSiteReports('installation_reports', 'user_id');
        $testData = $this->getDataForSiteReports('test_reports', 'user_id');
        $acceptanceData = $this->getDataForSiteReports('acceptance_reports', 'installation_report_id');
        $acceptanceData = AcceptanceReport::all();
        return view('sites.site_reports', compact('installData', 'testData', 'acceptanceData'));
    }

    private function getDataForSiteReports($table, $column)
    {
        $id = DB::table($table)->distinct()->get([$column]);
        $id_array = json_decode( json_encode($id), true);

        if ($table == 'installation_reports') {
            $reportUsers = DB::table('users')->whereIn('id', $id_array)->get();
            // $reportData = InstallationReport::all();
            $reportData = $this->getInstallationReportTableDetails();

            foreach ($reportUsers as $user) {
                foreach ($reportData as $data) {
                    if($data->user_id == $user->id){
    
                        // add  user name to test report collection
                        $data->user_name = $user->name;
                    }
                }
            }
        } elseif ($table == 'test_reports') {
            $reportUsers = DB::table('users')->whereIn('id', $id_array)->get();
            $reportData = TestReport::all();

            foreach ($reportUsers as $user) {
                foreach ($reportData as $data) {
                    if($data->user_id == $user->id){
    
                        // add  user name to test report collection
                        $data->user_name = $user->name;
                    }
                }
            }

        } else {
            $reportData = $this->getAcceptanceReportData();
        }
        return $reportData;
    }

    public function editReportStatus($report_id)
    {
        $reportData = DB::table('installation_reports')->where('id', '=', $report_id)->get();
        $reportData = $this->addSiteDetailsToReport($reportData);
        return view('sites.edit_report_status', compact('reportData'));
    }

    public function updateInstallationReportStatus($report_id, Request $request)
    {
        $report = InstallationReport::find($report_id);
        $report->status = $request->status;
        $updateReport = $report->save();

        if ($updateReport)
        {
            Log::info(' Installation Report Status updated', ['type' => 'update', 'result' => 'success']);
        }
        $reportData = DB::table('installation_reports')->where('id', '=', $report_id)->get();
        $reportData = $this->addSiteDetailsToReport($reportData);
        return view('sites.edit_report_status', compact('reportData'));
    }

    public function getInstallationReportTableDetails()
    {
        $reportData = InstallationReport::all();
        $reportData = $this->addSiteDetailsToReport($reportData);
        return $reportData;
    }

    private function addSiteDetailsToReport($reportData)
    {
        foreach ($reportData as $datum) {
            // Extract Site Id From Report Name
            // Site Id can be used as a search parameter in the table
            $siteId = substr($datum->installation_report, 0, strpos($datum->installation_report, '-'));
            $datum->site_id = $siteId;

            // get user name
            $userName = DB::table('users')->where('id', '=', $datum->user_id)->get('name');
            $datum->user_name = $userName[0]->name;
    
            // Create a formattted Report Name
            $datum->reportName = $this->formatReportName($datum->installation_report);
        }
        return $reportData;
    }

    private function formatReportName($reportName)
    {
        $siteId = substr($reportName, 0, strpos($reportName, '-'));

        $clearName = str_replace($siteId."-","", $reportName);
        $clearName = str_replace(".pdf","", $clearName);
        $clearName = str_replace("InstallationReport","Report", $clearName);
        $clearName = str_replace("_"," ", $clearName);

        return $clearName;
    }

    private function getInstallationReportName($installationReportID)
    {
        $installationReportName = DB::table('installation_reports')
                                        ->where('installation_report_id', $installationReportID)
                                        ->get(['installation_report']);
        return $installationReportName;
    }


    
    private function getSiteDataForAcceptanceReports($installationReportID = [])
    {
        $uniqueQRNumbers = DB::table('installation_reports')
                                ->distinct()
                                ->whereIn('installation_report_id', $installationReportID)->get(['qr_number']);
        $qr_array = json_decode( json_encode($uniqueQRNumbers), true);
        $uniqueCellIDs = DB::table('monitors')
                                ->distinct()
                                ->whereIn('qr_number', $qr_array)->get(['cell_id']);
        $cellID_array = json_decode( json_encode($uniqueCellIDs), true);
        $uniqueSiteIDs = DB::table('cells')
                                ->distinct()
                                ->whereIn('cells', $cellID_array)->get(['site_id']);
        $siteID_array = json_decode( json_encode($uniqueSiteIDs), true);
        $siteData = DB::table('sites')
                        ->whereIn('site_id', $siteID_array)
                        ->get(['site_name', 'technology']);
        $siteData_array = json_decode( json_encode($uniqueSiteIDs), true);
        return $siteData_array;
    }

    private function getAcceptanceReportData()
    {
        $acceptanceReportData = AcceptanceReport::all();
        foreach ($acceptanceReportData as $data) {
            $siteData = $this->getsiteDataForIR($data->installationReportID);
            $data->site_name = $siteData->site_name;
            $data->technology = $siteData->technology;
        }
        return $acceptanceReportData;
    }

    private function getsiteDataForIR($irID)
    {
        $qrNumber = DB::table('installation_reports')
                        ->where('id', '=', $irID)
                        ->get('qr_number');
        $cellID = DB::table('monitors')
                        ->where('qr_number', '=', $qrNumber)
                        ->get('cell_id');
        $siteID = DB::table('cells')
                        ->where('cell_id', '=', $cellID)
                        ->get('site_id');
        $siteData = DB::table('sites')
                        ->where('site_id', '=', $siteID)
                        ->get(['site_name', 'technology']);
        return $siteData;
    }

    public function showCellDetails($cell_id)
    {
        $cellData = DB::table('cells')->where('cell_id', '=', $cell_id)->get();

        $site_id = DB::table('cells')->where('cell_id', '=', $cell_id)->get(['site_id']);
        $site_id = json_decode( json_encode($site_id), true);

        $siteInfo = DB::table('sites')->where('site_id', '=', $site_id)->get();

        $cellAlerts = DB::table('alerts')->where('cell_id', '=', $cell_id)->get();

        $batteryVoltage = $this->voltageLineGraphData($cell_id);

        return view('sites.cell_details', compact('cellData', 'cellAlerts', 'siteInfo', 'batteryVoltage'));
    }

    public function voltageLineGraphData($cell_id)
    {
        //get current time as a DateTime Object
        $currentTime = \DateTime::createFromFormat('Y-m-d H:i:s', '2020-02-17 06:50:55');
        //$currentTime = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s', time()));
        $lastPeriod = $currentTime->sub(new DateInterval('PT15H'));
        $lastTwelveHours = $lastPeriod->format('Y-m-d H:i:s');

        $cell_id = (string)$cell_id;
        $voltageValues = DB::select("SELECT PUBLIC.monitor_data.voltage, PUBLIC.monitor_data.created_at
                                FROM PUBLIC.monitor_data
                                WHERE PUBLIC.monitor_data.cell_id = '$cell_id' 
                                AND PUBLIC.monitor_data.created_at > '$lastTwelveHours'
                                ORDER BY PUBLIC.monitor_data.created_at ASC"
        );

        // array indices to be selected from the DB result
        $hourlyArrayIndex = array(0,12,24,36,48,60,72,84,96,108,120,144,156,168,180,192,204,216,228,240,252,264,276);

        // array that goes to line chart view with voltage values
        $lc_volt = array();
        foreach ($voltageValues as $key => $value) {
            //select one value per hour and push into array
            if (in_array($key, $hourlyArrayIndex)) {
                array_push($lc_volt, $value);
            }
        }
        return $lc_volt;
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

    public function showSummaryPage()
    {
        $summary = array();
        return view('sites.summary', compact('summary'));
    }
}
