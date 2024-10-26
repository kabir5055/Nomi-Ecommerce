@extends('back-end.backend-master')

@section('admin-title')
 {{ $create }}
@endsection

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('menu.store') }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                       {{ $create }}
                      <a href="{{ route('menu.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Menu
                        </a>
                    </h4>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Menu Name <span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="menu_name"
                          class="form-control"
                          id="name"
                          placeholder="Menu Name"
                        />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Menu Link <span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="menu_url"
                          class="form-control"
                          id="name"
                          placeholder="Menu Link"
                        />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Menu Position <span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="menu_position"
                          class="form-control"
                          id="name"
                          placeholder="Menu Position"
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