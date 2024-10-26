@extends('back-end.backend-master')

@section('admin-title')
    {{ $edit }}
@endsection

@section('admin-content')
<div class="row">
    <div class="col-12 form-area">
        <div class="col-md-8">
            <div class="card">
                <form class="form-horizontal" action="{{ route('social.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $edit }}
                            <a href="{{ route('link_type.index') }}" class="btn btn-sm btn-info float-end">
                                <i class="fa fa-eye"></i> All Link Type
                            </a>
                        </h4>

                        <div class="form-group row">
                            <label class="col-md-3" for="facebook">Facebook</label>
                            <div class="col-md-9">
                                <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $info->facebook }}">
                                @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="twitter">Twitter</label>
                            <div class="col-md-9">
                                <input type="text" name="twitter" id="twitter" class="form-control" value="{{ $info->twitter }}">
                                @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="linkedin">Linkedin</label>
                            <div class="col-md-9">
                                <input type="text" name="linkedin" id="linkedin" class="form-control" value="{{ $info->linkedin }}">
                                @error('linkedin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="youtube">Youtube</label>
                            <div class="col-md-9">
                                <input type="text" name="youtube" id="youtube" class="form-control" value="{{ $info->youtube }}">
                                @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $info->id }}">

                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary float-end">
                                <i class="fa fa-paper-plane"></i> Update
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
    .form-area {
        padding: 30px 0px;
        background: #fff;
    }
</style>
@endpush
