<style>
    .collapse-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.collapse-item i {
    margin-left: 5px; /* Adjust spacing as needed */
}

</style>


@php 
$admin = Auth::guard('web')->user()->role_id;


@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
<body class="" style="
  background: #ff6600; /* Fallback color (Orange) */
  background: -webkit-linear-gradient(to right, #ff6600, #ff6600); /* Safari 5.1 to 6.0 */
  background: linear-gradient(to right, #ff6600, #ff6600); /* Standard syntax */
">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
         <!-- <img src="https://thumbs.dreamstime.com/b/car-mechanic-concept-avatar-vector-illustration-graphic-design-135452674.jpg" width="80px" height="80px" alt=""> -->

                                    
    </div>
    <img src="{{asset('sitelogo/logo.jpg')}}" style="width: 70ox;height:70px;" alt="">

    <div class="sidebar-brand-text mx-1">{{ __('sidebar.car_project') }}</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<input type="text" id="sidebarSearchInput" class="form-control" placeholder="{{ __('sidebar.search') }}">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{url('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('sidebar.dashboard') }}</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">



<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">

        <i class="fa-solid fa-car text-light"></i>

        <span>{{ __('sidebar.showroom') }}</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
   
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">{{ __('sidebar.car_showroom') }}:</h6>
            <a class="collapse-item" href="{{route('admin.car_showroom')}}">{{ __('sidebar.view') }}</a>
          
        </div>
    </div>
</li>

<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">

        <i class="fa-solid fa-globe text-light"></i>
        <span>CMS</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <h6 class="collapse-header">Competition Entries:</h6>
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Settings:</h6>
            <a class="collapse-item" href="login.html">Messages</a>
            <a class="collapse-item" href="register.html">Services</a>
            <a class="collapse-item" href="forgot-password.html">Coupouns</a>
            <div class="collapse-divider"></div>
            <a class="collapse-item" href="404.html">Slider</a>
            <a class="collapse-item" href="blank.html">Modules</a>
        </div>
    </div>
</li> -->


<!-- Nav Item - Pages Collapse Menu -->

<!-- <hr class="sidebar-divider"> -->

<!-- Nav Item - Charts -->
<!-- <li class="nav-item">
    <a class="nav-link" href="charts.html">
    
        <i class="fa-solid fa-person-circle-question text-light"></i>
        <span>Roles</span></a>
</li> -->
<!-- <hr class="sidebar-divider"> -->

<!-- Nav Item - Tables -->
<!-- <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-user text-light"></i>
        <span>User</span></a>
</li> -->

<!-- Divider -->
<!-- <hr class="sidebar-divider d-none d-md-block"> -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>

