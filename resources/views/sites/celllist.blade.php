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

            <div class="main-card mb-3 card">
                <div class="card-body card-body-m">

                    <h5 class="content-detail-title">Cell List</h5>

                    <div class="content-detail-btns">
                        <button onclick="window.location.href = '/sites';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            View Sites
                        </button>
                        <button onclick="window.location.href = '/upload_sitelist';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Upload New Sitelist
                        </button>
                        <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                            Back
                        </button>
                    </div>

                    <hr class="page-subtitle-hr" />

                    <table id="celllist_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cell ID</th>
                                <th>Cell Name</th>
                                <th>Status</th>
                                <th>Technology</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cells as $cell)
                            <?php 
                                $cell_name = str_replace('_', ' ', str_replace($cell->site_id.'-', '', $cell->cell_name));
                            ?>
                                <tr>
                                    <td> {{ $cell->cell_id }} </td>
                                    <td> {{ $cell_name }} </td>
                                    <td> {{ $cell->status }} </td>
                                    <td> {{ $cell->technology }} </td>
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
</div>
@endsection

@push('app-scripts')
    <script src="./assets/datatables/datatables.min.js"></script>
@endpush

@push('page-scripts')
    <script src="./assets/scripts/celllist.js"></script>
@endpush