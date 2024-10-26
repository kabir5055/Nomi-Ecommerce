@extends('back-end.backend-master')

@section('admin-title')
    {{ $edit }}
@endsection

@section('admin-content')
<div class="row">
    <div class="col-12 form-area">
        <div class="col-md-8">
            <div class="card">
                <form class="form-horizontal" action="{{ route('link.update') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $edit }}
                            <a href="{{ route('link.index') }}" class="btn btn-sm btn-info float-end">
                                <i class="fa fa-eye"></i> All Links
                            </a>
                        </h4>

                        <div class="form-group row">
                            <label class="col-md-3" for="link_type_id">Link Type <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select name="link_type_id" id="link_type_id" class="form-control" required>
                                    <option value="">Select Link Type</option>
                                    @foreach($linkTypes as $linkType)
                                        <option value="{{ $linkType->id }}" {{ $info->link_type_id == $linkType->id ? 'selected' : '' }} >{{ $linkType->name }}</option>
                                    @endforeach
                                </select>
                                @error('link_type_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="link_name">Link <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="link_name" id="link_name" class="form-control" value="{{ $info->link_name }}" required>
                                @error('link_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3" for="url">UR <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="url" id="url" class="form-control" value="{{ $info->url }}" required>
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label class="col-md-3" for="description">Description <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea name="description" id="sinan" class="form-control" required>{{ $info->description }}</textarea>
                                @error('description')
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
