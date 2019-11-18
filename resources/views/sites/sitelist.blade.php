@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="./assets/datatables/datatables.min.css" />
@endpush

@push('post-app-styles')
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
                <h3>SITES - <small>Site Management</small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">Site List</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/cells';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Cells
                        </button>
                        <button onclick="window.location.href = '/upload_sitelist';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Upload New Sitelist
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <table id="sitelist_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                        <thead>
                            <tr>
                                {{-- 
                                    <th>Date</th>
                                    <th>Node_ID</th>
                                    <th>Huawei Enodeb ID</th>
                                    <th>Node_Name</th> 
                                --}}
                                <th>SiteID</th>
                                <th>SiteName</th>
                                {{-- 
                                    <th>LAC</th>
                                    <th>MCC</th>
                                    <th>MNC</th> 
                                --}}
                                <th>Vendor</th>
                                {{-- 
                                    <th>LATITUDE_DEC</th>
                                    <th>LONGITUDE_DEC</th>
                                    <th>BCCH/UARFCN/EARFCN</th>
                                    <th>BSCI/PSC/PCI</th> 
                                --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sites as $site)
                            <?php 
                                $site_name = str_replace('_', ' ', str_replace($site->site_id.'-', '', $site->site_name));
                            ?>
                                <tr>
                                    <td> {{ $site->site_id }} </td>
                                    <td> {{ $site_name }} </td>
                                    <td> {{ $site->vendor }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                {{-- 
                                    <th>Date</th>
                                    <th>Node_ID</th>
                                    <th>Huawei Enodeb ID</th>
                                    <th>Node_Name</th> 
                                --}}
                                <th>SiteID</th>
                                <th>SiteName</th>
                                <th>cellName</th>
                                <th>Cell_ID</th>
                                {{-- 
                                    <th>LAC</th>
                                    <th>MCC</th>
                                    <th>MNC</th> 
                                --}}
                                <th>Status</th>
                                <th>Vendor</th>
                                <th>TECHNOLOGY</th>
                                {{-- 
                                    <th>LATITUDE_DEC</th>
                                    <th>LONGITUDE_DEC</th>
                                    <th>BCCH/UARFCN/EARFCN</th>
                                    <th>BSCI/PSC/PCI</th> 
                                --}}
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="./assets/datatables/datatables.min.js"></script>
@endpush

@push('page-scripts')
    <script src="./assets/scripts/sitelist.js"></script>
@endpush