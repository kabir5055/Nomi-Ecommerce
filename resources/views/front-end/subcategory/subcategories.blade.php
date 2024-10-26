@extends('front-end.master')

@section('meta_title')
  Subcategories
@endsection

@push('styles')

@endpush

@section('content')
<section id="featured-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="category-banner-image">
                        <img src="{{ asset('/') }}front-end/assets/images/b3.webp" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="featured-product-area" class="p-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12 featured-product">
                    <div class="category-title">
                        <h4>Featured Books</h4>
                    </div>
                    <div class="row">
                        
                       <!--  product box -->
                         <div class="col-md-3">
                            <div class="product-box">
                                <div class="product-image">
                                    <img src="{{ asset('/') }}front-end/assets/images/book1.webp" alt="">
                                </div>
                                <div class="product-content">
                                   
                                    <p>
                                        ভ্রমণের অজানা তথ্য
                                    </p>

                                    <h5>মোঃ ফরহাদ হায়দার </h5>

                                     <h4>
                                        <span class="opacity-40"><strike>500&#2547;</strike></span>
                                        <span>450&#2547;</span>
                                    </h4>

                                </div>
                                <div class="btn-area">
                                    <a href="" class='pbtn btn btn-sm btn-block'>
                                        <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                        add to cart
                                    </a>
                                </div>
                                <div class="offer">
                                    <p>Sale</p>
                                </div>
                            </div>
                        </div>
                       <!--  product box -->

                       <!--  product box -->
                         <div class="col-md-3">
                            <div class="product-box">
                                <div class="product-image">
                                    <img src="{{ asset('/') }}front-end/assets/images/book2.webp" alt="">
                                </div>
                                <div class="product-content">
                                   
                                    <p>
                                        আমি বেগমবাজারের মেয়ে
                                    </p>

                                    <h5>শান্তা মারিয়া </h5>

                                     <h4>
                                        <span class="opacity-40"><strike>500&#2547;</strike></span>
                                        <span>425&#2547;</span>
                                    </h4>

                                </div>
                                <div class="btn-area">
                                    <a href="" class='pbtn btn btn-sm btn-block'>
                                        <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                        add to cart
                                    </a>
                                </div>
                                <div class="offer">
                                    <p>Sale</p>
                                </div>
                            </div>
                        </div>
                       <!--  product box -->

                       <!--  product box -->
                         <div class="col-md-3">
                            <div class="product-box">
                                <div class="product-image">
                                    <img src="{{ asset('/') }}front-end/assets/images/book3.webp" alt="">
                                </div>
                                <div class="product-content">
                                   
                                    <p>
                                        বঙ্গবন্ধুর রাজনৈতিক অর্থনীতি
                                    </p>

                                    <h5>আবুল কাসেম </h5>

                                     <h4>
                                        <span class="opacity-40"><strike>850&#2547;</strike></span>
                                        <span>638&#2547;</span>
                                    </h4>

                                </div>
                                <div class="btn-area">
                                    <a href="" class='pbtn btn btn-sm btn-block'>
                                        <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                        add to cart
                                    </a>
                                </div>
                                <div class="offer">
                                    <p>Sale</p>
                                </div>
                            </div>
                        </div>
                       <!--  product box -->

                       <!--  product box -->
                         <div class="col-md-3">
                            <div class="product-box">
                                <div class="product-image">
                                    <img src="{{ asset('/') }}front-end/assets/images/book4.webp" alt="">
                                </div>
                                <div class="product-content">
                                   
                                    <p>
                                        রোগ ও পথ্য
                                    </p>

                                    <h5>পুষ্টিবিদ উম্মে সালমা তামান্না </h5>

                                     <h4>
                                        <span class="opacity-40"><strike>300&#2547;</strike></span>
                                        <span>255&#2547;</span>
                                    </h4>

                                </div>
                                <div class="btn-area">
                                    <a href="" class='pbtn btn btn-sm btn-block'>
                                        <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                        add to cart
                                    </a>
                                </div>
                                <div class="offer">
                                    <p>15% OFF</p>
                                </div>
                            </div>
                        </div>
                       <!--  product box -->
                        

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush