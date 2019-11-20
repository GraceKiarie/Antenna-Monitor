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
                        @foreach ($cellData as $cell)
                        <?php 
                            // $cell_name = str_replace($cell->site_id, '', $cell->cell_name);

                            // Make Cell name readable
                            $name_arr = explode("-", $cell->cell_name);
                            $remove_id = array_splice($name_arr, 1);
                            $raw_name = implode("-", $remove_id);
                            $cell->cell_name = str_replace('_', ' ', $raw_name);
                        ?>
                        Cell Name:<strong class="ec-cell-name"> {{ $cell->cell_name }}</strong> <br>
                        @endforeach
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
                                <ul class="nav nav-tabs nav-tabs-m" id="myTab" role="tablist">
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
                                        <p>
                                            echo basic info
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
                                        <p>
                                            alerts info
                                        </p>
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
    <script src="{{ asset('assets/scripts/edit_site.js') }}"></script>
@endpush