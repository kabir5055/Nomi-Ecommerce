<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('admin-title')</title>
    <!-- Favicon icon -->
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{ asset('/') }}back-end/assets/images/favicon.png"/>

     <!-- <link rel="stylesheet" type="text/css" href="{{ asset('/') }}back-end/assets/libs/select2/dist/css/select2.min.css"/> -->

     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="{{ asset('/') }}back-end/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}back-end/assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('/') }}back-end/dist/css/style.min.css" rel="stylesheet" />
    <!-- toastr -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">


  </head>

  @stack('admin-styles')

  <body>
   
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
   
            <a class="navbar-brand" href="{{ route('home') }}">
              <!-- Logo icon -->
              <b class="logo-icon ps-2">

                @if(empty($logo->backend_logo))
                <span>{{ $general->site_name }}</span>
               
                @else
                <img
                  src="{{ asset('/') }}back-end/logo/{{ $logo->backend_logo }}"
                  class="light-logo" style="width:100px; height:50px;margin-left:50%;"
                  
                />
                @endif
              </b>
        

            </a>
  
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>
       
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
          
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>
              <!-- ============================================================== -->
              <!-- create new -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <span class="d-none d-md-block"
                    >Create New <i class="fa fa-angle-down"></i
                  ></span>
                  <span class="d-block d-md-none"
                    ><i class="fa fa-plus"></i
                  ></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              <li class="nav-item search-box">
                <a
                  class="nav-link waves-effect waves-dark"
                  href="javascript:void(0)"
                  ><i class="mdi mdi-magnify fs-4"></i
                ></a>
                <form class="app-search position-absolute">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Search &amp; enter"
                  />
                  <a class="srh-btn"><i class="mdi mdi-window-close"></i></a>
                </form>
              </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
              <!-- ============================================================== -->
              <!-- Comment -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="mdi mdi-bell font-24"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Messages -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle waves-effect waves-dark"
                  href="#"
                  id="2"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="font-24 mdi mdi-comment-processing"></i>
                </a>
                <ul
                  class="
                    dropdown-menu dropdown-menu-end
                    mailbox
                    animated
                    bounceInDown
                  "
                  aria-labelledby="2"
                >
                  <ul class="list-style-none">
                    <li>
                      <div class="">
                        <!-- Message -->
                        <a href="javascript:void(0)" class="link border-top">
                          <div class="d-flex no-block align-items-center p-10">
                            <span
                              class="
                                btn btn-success btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "
                              ><i class="mdi mdi-calendar text-white fs-4"></i
                            ></span>
                            <div class="ms-2">
                              <h5 class="mb-0">Event today</h5>
                              <span class="mail-desc"
                                >Just a reminder that event</span
                              >
                            </div>
                          </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)" class="link border-top">
                          <div class="d-flex no-block align-items-center p-10">
                            <span
                              class="
                                btn btn-info btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "
                              ><i class="mdi mdi-settings fs-4"></i
                            ></span>
                            <div class="ms-2">
                              <h5 class="mb-0">Settings</h5>
                              <span class="mail-desc"
                                >You can customize this template</span
                              >
                            </div>
                          </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)" class="link border-top">
                          <div class="d-flex no-block align-items-center p-10">
                            <span
                              class="
                                btn btn-primary btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "
                              ><i class="mdi mdi-account fs-4"></i
                            ></span>
                            <div class="ms-2">
                              <h5 class="mb-0">Pavan kumar</h5>
                              <span class="mail-desc"
                                >Just see the my admin!</span
                              >
                            </div>
                          </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)" class="link border-top">
                          <div class="d-flex no-block align-items-center p-10">
                            <span
                              class="
                                btn btn-danger btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "
                              ><i class="mdi mdi-link fs-4"></i
                            ></span>
                            <div class="ms-2">
                              <h5 class="mb-0">Luanch Admin</h5>
                              <span class="mail-desc"
                                >Just see the my new admin!</span
                              >
                            </div>
                          </div>
                        </a>
                      </div>
                    </li>
                  </ul>
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- End Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="{{ asset('/') }}back-end/assets/images/users/1.jpg"
                    class="rounded-circle"
                    width="31"
                  />  {{ Auth::user()->name }}
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end user-dd animated"
                  aria-labelledby="navbarDropdown"
                >
                  <a class="dropdown-item" href="{{ route('profile.change.password') }}"
                    ><i class="mdi mdi-account me-1 ms-1"></i>Profile</a
                  >
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                    ><i class="fa fa-power-off me-1 ms-1"></i> Logout
                  </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="{{ route('home') }}"
                  aria-expanded="false"
                  ><i class="mdi mdi-view-dashboard"></i
                  ><span class="hide-menu">Dashboard</span></a
                >
              </li>

             <!--  <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="#"
                  aria-expanded="false"
                  ><i class="mdi mdi-chart-bar"></i
                  ><span class="hide-menu">Charts</span></a
                >
              </li> -->
      
           
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">Product</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                  <li class="sidebar-item">
                    <a href="{{ route('category.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Category</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ route('subcategory.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Subcategory</span>
                    </a>
                  </li>

                   <li class="sidebar-item">
                    <a href="{{ route('unit.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Unit</span>
                    </a>
                  </li>

                   <li class="sidebar-item">
                    <a href="{{ route('brand.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Brand</span>
                    </a>
                  </li>
                  
                   <li class="sidebar-item">
                    <a href="{{ route('color.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Color</span>
                    </a>
                  </li>


                   <li class="sidebar-item">
                    <a href="{{ route('size.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Size</span>
                    </a>
                  </li>
                  

                  <li class="sidebar-item">
                    <a href="{{ route('product.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Product</span>
                    </a>
                  </li>

                </ul>
              </li>

               <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="{{ route('order.list') }}"
                  aria-expanded="false"
                  ><i class="mdi mdi-chart-bar"></i
                  ><span class="hide-menu">Order Products</span></a
                >
              </li>

               <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">E-commerce Setup</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                  <li class="sidebar-item">
                    <a href="{{ route('coupon.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Coupon</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ route('shipping-charge.create') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Shipping Charge</span>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">FrontEnd Settings</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                    <li class="sidebar-item">
                      <a href="{{ route('page.index') }}" class="sidebar-link">
                        <i class="mdi mdi-note-outline"></i>
                        <span class="hide-menu">Pages</span>
                      </a>
                    </li>

                    <li class="sidebar-item">
                      <a href="{{ route('notice.index') }}" class="sidebar-link">
                        <i class="mdi mdi-note-outline"></i>
                        <span class="hide-menu">Notice</span>
                      </a>
                    </li>

                    <li class="sidebar-item has-arrow">
                      <a href="javascript:void(0)" class="sidebar-link" aria-expanded="false">
                        <i class="mdi mdi-note-outline"></i>
                        <span class="hide-menu">Links</span>
                      </a>
                      <ul aria-expanded="false" class="collapse second-level">
                        <li class="sidebar-item">
                          <a href="{{ route('link_type.index') }}" class="sidebar-link">
                            <i class="mdi mdi-note-outline"></i>
                            <span class="hide-menu">Link Type</span>
                          </a>
                        </li>
                        <li class="sidebar-item">
                          <a href="{{ route('link.index') }}" class="sidebar-link">
                            <i class="mdi mdi-note-outline"></i>
                            <span class="hide-menu">Links</span>
                          </a>
                        </li>
                      </ul>
                    </li>

                   <li class="sidebar-item">
                    <a href="{{ route('menu.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Menu</span>
                    </a>
                  </li>
                  
                  <li class="sidebar-item">
                    <a href="{{ route('free-shipping-limit.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Free Shipping Limit</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ route('social.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Social</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ route('slider.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Slider</span>
                    </a>
                  </li>

                   <li class="sidebar-item">
                    <a href="{{ route('banner.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Banner</span>
                    </a>
                  </li>


                  <li class="sidebar-item">
                    <a href="{{ route('logo.index') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Logo</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ route('general.create') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">General</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ route('primary-color.create') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Color</span>
                    </a>
                  </li>

                </ul>
              </li>


              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">Reports</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">

                  <li class="sidebar-item">
                    <a href="{{ route('report.stock') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Stock Report</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ route('report.product.wise.sale') }}" class="sidebar-link">
                      <i class="mdi mdi-note-outline"></i>
                      <span class="hide-menu">Product Wise Sale</span>
                    </a>
                  </li>

                </ul>
              </li>
              
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      
      <div class="page-wrapper">
    
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Dashboard</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Library
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
       
        <div class="container-fluid">
           @yield('admin-content')
        </div>
   
        <footer class="footer text-center">
          All Rights Reserved by {{ $general->site_name??'' }}. Developed by
          <a href="https://www.emanagerit.com">eManager</a>.
        </footer>
       
      </div>
   
    </div>
    
    <script src="{{ asset('/') }}back-end/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/') }}back-end/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}back-end/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{ asset('/') }}back-end/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('/') }}back-end/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('/') }}back-end/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('/') }}back-end/dist/js/custom.min.js"></script>
<!-- 
    <script src="{{ asset('/') }}back-end/assets/libs/select2/dist/js/select2.full.min.js"></script> -->
  <!--   <script src="{{ asset('/') }}back-end/assets/libs/select2/dist/js/select2.min.js"></script> -->

    <script src="{{ asset('/') }}back-end/assets/libs/flot/excanvas.js"></script>
    <script src="{{ asset('/') }}back-end/assets/libs/flot/jquery.flot.js"></script>
    <script src="{{ asset('/') }}back-end/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="{{ asset('/') }}back-end/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="{{ asset('/') }}back-end/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="{{ asset('/') }}back-end/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="{{ asset('/') }}back-end/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="{{ asset('/') }}back-end/dist/js/pages/chart/chart-page-init.js"></script>
    <!--  toastr -->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    {!! Toastr::message() !!}


    <script>
        function readMultipleFiles(input) {
            if (input.files) {
                var filesArray = Array.from(input.files);
                filesArray.forEach(function(file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var imgElement = document.createElement('img');
                        imgElement.src = e.target.result;

                        var imageContainer = document.createElement('div');
                        imageContainer.classList.add('image-container');

                        var deleteBtn = document.createElement('button');
                        deleteBtn.innerText = 'X';
                        deleteBtn.classList.add('delete-btn');
                        deleteBtn.addEventListener('click', function() {
                            imageContainer.remove();
                        });

                        imageContainer.appendChild(imgElement);
                        imageContainer.appendChild(deleteBtn);
                        document.getElementById('imageContainer').appendChild(imageContainer);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }

        document.getElementById('multipleImage').addEventListener('change', function () {
            // Clear previous images
            document.getElementById('imageContainer').innerHTML = '';
            readMultipleFiles(this);
        });

        function readSingleFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#singleImage").change(function () {
            readSingleFile(this);
        });
        
    </script>

    <script>
        $(document).ready(function() {
            $('.select2-single').select2({
                placeholder: "Select Here",
                allowClear: true
            });

            $('.select2-multiple').select2({
                placeholder: "Select Here",
                allowClear: true
            });
        });
    </script>

    <script>
      let table = new DataTable('#myTable');

      new DataTable('#example', {
          paging: false,
          scrollCollapse: true,
          scrollY: '500px'
      });
    </script>

<script>
      $('#sinan').summernote({
        placeholder: 'Content...',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>

  

    @stack('admin-scripts')
  </body>
</html>
