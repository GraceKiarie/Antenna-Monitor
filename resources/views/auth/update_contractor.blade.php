@extends('layouts.main')

@section('content-detail')
<div class="row scroll-area-x">
    <div class="col-md-12 col-lg-12 scrollbar-container">
        <div class="main-card mb-3 card main-card-m">
            <div class="page-title-heading page-title-heading-m">
                <h3>SYSTEM - <small>Contractor Management</small></h3>
            </div>

            <hr class="page-title-hr" />
            <div class="main-card mb-3 card">
                 <div class="card-body card-body-m">
                        <h5 class="content-detail-title">Update Contractor - {{ $conData[0]->contractor_name }} </h5>

                        <div class="content-detail-btns">
                            <button onclick="window.location.href = '/contractors';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Contractors
                            </button>
                            <button onclick="window.location.href = '/register_contractor';" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Add Contractor
                            </button>
                            <button onclick="window.history.back();" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-app-black">
                                Back
                            </button>
                        </div>

                        <hr class="page-subtitle-hr" />
                        <form action="/{{$conData[0]->id}}/edit_contractor" method="POST">
                            @csrf
                        <div>
                            @if ($errors->any())
                                <h6><span class="text-danger">{{ $errors }}</span></h6>
                            @endif

                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-icon">
                                        <i class="metismenu-icon pe-7s-user"></i>
                                    </span>
                                </div>
                                <input placeholder="Contractor Name" 
                                       name="contractor_name" 
                                       class="form-control input-field form-control-m"
                                       pattern=".{3,100}" 
                                       type="text"
                                       value="{{$conData[0]->contractor_name}}"   
                                       required 
                                       title="3 characters minimum" />
                            </div>
                            <br />
                            <div class="input-group col-md-8">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6>Account Status</h6>
                                        </div>
                                        <div class="col-md-9">
                                            <fieldset class="position-relative form-group">
                                                <div class="position-relative form-check">
                                                    <label class="form-check-label">
                                                        <input name="status" value="1" type="radio" class="form-check-input" <?php echo ($conData[0]->status == 1) ? 'checked="checked"' : ''; ?> /> 
                                                        Active
                                                    </label>
                                                </div>
                                                <div class="position-relative form-check">
                                                    <label class="form-check-label">
                                                        <input name="status" value="0" type="radio" class="form-check-input" <?php echo ($conData[0]->status == 0) ? 'checked="checked"' : ''; ?> /> 
                                                        Disabled
                                                    </label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <hr />

                        <input type="hidden" name="con_id" value="{{ $conData[0]->id }}">
                        <button class="mt-1 btn btn-primary btn-app">Update</button>
                        <input class="btn btn-primary" type="reset" value="Clear Form">
                    </form>
                    </div>
            </div>
        </div>
</div>
@endsection