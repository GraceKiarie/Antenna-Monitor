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
                <h3>CELLS <small></small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">OPTIMIZATIONS</h5>

                    <div class="content-detail-btns">
                        {{-- 
                        <button onclick="window.location.href = '/alerts/status';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Alerts By Status
                        </button>
                        <button onclick="window.location.href = '/alerts';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View All Alerts
                        </button>
                         --}}
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                        <div class="col-md-12">
                            <h6>Cells Under Optimization</h6>
                        </div>
                    </div>

                    <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs nav-tabs-m" id="alertsTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active nav-link-m" id="all-tab" data-toggle="tab" href="#all" role="tab"
                                            aria-controls="all" aria-selected="true">All Optimizations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="azimuth-tab" data-toggle="tab" href="#azimuth" role="tab"
                                            aria-controls="azimuth" aria-selected="true">
                                            Heading
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="pitch-tab" data-toggle="tab" href="#pitch" role="tab"
                                            aria-controls="pitch" aria-selected="false">
                                            Pitch
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="roll-tab" data-toggle="tab" href="#roll" role="tab"
                                            aria-controls="roll" aria-selected="false">
                                            Roll</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="signal-tab" data-toggle="tab" href="#signal" role="tab"
                                            aria-controls="signal" aria-selected="true">
                                            Signal
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="battery-tab" data-toggle="tab" href="#battery" role="tab"
                                            aria-controls="battery" aria-selected="false">
                                            Battery
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="com-tab" data-toggle="tab" href="#com" role="tab"
                                            aria-controls="com" aria-selected="false">
                                            Communication
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-m" id="">
                                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                        <div class="container-fluid">
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
                                                            @foreach ($alertData as $alert)
                                                                @foreach ($cellData as $cell)
                                                                    @if ($alert->cell_id == $cell->cell_id)
                                                                        <?php 
                            
                                                                            $name_arr = explode("-", $cell->cell_name);
                                                                            $remove_id = array_splice($name_arr, 1);
                                                                            $raw_name = implode("-", $remove_id);
                                                                            $cell_name = str_replace('_', ' ', $raw_name);
                                                                        ?>
                                                                        <tr>
                                                                            <td> {{ $alert->updated_at }} </td>
                                                                            <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                                            <td>{{ $alert->alert_type }} </td>
                                                                            <td>{{ $alert->value }} </td>
                                                                            <td> 
                                                                                @if ($alert->alert_type == 'Heading')
                                                                                    {{ $cell->heading }}
                                                                                @elseif ($alert->alert_type == 'Pitch')
                                                                                    {{ $cell->pitch }}
                                                                                @elseif ($alert->alert_type == 'Roll')
                                                                                    {{ $cell->pitch }}
                                                                                @elseif ($alert->alert_type == 'Weak Signal')
                                                                                    N/A
                                                                                @elseif ($alert->alert_type == 'Low Voltage')
                                                                                    3.2 Volts
                                                                                @elseif ($alert->alert_type == 'Voltage Drop' )
                                                                                    N/A
                                                                                @elseif ($alert->alert_type == 'No Communication' )
                                                                                    N/A                                                        
                                                                                @endif
                                                                            </td>
                                                                            <td>{{ $alert->status }}  </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
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
                                    <div class="tab-pane fade" id="azimuth" role="tabpanel" aria-labelledby="azimuth-tab">
                                        <div class="container-fluid">
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
                                                                    @foreach ($alertData as $alert)
                                                                        @foreach ($cellData as $cell)
                                                                            @if ($alert->cell_id == $cell->cell_id)
                                                                                <?php 
                                    
                                                                                    $name_arr = explode("-", $cell->cell_name);
                                                                                    $remove_id = array_splice($name_arr, 1);
                                                                                    $raw_name = implode("-", $remove_id);
                                                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                                                ?>
                                                                                <tr>
                                                                                    <td> {{ $alert->updated_at }} </td>
                                                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                                                    <td>{{ $alert->alert_type }} </td>
                                                                                    <td>{{ $alert->value }} </td>
                                                                                    <td> 
                                                                                        @if ($alert->alert_type == 'Heading')
                                                                                            {{ $cell->heading }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ $alert->status }}  </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
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
                                    <div class="tab-pane fade" id="pitch" role="tabpanel" aria-labelledby="pitch-tab">
                                        <div class="container-fluid">
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
                                                                    @foreach ($alertData as $alert)
                                                                        @foreach ($cellData as $cell)
                                                                            @if ($alert->cell_id == $cell->cell_id)
                                                                                <?php 
                                    
                                                                                    $name_arr = explode("-", $cell->cell_name);
                                                                                    $remove_id = array_splice($name_arr, 1);
                                                                                    $raw_name = implode("-", $remove_id);
                                                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                                                ?>
                                                                                <tr>
                                                                                    <td> {{ $alert->updated_at }} </td>
                                                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                                                    <td>{{ $alert->alert_type }} </td>
                                                                                    <td>{{ $alert->value }} </td>
                                                                                    <td> 
                                                                                        @if ($alert->alert_type == 'Pitch')
                                                                                            {{ $cell->pitch }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ $alert->status }}  </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
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
                                    <div class="tab-pane fade" id="roll" role="tabpanel" aria-labelledby="roll-tab">
                                        <div class="container-fluid">
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
                                                                    @foreach ($alertData as $alert)
                                                                        @foreach ($cellData as $cell)
                                                                            @if ($alert->cell_id == $cell->cell_id)
                                                                                <?php 
                                    
                                                                                    $name_arr = explode("-", $cell->cell_name);
                                                                                    $remove_id = array_splice($name_arr, 1);
                                                                                    $raw_name = implode("-", $remove_id);
                                                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                                                ?>
                                                                                <tr>
                                                                                    <td> {{ $alert->updated_at }} </td>
                                                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                                                    <td>{{ $alert->alert_type }} </td>
                                                                                    <td>{{ $alert->value }} </td>
                                                                                    <td> 
                                                                                        @if ($alert->alert_type == 'Roll')
                                                                                            {{ $cell->pitch }}                                                       
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ $alert->status }}  </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
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
                                    <div class="tab-pane fade" id="signal" role="tabpanel" aria-labelledby="signal-tab">
                                        <div class="container-fluid">
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
                                                                    @foreach ($alertData as $alert)
                                                                        @foreach ($cellData as $cell)
                                                                            @if ($alert->cell_id == $cell->cell_id)
                                                                                <?php 
                                    
                                                                                    $name_arr = explode("-", $cell->cell_name);
                                                                                    $remove_id = array_splice($name_arr, 1);
                                                                                    $raw_name = implode("-", $remove_id);
                                                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                                                ?>
                                                                                <tr>
                                                                                    <td> {{ $alert->updated_at }} </td>
                                                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                                                    <td>{{ $alert->alert_type }} </td>
                                                                                    <td>{{ $alert->value }} </td>
                                                                                    <td> 
                                                                                        @if ($alert->alert_type == 'Weak Signal')
                                                                                            N/A                                                       
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ $alert->status }}  </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
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
                                    <div class="tab-pane fade" id="battery" role="tabpanel" aria-labelledby="battery-tab">
                                        <div class="container-fluid">
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
                                                                    @foreach ($alertData as $alert)
                                                                        @foreach ($cellData as $cell)
                                                                            @if ($alert->cell_id == $cell->cell_id)
                                                                                <?php 
                                    
                                                                                    $name_arr = explode("-", $cell->cell_name);
                                                                                    $remove_id = array_splice($name_arr, 1);
                                                                                    $raw_name = implode("-", $remove_id);
                                                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                                                ?>
                                                                                <tr>
                                                                                    <td> {{ $alert->updated_at }} </td>
                                                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                                                    <td>{{ $alert->alert_type }} </td>
                                                                                    <td>{{ $alert->value }} </td>
                                                                                    <td> 
                                                                                        @if ($alert->alert_type == 'Low Voltage')
                                                                                            3.2 Volts
                                                                                        @elseif ($alert->alert_type == 'Voltage Drop' )
                                                                                            N/A                                                       
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ $alert->status }}  </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
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
                                    <div class="tab-pane fade" id="com" role="tabpanel" aria-labelledby="com-tab">
                                        <div class="container-fluid">
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
                                                                    @foreach ($alertData as $alert)
                                                                        @foreach ($cellData as $cell)
                                                                            @if ($alert->cell_id == $cell->cell_id)
                                                                                <?php 
                                    
                                                                                    $name_arr = explode("-", $cell->cell_name);
                                                                                    $remove_id = array_splice($name_arr, 1);
                                                                                    $raw_name = implode("-", $remove_id);
                                                                                    $cell_name = str_replace('_', ' ', $raw_name);
                                                                                ?>
                                                                                <tr>
                                                                                    <td> {{ $alert->updated_at }} </td>
                                                                                    <td><a href="/cell/{{ $cell->cell_id }}#alerts">{{ $cell_name }}</a></td>
                                                                                    <td>{{ $alert->alert_type }} </td>
                                                                                    <td>{{ $alert->value }} </td>
                                                                                    <td> 
                                                                                        @if ($alert->alert_type == 'No Communication' )
                                                                                            N/A                                                        
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>{{ $alert->status }}  </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
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
        </div>
    </div>
</div>
@endsection

@push('app-scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/alerts_types.js') }}"></script>
@endpush