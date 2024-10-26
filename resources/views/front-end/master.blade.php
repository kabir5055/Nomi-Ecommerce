 <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('meta_title')</title>
     @php
      $logoInfo = \App\Models\Logo::first();
      $generalSetting = \App\Models\General::first();
     $menus = App\Models\Menu::orderBy('menu_position', 'asc')->select('menu_name', 'menu_url')->get();

    @endphp
    <link type="image/x-icon" href="{{ asset('/') }}back-end/logo/{{ $logoInfo->favicon ?? '' }}" rel="shortcut icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="{{ asset('/') }}front-end/assets/css/minify/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}front-end/assets/css/minify/responsive.css">

    <!-- <link rel="stylesheet" href="{{ asset('/') }}front-end/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}front-end/assets/css/responsive.css"> -->
    
   <link rel="stylesheet" href="//cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('styles')
    <style>
     .suggestions-list{position: absolute;background: #fff;border: 1px solid #ddd;border-radius: 4px;box-shadow: 0 4px 8px rgba(0,0,0,0.1);max-height: 200px;overflow-y: auto;z-index: 1000;width: 100%;list-style-type: none;padding: 0;margin: 0;display: none}.suggestions-list li{padding: 10px;cursor: pointer}.suggestions-list li:hover{background: #f1f1f1}.phone-info{float: right;margin-left: 15px;color: #fff}.phone-info span{animation: textZoom 3s infinite;font-weight: 400}@keyframes textZoom1{0%{color:white}50%{color:yellow}100%{color:orange}}

.phone-info1{float:left;color: #fff;font-size: 15px;font-weight: 400;margin:5px 15px 0px 0px;}.badge.shopping-cart-badge{background: #ff6f00;color: #fff}.cart a{background: #002366;padding: 10px 20px;color: #fff;margin-left: 75px;border: 1px solid rgba(0,0,0,1);border-radius: 5px}#nomi-menu-area{padding: 5px 0;border-bottom: 1px solid #e9e9e9;background-color: #fff}.navbar-nav{--bs-nav-link-padding-y: 0px !important;white-space: nowrap}.nav-link:focus, .nav-link:hover{color: #ff6f00}.mobile-icon{display: none}.productCountArea{display: none}@media (max-width: 768px){.menu-area .navbar-nav{flex-wrap: nowrap}.menu-area .navbar-collapse{overflow-x: auto}.menu-area .nav-link{padding: 10px 10px}.mobile-icon{position: absolute;right: 30px;top: 65px;display: block}.mobile-none{display: none}.offcanvas-header{background:#002366;margin: 0;padding: 2px 10px;color:#fff}.offcanvas-body ul li a{text-decoration: none;color: #000;font-size: 15px;border-bottom: 1px solid rgba(0,0,0,.3);padding: 5px 0px}.btn-close{--bs-btn-close-color: #fff;--bs-btn-close-bg:none}.cat-left-image{height: auto;margin-bottom: 10px}.productCountArea{display: block}.productCountArea{opacity: 1;cursor: pointer;position: fixed;width: 65px;height: 75px;background: #f5fceb;right: 0;top: calc(110px 30%);box-shadow: 0 0 16px -1px rgba(0,0,0,.75);transition: .1s ease-in-out;z-index: 9999}.itemCount{height: 50px;background: #002366;width: 100%}.total{height: 20px;width: 100%;font-weight: 700;text-align: center;font-size: 13px;padding-top: 5px}.itemCount i{text-align: center;margin-left: 26px;font-size: 16px;margin-top: 10px;color: #fdd670}.itemCount p{color: #fdd670;margin-top: -2px;margin-bottom: 0;font-weight: 700;font-size: 12px;text-align: center;padding-top: 0;text-transform: uppercase}}
.login-registration a {
  font-size: 15px;
  color:#fff
}

    </style>
  </head>
  <body>

      @php
      if (Auth::check()) {
        $info_id = Auth::id();
        $totalQuantity = App\Models\Cart::where('info_id', $info_id)->sum('quantity');
        $totalCartAmount = App\Models\Cart::where('info_id', $info_id)->sum('unit_total');
    } else {
        $info_id = Session::getId();
        $totalQuantity = App\Models\Cart::where('info_id', $info_id)->sum('quantity');
        $totalCartAmount = App\Models\Cart::where('info_id', $info_id)->sum('unit_total');
    }
      @endphp


     <div class="productCountArea">
      <a href="{{ route('front.cart') }}">
            <div class="itemCount">
              <i class="fa fa-shopping-bag"></i> 
              <p>{{ $totalQuantity }} item</p>
            </div>
            <div class="total">৳ {{ $totalCartAmount }}</div>
          </a>
      </div>

 <section id="header-top">
       <div class="container">
         <div class="row">
             <div class="col-md-6">
             <div class="phone-info1">
                    Call Us :
                    <span>{{ $general->phone??'' }}</span>
                 </div>

                  <div class="phone-info1 mobile-none">
                    E-Mail :
                    <span>{{ $general->email??'' }}</span>
                 </div>
             </div>
             <div class="col-md-6 top-right-1">
                 
                 <div class="login-registration text-white float-end mobile-none">
                  @if(!Auth::user())
                    <div class="log-info mt-1">
                      <i class="fa fa-user"></i>
                      <a href="{{ route('front.user.login') }}">
                      <span> Login </span>
                      </a> |
                      <a href="{{ route('front.user.register') }}">
                      <span>Registration</span>
                      </a>
                    </div>
                    @else
                    <div class="log-info mt-1">
                      <i class="fa fa-user"></i>
                      <a href="{{ route('front.user.dashboard') }}">
                      <span>My Profile </span>
                      </a>
                     </div>

                     <div class="log-info mt-1">
                      <i class="fa fa-logout"></i>
                      <a href="">
                         <span>Logout </span>
                      </a>
                     </div>
                    @endif
                 </div>

             </div>
         </div>
       </div>
    </section>

   <!--  header bottom -->
   <section id="header-bottom-area">
     <div class="container">
       <div class="row">
         <div class="col-md-3">
           <div class="logo">
               @if(isset( $logoInfo->frontend_logo))
               <a href="{{ route('front.home') }}">
                 <img src="{{ asset('/') }}back-end/logo/{{ $logoInfo->frontend_logo ?? '' }}" alt="">
               </a>
               @else
                 <a href="{{ route('front.home') }}">{{ $generalSetting->site_name??"Nomifood" }}
                 </a>
               @endif
               <!-- <img src="assets/images/logo1.png" alt=""> -->
           </div>
         </div>
         <div class="col-md-7">
           <div class="search">
              <form action="{{ route('front.search.products') }}" method="POST">
                @csrf
                <input type="text" name="search_item" class="form-control" placeholder="Search Products">
                <button type="submit" class="newhome-search">
                    <i class="fa fa-search"></i>
                </button>
              </form>
              <ul id="suggestions" class="suggestions-list"></ul>
           </div>
         </div>

         <div class="col-md-2 mobile-none">
           <div class="cart">
             <a href="{{ route('front.cart') }}">
              <i class="fa fa-shopping-cart"></i>
               <span class="badge shopping-cart-badge" style="font-size: .6rem; font-weight: bold; margin-left: 0;">({{ $totalQuantity }})
                </span>

             </a>
           </div>
         </div>
       </div>
     </div>
   </section>
   <!--  header bottom -->



   <section id="nomi-menu-area">
  <div class="container">
    <div class="menu-area">
      <nav class="navbar navbar-expand-lg">
        <div class="navbar-collapse">
          <ul class="navbar-nav d-flex flex-row flex-nowrap overflow-auto">

          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/shop">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="/categories">Categories</a></li>
          <li class="nav-item"><a class="nav-link" href="/brands">Brand</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact">Contact Us</a></li>

          @foreach($menus as $menu)
            <li class="nav-item">
                <a class="nav-link" href="{{ $menu->menu_url }}">
                    {{ $menu->menu_name }}
                </a>
            </li>
          @endforeach

          </ul>
        </div>
      </nav>
    </div>
  </div>
</section>

<!-- Mobile Menu Icon -->
<div class="mobile-icon" data-bs-toggle="offcanvas" href="#offcanvasScrolling" role="button" aria-controls="offcanvasScrolling">
    <i class="fa fa-bars"></i>
</div>

<!-- Offcanvas Menu -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">All Categories</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
          @foreach($frontCategories as $frontCategory)
            <li class="nav-item">
              <a class="nav-link" href="#">
                {{ $frontCategory->cat_name }}
              </a>
            </li>
          @endforeach
       
    </ul>
  </div>
</div>



   @yield('content')


    <!-- subscribe area -->
 <section id="subscripbe-area">
    <div class="container">
      <div class="row">
          <div class="col-md-12 subscribe">
              <div class="row">
                  <div class="col-md-7">
                      <div class="subscribe-content">
                          <h4>Subscribe for News Letter</h4>
                          <p>
                            Sign up for emails and receive early access to new event & more, After signing up, check your inbox for details.
                          </p>
                      </div>
                  </div>
                  <div class="col-md-5">
                    <div class="col-md-12 subscribe-form">
                        <form action="{{ route('front.subscribe') }}" method="POST">
                                @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                                <button type="submit" class="btn btn-sm subscribe_btn">
                                  <i class="fa fa-bell"></i> Subscribe
                               </button>
                                
                            </div>
                        </form>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
 </section>
 <!-- subscribe area -->

 <!-- footer area -->
 <section id="footer-area">
    <div class="container">
      <div class="row">
        <div class="col-md-12 footer">
          <div class="row">

            <div class="col-md-3">
                <div class="footer-box">
                    <div class="footer-title">
                      <h4>about us</h4>
                    </div>
                    <div class="footer-about-content">
                      <p>
                        {{ $general->footer_text??'' }}
                      </p>
                    </div>
                    <div class="social-icon">
                        <ul>
                          <li><a href="{{ $social->facebook }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                          <li><a href="{{ $social->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>
                          <li><a href="{{ $social->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a></li>
                          <li><a href="{{ $social->youtube }}"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @foreach($linkTypes as $linkType)
              <div class="col-md-3">
                  <div class="footer-box">
                      <div class="footer-title mpt-20">
                          <h4>{{ $linkType->name }}</h4>
                      </div>
                      <div class="footer-about-list">
                          <ul>
                              @foreach($linkType->links as $info)
                                <li><a href="{{ $info->url }}"><i class="fa fa-angle-double-right"></i>{{ $info->link_name }}</a></li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
            @endforeach


            <div class="col-md-3">
                <div class="footer-box">
                    <div class="footer-title mpt-20">
                      <h4>Contact Us</h4>
                    </div>
                    <div class="about-list">

                        <div class="list-box">
                          <div class="row">
                              <div class="col-md-2 box">
                                 <div class="footer-icon">
                                     <i class="fa fa-map-marker"></i>
                                 </div>
                              </div>
                              <div class="col-md-10 list">
                                <div class="list-box-content">
                                    <p>
                                       {{ $general->address }}
                                    </p>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="list-box">
                          <div class="row">
                              <div class="col-md-2 box">
                                 <div class="footer-icon">
                                     <i class="fa-solid fa-envelope"></i>
                                 </div>
                              </div>
                              <div class="col-md-10 list">
                                <div class="list-box-content">
                                    <p>
                                       {{ $general->email??'' }}
                                    </p>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="list-box">
                          <div class="row">
                              <div class="col-md-2 box">
                                 <div class="footer-icon">
                                     <i class="fa fa-phone"></i>
                                 </div>
                              </div>
                              <div class="col-md-10 list">
                                <div class="list-box-content">
                                    <p>
                                       {{ $general->phone }}
                                    </p>
                                </div>
                              </div>
                          </div>
                        </div>

                    </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
 </section>
 <!-- footer area -->


<!--  copyright area -->
 <section id="copyright-area">
   <div class="container">
     <div class="row">
       <div class="col-md-12 copyright">
            <div class="left-text">
              <p>
                Copyright &copy; 2024 - {{ $general->site_name }}.  All Rights Reserved.
              </p>
            </div>

            <div class="right-text">
              <p>
                Design & Developed By <a href="https://www.emanagerit.com/" style="color:#fff">eManager</a>
              </p>
            </div>

       </div>
     </div>
   </div>
 </section>
<!--  copyright area -->


    <!-- <script src="./assets/js/jquery-3.7.1.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script> -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     <script type="text/javascript">

         $('.apon').slick(
         {
            autoplay:true,
            autoplaySpeed:2000,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            mouseDrag:true,
            arrow:true,
            responsive: [
            {
              breakpoint: 575,
              settings: {
              slidesToShow: 1,
              slidesToScroll: 1
              }
            },
            {
              breakpoint: 768,
              settings: {
              slidesToShow: 2,
              slidesToScroll: 2
              }
            }
           ]
         }
         );

        </script>

  </body>
</html>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="//cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @stack('scripts')
  </body>
</html>

<script>
  $(document).ready((function(){$("#search_item").on("input",(function(){var t=$(this).val();t.length>0?$.ajax({url:"{{ route('front.search.suggest') }}",method:"POST",data:{_token:"{{ csrf_token() }}",query:t},success:function(t){$("#suggestions").empty(),t.length>0?$.each(t,(function(t,e){$("#suggestions").append("<li>"+e.name+"</li>")})):$("#suggestions").append("<li>No suggestions found</li>")}}):$("#suggestions").empty()})),$(document).on("click","#suggestions li",(function(){$("#search_item").val($(this).text()),$("#suggestions").empty()}))}));

</script>

<script>
document.addEventListener("DOMContentLoaded",(function(){let e=document.querySelectorAll(".lazyload"),t=new IntersectionObserver((function(e,t){e.forEach((function(e){if(e.isIntersecting){let n=e.target;n.src=n.dataset.src,n.classList.remove("lazyload"),t.unobserve(n)}}))}));e.forEach((function(e){t.observe(e)}))}));
</script>
