@extends('back-end.backend-master')

@section('admin-title')
    {{ $create }}
@endsection

@section('admin-content')
<div class="row">
    <div class="col-12 form-area">
        <div class="col-md-8">
            <div class="card">
                <form class="form-horizontal" action="{{ route('free-shipping-limit.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $create }}
                            <a href="{{ route('free-shipping-limit.index') }}" class="btn btn-sm btn-info float-end">
                                <i class="fa fa-eye"></i> All Link Type
                            </a>
                        </h4>

                        <div class="form-group row">
                            <label class="col-md-3" for="amount">Limit Amount</label>
                            <div class="col-md-9">
                                <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount" required>
                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label class="col-md-3" for="description">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" id="sinan" class="form-control" placeholder="Description" required></textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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
    .form-area {
        padding: 30px 0px;
        background: #fff;
    }
</style>
@endpush
