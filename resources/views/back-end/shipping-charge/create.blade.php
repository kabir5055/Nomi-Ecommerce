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
                            <label for="inside_charge" class="col-sm-3 control-label col-form-label">Inside Charge <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="inside_charge"
                                    class="form-control"
                                    id="inside_charge"
                                    placeholder="Inside Charge"
                                    value="{{ $info->inside_charge ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="outside_charge" class="col-sm-3 control-label col-form-label">Outside Charge <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="outside_charge"
                                    class="form-control"
                                    id="outside_charge"
                                    placeholder="Outside Charge"
                                    value="{{ $info->outside_charge ?? '' }}"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="free_charge" class="col-sm-3 control-label col-form-label">Free Charge <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="text" name="free_charge"
                                    class="form-control"
                                    id="free_charge"
                                    placeholder="Free Charge"
                                    value="{{ $info->free_charge ?? '' }}"
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