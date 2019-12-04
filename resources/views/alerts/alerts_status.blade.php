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
                <h3>ALERTS <small></small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">Alerts status</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/alerts/types';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Types
                        </button>
                        <button onclick="window.location.href = '/alerts';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View All Alerts
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs nav-tabs-m" id="alertsTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active nav-link-m" id="all-tab" data-toggle="tab" href="#all" role="tab"
                                            aria-controls="all" aria-selected="true">All Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="new-tab" data-toggle="tab" href="#new" role="tab"
                                            aria-controls="new" aria-selected="false">
                                            New Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                                            aria-controls="pending" aria-selected="false">
                                            Pending Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="optim-tab" data-toggle="tab" href="#optim" role="tab"
                                            aria-controls="optim" aria-selected="true">
                                            Optimizations
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="closed-tab" data-toggle="tab" href="#closed" role="tab"
                                            aria-controls="closed" aria-selected="false">
                                            Closed Alerts
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-m" id="">
                                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                        <table id="alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
                                    <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                                        <table id="new_alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
    
                                                    $status = '<a href="#" >New</a>';;
    
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
    
                                                    $name_arr = explode("-", $cell->cell_name);
                                                    $remove_id = array_splice($name_arr, 1);
                                                    $raw_name = implode("-", $remove_id);
                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                ?>
                                                <tr>
                                                    <td><?php echo rand(10,23).":".str_pad(rand(0,59), 2, "0", STR_PAD_LEFT); ?> HRS </td>
                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                    <td><?php echo $type; ?></td>
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
                                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                        <table id="new_alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
    
                                                    $status = '<a href="#" >Pending</a>';;
    
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
    
                                                    $name_arr = explode("-", $cell->cell_name);
                                                    $remove_id = array_splice($name_arr, 1);
                                                    $raw_name = implode("-", $remove_id);
                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                ?>
                                                <tr>
                                                    <td><?php echo rand(10,23).":".str_pad(rand(0,59), 2, "0", STR_PAD_LEFT); ?> HRS </td>
                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                    <td><?php echo $type; ?></td>
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
                                    <div class="tab-pane fade" id="optim" role="tabpanel" aria-labelledby="optim-tab">
                                        <table id="alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
                                                    $type = 'Azimuth';
    
                                                    $status = array('New/Pending', 'Optimization In Progress', 'Closed');
                                                    $status = $status[array_rand($status)];
    
                                                    if ($type == "Azimuth") {
                                                        $threshold = round(rand(40,340)/1.17, 2);
                                                        $value = round($threshold - rand(2,3)/1.07, 2);
    
                                                        $threshold = round(rand(40,340)/1.17, 2).'&deg;';
                                                        $value = $value.'&deg;';
                                                    } 
                                                    
                                                    if ($status == "New/Pending") {
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
                                                    <td><?php echo $type; ?></td>
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
                                    <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                                        <table id="alerts_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
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
                                                    $type = 'Pitch';
    
                                                    $status = array('New/Pending', 'Optimization In Progress', 'Closed');
                                                    $status = $status[array_rand($status)];
    
                                                    if ($type == "Pitch") {
                                                        $v = array('-1', '1');
                                                        $threshold = round(rand(2,88)*$v[array_rand($v)]/1.17, 2);
                                                        $value = round($threshold - rand(2,3)/1.07, 2);
    
                                                        $threshold = $threshold.'&deg;';
                                                        $value = $value.'&deg;';
                                                    }
    
                                                    if ($status == "New/Pending") {
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
                                                    <td><?php echo $type; ?></td>
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
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/alerts_status.js') }}"></script>
@endpush