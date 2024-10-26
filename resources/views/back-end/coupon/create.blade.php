@extends('back-end.backend-master')

@section('admin-title')
 {{ $create }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       {{ $create }}
                      <a href="{{ route('coupon.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Coupon
                        </a>
                    </h4>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Coupon Code <span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="coupon_code"
                          class="form-control"
                          id="name"
                          placeholder="Name"
                        />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Amount <span class="text-danger">*</span></label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="amount"
                          class="form-control"
                          id="name"
                          placeholder="Discount"
                        />
                      </div>
                    </div>

                    <!--  <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label">Date</label>
                      <div class="col-sm-4">
                        <input
                          type="date" name="date"
                          class="form-control"
                          id="name"
                          placeholder="Date"
                        />
                      </div>

                      <div class="col-sm-1">
                        <span style="font-size: 25px;font-weight: 500;">To</span>
                      </div>

                       <div class="col-sm-4">
                        <input
                          type="date" name="date"
                          class="form-control"
                          id="name"
                          placeholder="Date"
                        />
                      </div>
                    </div> -->


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