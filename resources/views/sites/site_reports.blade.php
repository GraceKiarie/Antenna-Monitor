@extends('layouts.main')

@push('pre-template-styles')
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />
@endpush

@push('post-app-styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.css') }}" />
@endpush

@section('content-detail')
<div class="row scroll-area-x">
    <div class="col-md-12 col-lg-12 scrollbar-container">
        <div class="main-card mb-3 card main-card-m">
            <div class="page-title-heading page-title-heading-m">
                <h3>SITES - <small>Site Reports</small></h3>
            </div>

            <hr class="page-title-hr" />

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">reports</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/sites';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Sites
                        </button>
                        <button onclick="window.location.href = '/cells';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Cells
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
                                        <a class="nav-link nav-link-m" id="install-tab" data-toggle="tab" href="#install" role="tab"
                                            aria-controls="install" aria-selected="false">
                                            Installation Reports</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-m" id="test-tab" data-toggle="tab" href="#test" role="tab"
                                            aria-controls="test" aria-selected="false">
                                            Test Reports</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-content-m" id="">
                                    <div class="tab-pane fade show active" id="install" role="tabpanel" aria-labelledby="install-tab">
                                        <table id="install_reports_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>QR Number</th>
                                                    <th>Installation Report</th>
                                                    <th>User</th>
                                                    <th>Last Modified</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($installData as $install)
                                                <?php 
                                                    
                                                ?>
                                                <tr>
                                                    <td><a href="#">{{ $install->qr_number }}</a></td>
                                                    <td><a href="#">{{ $install->installation_report }}</a></td>
                                                    <td>{{ $install->user_id }}</td>
                                                    <td>{{ $install->updated_at }}</td>
                                                    <td>{{ $install->status }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>QR Number</th>
                                                    <th>Installation Report</th>
                                                    <th>User</th>
                                                    <th>Last Modified</th>
                                                    <th>Status</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="test" role="tabpanel" aria-labelledby="test-tab">
                                        <table id="install_reports_table" class="display table table-striped table-border row-border table-hover table-sm responsive nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>QR Number</th>
                                                    <th>Installation Report</th>
                                                    <th>User</th>
                                                    <th>Last Modified</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($testData as $test)
                                                <?php 
                                                    
                                                ?>
                                                <tr>
                                                    <td><a href="#">{{ $test->qr_number }}</a></td>
                                                    <td><a href="#">{{ $test->test_report }}</a></td>
                                                    <td>{{ $test->user_id }}</td>
                                                    <td>{{ $test->updated_at }}</td>
                                                    <td>{{ $test->status }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>QR Number</th>
                                                    <th>Test Report</th>
                                                    <th>User</th>
                                                    <th>Last Modified</th>
                                                    <th>Status</th>
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
    <script src="{{ asset('assets/scripts/site_reports.js') }}"></script>
@endpush