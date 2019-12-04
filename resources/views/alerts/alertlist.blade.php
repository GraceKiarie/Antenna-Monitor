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
                <h3>ALERTS <small></small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">all Alerts</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/alerts/types';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Types
                        </button>
                        <button onclick="window.location.href = '/alerts/status';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Status
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    
                    <div class="row">
                            <div class="col-md-12 site-cell-info">
                                <table id="alerts_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Cell Name</th>
                                            <th>Alert Type</th>
                                            <th>Value</th>
                                            <th>Threshold</th>
                                            <th>Alert Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cellData as $cell)
                                        <?php 
                                            // for demo purposes only
                                            $types = array('Voltage', 'Pitch', 'Heading', 'Roll' );
                                            $type = $types[array_rand($types)];
            
                                            $status = array('New', 'Pending', 'Optimization In Progress', 'Closed');
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
            
                                            if ($status == "New" || $status == "Pending") {
                                                $status = '<a href="#" >'.$status.'</a>';
                                            }
            
                                            $name_arr = explode("-", $cell->cell_name);
                                            $remove_id = array_splice($name_arr, 1);
                                            $raw_name = implode("-", $remove_id);
                                            $cell_name = str_replace('_', ' ', $raw_name);
                                        ?>
                                        <tr class="<?php if ($status == "New/Pending")  { echo 'bg-danger'; } ?>">
                                            <td><?php echo rand(10,23).":".str_pad(rand(0,59), 2, "0", STR_PAD_LEFT); ?> HRS </td>
                                            <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                            <td><?php echo $types[array_rand($types)]; ?></td>
                                            <td><?php echo $value; ?> </td>
                                            <td><?php echo $threshold; ?> </td>
                                            <td><?php echo $status; ?> </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Time</th>
                                            <th>Cell ID</th>
                                            <th>Alert Type</th>
                                            <th>Value</th>
                                            <th>Threshold</th>
                                            <th>Alert Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                    </div>
                    
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
    <script src="./assets/scripts/alertlist.js"></script>
@endpush