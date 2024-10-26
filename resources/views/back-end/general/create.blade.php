@extends('back-end.backend-master')

@section('admin-title')
 {{ $create }}
@endsection

@section('admin-content')
<div class="row">
    <div class="col-12 form-area">
        <div class="col-md-8">
            <div class="card">
                <form class="form-horizontal" action="{{ $action }}" method="POST">
                    @csrf
                    @method($method === 'POST' ? 'POST' : 'PATCH')
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $create }}
                        </h4>

                        <div class="form-group row">
                            <label for="site_name" class="col-sm-3 control-label col-form-label">Site Name</label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="site_name"
                                    class="form-control"
                                    id="site_name"
                                    placeholder="Site Name"
                                    value="{{ $info->site_name ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-3 control-label col-form-label">Address <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="address"
                                    class="form-control"
                                    id="address"
                                    placeholder="Address"
                                    value="{{ $info->address ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 control-label col-form-label">E-Mail <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="email" name="email"
                                    class="form-control"
                                    id="email"
                                    placeholder="E-Mail"
                                    value="{{ $info->email ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 control-label col-form-label">Phone No <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="phone"
                                    class="form-control"
                                    id="phone"
                                    placeholder="Phone No"
                                    value="{{ $info->phone ?? '' }}"
                                />
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="description" class="col-sm-3 control-label col-form-label"> Description</label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="footer_text"
                                    class="form-control"
                                    id="description"
                                    placeholder="footer_text"
                                    value="{{ $info->footer_text ?? '' }}"
                                />
                            </div>
                        </div>

                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="fa fa-paper-plane"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin-styles')
<style>
    .form-area{
    padding:30px 0px;
    background: #fff;
  }
</style>
@endpush