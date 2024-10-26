<style>
    .sidebar {
  min-height: 300px;
  background-color: #fff !important;
  border-right: 1px solid #dee2e6;
  padding-bottom: 20px;
}

.profile-section h4 {
  margin-top: 20px;
  font-size: 18px;
}

.profile-section p {
  margin-top: -8px;
}

.nav-link {
  font-size: 16px;
  padding: 10px;
}

.nav-link.active {
  background-color: #0dcaf0;
  color: white;
  padding: 5px 10px;
}

.nav-link.active:hover{
  background-color: #0dcaf0;
  color: white;
}

.sidebar ul li a{
  padding:5px 5px;
  color:#000;
  font-size:15px;
}

.sidebar ul li a:hover {
  color: #000;
  background-color: #f8f8f8;
  border-radius: 0;
}

.nav-link i {
  margin-right: 5px;
}

.card {
  border: none;
  /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
  border-radius: 0;
  border: 1px solid rgba(0,0,0,.1);
}

.card-title {
  font-size: 18px;
  margin-bottom: 10px;
}

.card-body h2 {
  font-size: 36px;
  font-weight: bold;
}

.list-group-item {
  border: none;
  padding: 10px 0;
}

.h2{
  margin-bottom:0!important;
}

.user-dashbaord-area .breadcrumb-area {
	padding: 5px 0;
	margin-top: 0px;
    border-bottom: 0;
}

.user-dashbaord-area .breadcrumb {
	background-color: transparent;
	padding: 5px 0;
	margin-bottom: 0;
	float: right;
	margin-top: -40px;
}
.profile_text {
    font-size: 18px;
    font-weight: 500;
    margin-left: -10px;
}
</style>

<nav class="col-md-3 col-lg-3 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <div class="profile-section text-center p-3">
            @if(Auth::user()->image)
                <img src="{{ asset('front-end/assets/images/user/'.Auth::user()->image) }}" alt="Profile" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
            @else
                <img src="{{ asset('front-end/assets/images/user/user.png') }}" alt="Profile" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
            @endif
            <h4>{{ Auth::user()->name }}</h4>
            <p>{{ Auth::user()->email??'' }}</p>
          </div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('front.user.dashboard') }}">
                <i class="fa fa-dashboard"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('front.purchase.history') }}"><i class="fa fa-angle-right"></i>Purchase History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa fa-angle-right"></i>Refund Requests</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa fa-angle-right"></i>Wishlist</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('front.user.profile.update') }}"><i class="fa fa-angle-right"></i>Update Profile</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('front.user.change.password') }}"><i class="fa fa-angle-right"></i>
              Change Password
            </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('front.user.logout') }}"><i class="fa fa-angle-right"></i>
              Logout
            </a>
            </li>

          </ul>
        </div>
      </nav>