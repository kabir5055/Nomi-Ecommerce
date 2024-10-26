<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $general->site_name??'' }} || Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/') }}back-end/assets/images/favicon.png"/>
    <!-- Custom CSS -->
    <link href="{{ asset('/') }}back-end/dist/css/style.min.css" rel="stylesheet" />
    
  </head>

  <style>
    .auth-wrapper.d-flex.no-block.justify-content-center.align-items-center.bg-dark {
       padding: 100px 0px 250px 0px;
    }
    #loginform {
	background: #fff;
	padding: 0px 20px;
}
.bg-dark {
	background-color: #f8f8f8 !important;
}
  </style>

  <body>
    <div class="main-wrapper">
      <!-- ============================================================== -->
      <!-- Login box.scss -->
      <!-- ============================================================== -->
      <div
        class="
          auth-wrapper
          d-flex
          no-block
          justify-content-center
          align-items-center
          bg-dark
        "
      >
        <div class="auth-box bg-dark border-secondary">
          <div id="loginform">
            <div class="text-center pt-3 pb-3">
                 
                 @if(empty($logo->backend_logo))
                <h1>
                    {{ $general->site_name }}
                </h1>
                @else

              <span class="db">
                <img src="{{ asset('/') }}back-end/logo/{{ $logo->backend_logo }}" style="width:200px;height:100px;"/>
              </span>
              @endif

            </div>
            <!-- Form -->
            <form class="form-horizontal mt-3" id="loginform" action="{{ route('login') }}" method="POST">
                @csrf
              <div class="row pb-4">
                <div class="col-12">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span
                        class="input-group-text bg-success text-white h-100"
                        id="basic-addon1"
                        ><i class="mdi mdi-email fs-4"></i
                      ></span>
                    </div>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1"/>
                    
                  </div>
                   @error('email')
                        <span class="text-danger pb-3">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span
                        class="input-group-text bg-warning text-white h-100"
                        id="basic-addon2"
                        ><i class="mdi mdi-lock fs-4"></i
                      ></span>
                    </div>
                    <input
                      type="password" name="password"
                      class="form-control form-control-lg"
                      placeholder="Password"
                      aria-label="Password"
                      aria-describedby="basic-addon1"/>
                  </div>
                   @error('password')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="row border-top border-secondary">
                <div class="col-12">
                  <div class="form-group">
                    <div class="pt-3">
                      <button
                        class="btn btn-info"
                        id="to-recover"
                        type="button"
                      >
                        <i class="mdi mdi-lock fs-4 me-1"></i> Lost password?
                      </button>
                      <button
                        class="btn btn-success float-end text-white"
                        type="submit"
                      >
                        Login
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

          
        </div>
      </div>
    
    </div>

    <script src="{{ asset('/') }}back-end/assets/libs/jquery/dist/jquery.min.js"></script>

    <script src="{{ asset('/') }}back-end/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
     
      $("#to-recover").on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
      });
      $("#to-login").click(function () {
        $("#recoverform").hide();
        $("#loginform").fadeIn();
      });
    </script>
  </body>
</html>
