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

            <div class="row sd-cards">
                <div class="col-md-4">
                    <a href="#" class="dash-card">
                        <div class="card border-info">
                            <div class="card-body sd-card-body-m text-info">
                                <div class="row">
                                    <div class="col-md-7 sd-card-h">
                                        <h6 class="sd-card-title" >New Alerts</h6>
                                        <h6 class="sd-card-subtitle" >Unviewed Alerts</h6>
                                    </div>
                                    <div class="col-md-5 sd-card-no">
                                        <h2 class="sd-card-number">13</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="dash-card">
                        <div class="card border-info">
                            <div class="card-body sd-card-body-m text-info">
                                <div class="row">
                                    <div class="col-md-7 sd-card-h">
                                        <h6 class="sd-card-title" >Pending Alerts</h6>
                                        <h6 class="sd-card-subtitle" >Unassigned Alerts</h6>
                                    </div>
                                    <div class="col-md-5 sd-card-no">
                                        <h2 class="sd-card-number">13</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="dash-card">
                        <div class="card border-info">
                            <div class="card-body sd-card-body-m text-info">
                                <div class="row">
                                    <div class="col-md-8 sd-card-h">
                                        <h6 class="sd-card-title" >Optimizations</h6>
                                        <h6 class="sd-card-subtitle">Cells Under Optimization</h6>
                                    </div>
                                    <div class="col-md-4 sd-card-no">
                                        <h2 class="sd-card-number">13</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <hr class="sd-cards-hr" />
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