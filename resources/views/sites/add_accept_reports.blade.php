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

                    <h5 class="content-detail-title">Site Acceptance</strong> </h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/site_reports#accept/';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Acceptance Reports List
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <div class="row">
                        <div class="col-md-8 report-details">

                            <div class="row">
                                <div class="col-md-4 head-detail">
                                    <p>Site ID</p>
                                </div>
                                <div class="col-md-8">
                                    <strong>
                                        {{$reportData[0]->site_id}}
                                    </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 head-detail">
                                    <p>Site Name</p>
                                </div>
                                <div class="col-md-8">
                                    <strong>
                                        {{$reportData[0]->site_name}}
                                    </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 head-detail">
                                    <p>Installation Date</p>
                                </div>
                                <div class="col-md-8">
                                    <strong>
                                        {{$reportData[0]->date_installed}}
                                    </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 head-detail">
                                    <p>Installation report</p>
                                </div>
                                <div class="col-md-8">
                                    <a href="{{asset('storage/InstallationReport/'.$reportData[0]->installation_report)}}" target="_blank">
                                        <strong>
                                            {{$reportData[0]->report_name}} 
                                        </strong>
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 head-detail">
                                    <p>Technician</p>
                                </div>
                                <div class="col-md-8">
                                    <strong>
                                        {{$reportData[0]->technician}}
                                    </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 accept-area">
                                    <form method="post" action="/upload_acceptance_form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5 class="accept-header">
                                                    Acceptance Details
                                                </h5>
                                            </div>
                                        </div>
                                        <hr class="accept-hr" />
                                        <div class="row">
                                            <div class="col-md-2 head-detail">
                                                <p>Upload Form</p>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="acceptanceForm">Acceptance Form</label>
                                                        <input type="file" name="acceptanceForm" class="form-control-file" id="acceptanceForm" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2 head-detail">
                                                <p>Status</p>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="position-relative form-check" style="width: 100%;">
                                                            <label class="form-check-label" style="width: 100%;">
                                                                <select id="acceptanceStatus" class="form-control" name="acceptanceStatus" style="width: 100% !important;">
                                                                    <option value="pending" class="pending">Pending</option>
                                                                    <option value="rejected" class="rejected">Rejected</option>
                                                                    <option value="accepted" class="accepted">Accepted</option>
                                                                </select>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="acceptanceComment">Report Comments</label>
                                                    <textarea class="form-control" name="acceptanceComment" id="acceptanceComment" rows="1"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="installation_report_id" value="{{$reportData[0]->installation_report_id}}">
                                        <input type="hidden" name="installation_report_name" value="{{$reportData[0]->installation_report}}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" id="submitDetails" class="mt-1 btn btn-primary btn-app">Save Details</button>
                                                <button type="reset" id="resetDetails" class="mt-1 btn btn-success btn-app">Reset</button>
                                            </div>
                                        </div>
                                    </form>
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