@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}" />
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

                    <h5 class="content-detail-title">
                        
                        <?php 
                            $site_name = str_replace('_', ' ', str_replace($siteData[0]->site->site_id.'-', '', $siteData[0]->site->site_name));
                        ?>
                        Site:<strong class="es-site-name"> {{ $site_name }}</strong>
                    </h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/sites';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Sites
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs nav-tabs-m" id="sitesTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active nav-link-m" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                                            aria-controls="overview" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="cells-tab" data-toggle="tab" href="#cells" role="tab"
                                            aria-controls="cells" aria-selected="false">
                                            Cells
                                            (<?php echo count($siteData); ?>)
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="alerts-tab" data-toggle="tab" href="#alerts" role="tab"
                                            aria-controls="alerts" aria-selected="false">Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="location-tab" data-toggle="tab" href="#location" role="tab"
                                            aria-controls="location" aria-selected="true">Location/Map</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="reports-tab" data-toggle="tab" href="#reports" role="tab"
                                            aria-controls="reports" aria-selected="false">
                                            Reports
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-m" id="">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                            <div class="container-fluid">

                                                    <!-- HEADER ROW -->
                                                    <div class="row es-row-o">
                                                        <div class="col-md-6">
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>
                                                                Site ID: <strong>{{ $siteData[0]->site->site_id }}</strong> &nbsp; 
                                                                Cell Count: <strong> <?php echo count($siteData); ?></strong>
                                                            </h6>
                                                        </div>
                                                    </div>
        
                                                    <!-- ALERTS ROW -->
                                                    <div class="row es-row-title">
                                                        <div class="col-md-12">
                                                            <h5>ALERTS</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row es-row-e">
                                                        <div class="col-md-4">
                                                            <div class="card border-info mb-4" style="max-width: 18rem;">
                                                                <div class="card-body border-info-m text-info">
                                                                    <h4 class="card-title card-title-m">New/Pending Alerts</h4>
                                                                    <h2 class="card-text card-text-m">13</h2>
                                                                    <h6 class="card-text-footer">Alerts received in the last 12hrs</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card border-info mb-4" style="max-width: 18rem;">
                                                                <div class="card-body border-info-m text-info">
                                                                    <h4 class="card-title card-title-m">IN PROGRESS</h4>
                                                                    <h2 class="card-text card-text-m">6</h2>
                                                                    <h6 class="card-text-footer">Alerts being worked on currently</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card border-info mb-4" style="max-width: 18rem;">
                                                                <div class="card-body border-info-m text-info">
                                                                    <h4 class="card-title card-title-m">Closed Alerts</h4>
                                                                    <h2 class="card-text card-text-m">34</h2>
                                                                    <h6 class="card-text-footer">Alerts closed in the last 30 days</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <!-- ALERTS ROW -->
                                                    <div class="row es-row-title">
                                                        <div class="col-md-12">
                                                            <h5>BATTERY & SIGNAL</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row es-row-e">
                                                        <div class="col-md-6">
                                                            <div class="main-card mb-3 card">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">BATTERY LEVELS</h5>
                                                                    <canvas id="chart-horiz-bar"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="main-card mb-3 card">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">SIGNAL STRENGTH</h5>
                                                                        <div style="">
                                                                            <canvas id="line-chart"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
        
                                                </div>
                                    </div>
                                    <div class="tab-pane fade" id="cells" role="tabpanel" aria-labelledby="cells-tab">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 site-cell-info">
                                                    <table id="site_cells_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Cell ID</th>
                                                                <th>Cell Name</th>
                                                                <th>Status</th>
                                                                <th>Technology</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siteData as $site)
                                                            <?php 
                                                                $name_arr = explode("-", $site->cell_name);
                                                                $remove_id = array_splice($name_arr, 1);
                                                                $raw_name = implode("-", $remove_id);
                                                                $cell_name = str_replace('_', ' ', $raw_name);
                                                            ?>
                                                            <tr>
                                                                <td><a href="/cell/{{ $site->cell_id }}"> {{ $site->cell_id }} </a></td>
                                                                <td> {{ $cell_name }} </td>
                                                                <td> {{ $site->status }} </td>
                                                                <td> {{ $site->technology }} </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Cell ID</th>
                                                                <th>Cell Name</th>
                                                                <th>Status</th>
                                                                <th>Technology</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12 site-cell-info">
                                                        <table id="site_cells_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Cell Name</th>
                                                                        <th>Alerts</th>
                                                                        <th>Technology</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($siteData as $site)
                                                                    <?php 
                                                                        $name_arr = explode("-", $site->cell_name);
                                                                        $remove_id = array_splice($name_arr, 1);
                                                                        $raw_name = implode("-", $remove_id);
                                                                        $cell_name = str_replace('_', ' ', $raw_name);
                                                                    ?>
                                                                    <tr>
                                                                        <td><a href="/cell/{{ $site->cell_id }}"> {{ $cell_name }} </a></td>
                                                                        <td><a href="/cell/{{ $site->cell_id }}#alerts"><?php echo rand(2,5); ?></a></td>
                                                                        <td> {{ $site->technology }} </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Cell Name</th>
                                                                        <th>Alerts</th>
                                                                        <th>Technology</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                                        <p>echo location info</p>
                                    </div>
                                    <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                                        <p>
                                            echo reports info
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/edit_site.js') }}"></script>
@endpush