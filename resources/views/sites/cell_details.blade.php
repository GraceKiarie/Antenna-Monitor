@extends('layouts.main')

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
                            // Make Cell name readable
                            $name_arr = explode("-", $cellData->cell_name);
                            $remove_id = array_splice($name_arr, 1);
                            $raw_name = implode("-", $remove_id);
                            $cell_name = str_replace('_', ' ', $raw_name);
                        ?>
                        Cell Name:<strong class="ec-cell-name"> {{ $cell_name }}</strong>
                        
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
                                <ul class="nav nav-tabs nav-tabs-m" id="cellsTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active nav-link-m" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                                            aria-controls="overview" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="alerts-tab" data-toggle="tab" href="#alerts" role="tab"
                                            aria-controls="alerts" aria-selected="false">
                                            Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="threshold-tab" data-toggle="tab" href="#threshold" role="tab"
                                            aria-controls="threshold" aria-selected="true">
                                            Thresholds
                                        </a>
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
                                            <div class="row">
                                                <div class="col-md-12 site-cell-info">
                                                    
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
                                                                <th>Alert Type</th>
                                                                <th>Value</th>
                                                                <th>Threshold</th>
                                                                <th>Alert Status</th>
                                                                <th>Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($cellData as $site)
                                                            <?php 
                                                                // for demo purposes only
                                                                $types = array('Voltage', 'Pitch', 'Heading', 'Roll' );
                                                                $type = $types[array_rand($types)];

                                                                $status = array('New/Pending', 'Optimization In Progress', 'Closed');
                                                                $status = $status[array_rand($status)];

                                                                if ($type == "Voltage") {
                                                                    $threshold = '4.8';
                                                                    $value = round($threshold - rand(1,2)/1.37, 2);

                                                                    $threshold = '4.8'.'volts';
                                                                    $value = $value.'volts';
                                                                } elseif ($type == "Heading") {
                                                                    $threshold = round(rand(40,340)/1.17, 2);
                                                                    $value = round($threshold - rand(2,3)/1.07, 2);

                                                                    $threshold = round(rand(40,340)/1.17, 2).'&deg;';
                                                                    $value = $value.'&deg;';
                                                                } elseif ($type == "Pitch" OR $type == "Roll") {
                                                                    $v = array('-1', '1');
                                                                    $threshold = round(rand(2,88)*$v[array_rand($v)]/1.17, 2);
                                                                    $value = round($threshold - rand(2,3)/1.07, 2);

                                                                    $threshold = $threshold.'&deg;';
                                                                    $value = $value.'&deg;';
                                                                }

                                                                if ($status == "New/Pending") {
                                                                    $status = '<a href="#" >'.$status.'</a>';
                                                                }
                                                            ?>
                                                            <tr class="<?php if ($status == "New/Pending")  { echo 'bg-danger'; } ?>">
                                                                <td><?php echo $types[array_rand($types)]; ?></td>
                                                                <td><?php echo $value; ?> </td>
                                                                <td><?php echo $threshold; ?> </td>
                                                                <td><?php echo $status; ?> </td>
                                                                <td><?php echo rand(10,23).":".str_pad(rand(0,59), 2, "0", STR_PAD_LEFT); ?> HRS </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Alert Type</th>
                                                                <th>Value</th>
                                                                <th>Threshold</th>
                                                                <th>Alert Status</th>
                                                                <th>Time</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="threshold" role="tabpanel" aria-labelledby="threshold-tab">
                                        <p>
                                            threshold info
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                                        <p>
                                            reports info
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
    <script src="{{ asset('assets/scripts/edit_cell.js') }}"></script>
@endpush