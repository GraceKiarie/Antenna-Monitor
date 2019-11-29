@extends('layouts.main')

@section('content-detail')
<div class="row scroll-area-x">
        <div class="col-md-12 col-lg-12 scrollbar-container">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <a href="/alerts" class="dash-card">
                            <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-heading-m">NEW ALERTS</div>
                                        <div class="widget-subheading">(PAST 12 HRS)</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>357</span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="" class="dash-card">
                            <div class="card mb-3 widget-content bg-asteroid">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-heading-m">SITES</div>
                                        <div class="widget-subheading">PENDING OPTIMIZATIONS</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>67</span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="" class="dash-card">
                            <div class="card mb-3 widget-content bg-slick-carbon">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading widget-heading-m">REPORTS</div>
                                        <div class="widget-subheading">NEW REPORTS</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>12</span></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-premium-dark">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Products Sold</div>
                                        <div class="widget-subheading">Revenue streams</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <canvas id="dash-pie-chart" height="350"></canvas>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="mb-3 card">
                                <canvas id="dash-bar-chart-horizontal" height="350"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="mb-3 card">
                                <canvas id="dash-line-chart" height="350"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Closed Alerts</div>
                                            <div class="widget-subheading">(This Year)</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success">596</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Installations</div>
                                            <div class="widget-subheading">(This Year)</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-warning">167</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Contractors</div>
                                            <div class="widget-subheading">(No. Of Contractors On-Site)</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-danger">5</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Income</div>
                                            <div class="widget-subheading">Expected totals</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-focus">$147</div>
                                        </div>
                                    </div>
                                    <div class="widget-progress-wrapper">
                                        <div class="progress-bar-sm progress-bar-animated-alt progress">
                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                                        </div>
                                        <div class="progress-sub-label">
                                            <div class="sub-label-left">Expenses</div>
                                            <div class="sub-label-right">100%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-header">CURRENT SITES IN OPTIMIZATION
                                    <div class="btn-actions-pane-right">
                                        <div role="group" class="btn-group-sm btn-group">
                                            <button class="active btn btn-focus">Last Week</button>
                                            <button class="btn btn-focus">All Month</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Site ID</th>
                                            <th>Site Name</th>
                                            <th class="text-center">Alerts</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center text-muted">12083_NE_LEC30001</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">Athi River South MSR MGF HUB</div>
                                                            <div class="widget-subheading opacity-7"> LTE 800</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">1</td>
                                            <td class="text-center">
                                                <div class="badge badge-warning">Pending</div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-muted">12896_WN_LWN20041</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading"> Kiwegi OUTL MGF </div>
                                                            <div class="widget-subheading opacity-7">LTE1800, UMTS900, GSM 1800 </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">4</td>
                                            <td class="text-center">
                                                <div class="badge badge-success">Completed</div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" id="PopoverCustomT-2" class="btn btn-primary btn-sm">Details</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-muted">12987_WN_LWN20119</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">Busia Exchange WMX OUTL MGF </div>
                                                            <div class="widget-subheading opacity-7">UMTS900/2100, LTE800</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">4</td>
                                            <td class="text-center">
                                                <div class="badge badge-danger">In Progress</div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" id="PopoverCustomT-3" class="btn btn-primary btn-sm">Details</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center text-muted">13041_CO_LEL30895</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading"> Mombasa Mwembe Tayari MRT </div>
                                                            <div class="widget-subheading opacity-7"> GSM1800, LTE800/1800 </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">5</td>
                                            <td class="text-center">
                                                <div class="badge badge-info">On Hold</div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" id="PopoverCustomT-4" class="btn btn-primary btn-sm">Details</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-block text-center card-footer">
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                    <button class="btn-wide btn btn-success">Save</button>
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
    <script src="{{ asset('assets/scripts/dash.js') }}"></script>
@endpush