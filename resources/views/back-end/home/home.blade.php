@extends('back-end.backend-master')

@push('admin-styles')
<style>
  #todays_order-area{margin: 20px 0px;padding: 0}.category-title{border-bottom: 1px solid #002366;margin-bottom: 10px;position: relative}.category-title h4{text-transform: uppercase;font-weight: 600;font-size: 15px;color: #000;letter-spacing: 1px}.table thead{background: var(--btn-bg);background:#000;color: #fff}.cart-product table th{background: #0056b3;color: #fff}.cart-product table th{background: #e6f2ff;color: #000}.coupon-area{border: 1px solid rgba(0,0,0,.1);padding: 10px;height: 140px;margin-bottom: 10px}button.coupon-btn{color: #000;padding: 10px 25px;text-decoration: none;font-size: 16px;float: left;border: none;margin-top: 10px;border:1px solid #007bff;font-weight: 600}

.category{padding: 20px;background: #fff;margin: 0;border: 1px solid rgba(0,0,0,.1)}.update-btn{background: #002366;border: none;font-size: 12px;padding: 5px 5px;border-radius:3px;color: #fff}.trash-btn{background:transparent;color: #818a91}.trash-btn:hover{background:transparent;color: red}.quantity_input{width: 60px}.quantity-btn{width: 20px;}.nomi-cart-btn{font-size: 14px;background: #002366;padding: 10px 15px;margin: 0px 10px 0px 0px;color: #fff;transition: transform 0.3s ease}.nomi-cart-btn:hover{background: #ff6f00;transform: scale(1.05)}.continue-back{margin-top: 10px}
  </style>
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

          <section id="todays_order-area">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-12 category">
                        <div class="category-title">
                            <h4>Today's Ordered List</h4>
                        </div>
                        <div class="cart-product">
                            <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Date</th>
                                        <th>Order No.</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1;
                                        $total = 0; 
                                    @endphp

                                    @foreach($todaysOrder as $info)
                                   
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $info->date }}</td>
                                        <td>{{ $info->order_no }} &#2547;</td>
                                        <td>{{ $info->grand_total }}</td>
                                        <td>
                                            <a href="{{ route('admin.purchase.details', $info->id) }}" class="trash-btn">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                              {{ $todaysOrder->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('admin-scripts')

@endpush