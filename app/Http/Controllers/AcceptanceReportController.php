<?php

namespace App\Http\Controllers;

use App\AcceptanceReport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcceptanceReportController extends Controller
{
    public function saveAcceptanceReport(Request $request)
    {
        $fileName = $this->formatReportName($request->installation_report_name);
        $request->file('acceptanceForm')->storeAs('AcceptanceForms', $fileName);
        
        $report = new AcceptanceReport();
        $report->installation_report_id = $request->installation_report_id;
        $report->comment = $request->acceptanceComment;
        $report->status = $request->acceptanceStatus;
        $report->acceptance_form = $fileName;
        $report->save();
        return back();
    }

    public function formatReportName($reportName)
    {
        $siteId = substr($reportName, 0, strpos($reportName, '-'));
        $reportName = str_replace($siteId."-","", $reportName);
        $reportName = str_replace("InstallationReport","Acceptance_Form", $reportName);
        return $reportName;
    }

}
