@extends('back-end.backend-master')

@push('admin-styles')

@endpush

@section('admin-title')
{{ $general->site_name??'' }} || Dashboard
@endsection

@section('admin-content')
 <div class="row">

            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <a href="{{ route('order.list') }}">
                  <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    {{ $totalOrder??'0' }}
                  </h1>
                  <h6 class="text-white">Total Order</h6>
                </div>
                </a>
              </div>
            </div>
            <!-- Column -->

            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <a href="{{ route('category.index') }}">
                  <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    {{ $totalCategory??'0' }}
                  </h1>
                  <h6 class="text-white">Total Category</h6>
                </div>
                </a>
              </div>
            </div>
            <!-- Column -->

            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                 <a href="{{ route('product.index') }}">
                    <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    {{ $totalProduct??'0' }}
                  </h1>
                  <h6 class="text-white">Total Product</h6>
                </div>
                 </a>
              </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
               <a href="{{ route('brand.index') }}">
                  <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    {{ $totalBrand??'0' }}
                  </h1>
                  <h6 class="text-white">Total Brand</h6>
                </div>
               </a>
              </div>
            </div>
            <!-- Column -->

            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <a href="{{ route('order.todays') }}">
                  <div class="box bg-info text-center">
                  <h1 class="font-light text-white">
                    {{ $todayOrders??'0' }}
                  </h1>
                  <h6 class="text-white">Today's Order</h6>
                </div>
                </a>
              </div>
            </div>
            <!-- Column -->

              <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <a href="{{ route('get.subscribers') }}">
                  <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    {{ $totalSubscriber??'0' }}
                  </h1>
                  <h6 class="text-white">All Subscriber</h6>
                </div>
                </a>
              </div>
            </div>
            <!-- Column -->
          
          </div>
@endsection

@push('admin-scripts')

@endpush