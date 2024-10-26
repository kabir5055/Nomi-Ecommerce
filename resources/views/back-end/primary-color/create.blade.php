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
                            <label for="primary_color" class="col-sm-3 control-label col-form-label">Primary Color <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="color" name="primary_color"
                                    class="form-control"
                                    id="primary_color"
                                    placeholder="Primary Color"
                                    value="{{ old('primary_color', $info->primary_color ?? '#000000') }}"
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