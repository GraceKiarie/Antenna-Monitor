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
                <h3>SYSTEM - <small>User Management</small></h3>
            </div>

            <hr class="page-title-hr" />
            <div class="main-card mb-3 card">
                 <div class="card-body card-body-m">
                        <h5 class="content-detail-title">User List</h5>

                        <div class="content-detail-btns">
                            <button onclick="window.location.href = '/add_admin';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add User
                            </button>
                            <button onclick="window.location.href = '/add_contractor';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add Contractor
                            </button>
                            <button onclick="window.location.href = '/add_team';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add Team
                            </button>
                        </div>

                        <hr class="page-subtitle-hr" />
                        
                        <table id="userlist_table" class="display table table-striped table-border row-border table-hover table-sm nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td> {{ $user->name}} </td>
                                        <td> {{ $user->role_id}} </td>
                                        <td> {{ $user->phone}} </td>
                                        <td> {{ $user->email}} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
            </div>
        </div>
</div>
@endsection

@push('app-scripts')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script src="{{ asset('assets/scripts/userlist.js') }}"></script>
@endpush