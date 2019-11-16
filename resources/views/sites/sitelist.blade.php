@extends('layouts.main')

@push('app-styles')
    <link rel="stylesheet" href="./assets/datatables/datatables.min.css" />
@endpush

@push('page-styles')
    <link rel="stylesheet" href="./assets/css/datatables.css" />
@endpush

@section('content-title')
<div class="page-title-heading page-title-heading-m">
    <div>
        <h3>SITES</h3>
    </div>
</div>
@endsection

@section('content-detail')
<div class="row scroll-area-x">
    <div class="col-md-12 col-lg-12 scrollbar-container">
        <div class="main-card mb-3 card main-card-m">
            <div class="page-title-heading page-title-heading-m">
                <h3>SITES - <small>Site List</small></h3>
            </div>

            <hr class="page-title-hr" />

            <table id="table1" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Node_ID</th>
                        <th>Huawei Enodeb ID</th>
                        <th>Node_Name</th>
                        <th>SiteID</th>
                        <th>SiteName</th>
                        <th>cellName</th>
                        <th>Cell_ID</th>
                        <th>LAC</th>
                        <th>MCC</th>
                        <th>MNC</th>
                        <th>Status</th>
                        <th>Vendor</th>
                        <th>TECHNOLOGY</th>
                        <th>LATITUDE_DEC</th>
                        <th>LONGITUDE_DEC</th>
                        <th>BCCH/UARFCN/EARFCN</th>
                        <th>BSCI/PSC/PCI</th>
                    </tr>
                </thead>
                
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Node_ID</th>
                        <th>Huawei Enodeb ID</th>
                        <th>Node_Name</th>
                        <th>SiteID</th>
                        <th>SiteName</th>
                        <th>cellName</th>
                        <th>Cell_ID</th>
                        <th>LAC</th>
                        <th>MCC</th>
                        <th>MNC</th>
                        <th>Status</th>
                        <th>Vendor</th>
                        <th>TECHNOLOGY</th>
                        <th>LATITUDE_DEC</th>
                        <th>LONGITUDE_DEC</th>
                        <th>BCCH/UARFCN/EARFCN</th>
                        <th>BSCI/PSC/PCI</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="./assets/datatables/datatables.min.js"></script>
@endpush

@push('page-scripts')
    <script src="./assets/scripts/tables.js"></script>
@endpush