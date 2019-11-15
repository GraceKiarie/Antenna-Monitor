@extends('layouts.main')

@section('content-detail')
<div class="row scroll-area-x">
        <div class="col-md-12 col-lg-12 scrollbar-container">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div>
                        <button class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app">
                            <a href="/register" class="a-btn" > Register User </a>
                        </button>
                        <button class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app">
                            Delete Users
                        </button>
                    </div>
                    <table class="mb-0 table table-striped table-hover">
                        <thead>
                        <tr>
                            <th data-checkbox="true"></th>
                            <th>#</th>
                            <th>Full Names</th>
                            <th>Email Address</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th></th>
                            <th scope="row">1</th>
                            <td>Mark Otto</td>
                            <td>mark.otto@adc.com</td>
                            <td>System Administrator</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th scope="row">2</th>
                            <td>Jacob Thornton</td>
                            <td>jthornton@adc.com</td>
                            <td>Installation Engineer</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th scope="row">3</th>
                            <td>Larry The Bird</td>
                            <td>thebird@adc.com</td>
                            <td>Test Engineer</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection