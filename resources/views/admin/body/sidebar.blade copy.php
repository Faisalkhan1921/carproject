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
$admin = Auth::guard('admin')->user()->role_id;
if($admin)
{
    $roleperm = App\Models\adminhasrole::where('role_id',$admin)->first();
}

@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar"

style="
 background: #141e30; 
  background: -webkit-linear-gradient(to right, #141e30, #243b55); 
  background: linear-gradient(to right, #141e30, #243b55); 
"
>

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
         <img src="{{asset('sitelogo/logo.png')}}" width="80px" height="80px" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">FhFighers</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{route('admin.dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">



<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Admin Modules</span>
    </a>
    <div id="accordionSidebar">

    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Admin Modules:</h6>
            
           
            <a class="collapse-item" href="#" data-toggle="collapse" data-target="#collapseExercises" aria-expanded="true" aria-controls="collapseExercises">
                Exercises <i class="fas fa-chevron-down"></i>
            </a>
            <div id="collapseExercises" class="collapse" aria-labelledby="headingExercises" data-parent="#collapseTwo">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="exercise1.html">Exercise 1</a>
                    <a class="collapse-item" href="exercise2.html">Exercise 2</a>
                    <a class="collapse-item" href="exercise3.html">Exercise 3</a>
                </div>
            </div>
            
            <a class="collapse-item" href="admin-modules.html">Admin Modules</a>
            <a class="collapse-item" href="admin-routines.html">Admin Routines</a>
        </div>
    </div>

   
</div>
</li> -->

<!-- Nav Item - Utilities Collapse Menu -->
 @if($roleperm-> customermodule ==1 || $roleperm->customerroutine==1)
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <!-- <i class="fas fa-fw fa-cog"></i> -->
        <i class="fas fa-dumbbell text-light"></i>
        <span>Allot to Customers</span>
    </a>
   
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Allot to Customers:</h6>
        @if($roleperm->customermodule ==1)
            <a class="collapse-item" href="{{route('admin.module.index')}}">Customer Module</a>
        @endif
        @if($roleperm->customerroutine ==1)
            <a class="collapse-item" href="{{route('admin.customer.routines.index')}}"">Customer Routines</a>
            @endif          
        </div>
    </div>
</li>
@endif
<!-- <hr class="sidebar-divider"> -->

@if($roleperm-> exercise ==1 || $roleperm->workout==1 || $roleperm->routines==1)

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#library"
        aria-expanded="true" aria-controls="library">
        <i class="fa-solid fa-book text-light"></i>
        <span>Workouts Library</span>
    </a>
    <div id="library" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Workouts Library:</h6>
        @if($roleperm->exercise ==1)
            <a class="collapse-item" href="{{route('admin.exercise.index')}}">Exercises</a>
            @endif
        @if($roleperm->workout ==1)
            <a class="collapse-item" href="{{route('admin.module.library.index')}}">Workouts </a>
            @endif
        @if($roleperm->routines ==1)
            <a class="collapse-item" href="{{route('admin.module.library.routines.index')}}">Routines </a>
           @endif
        </div>
    </div>
</li>
@endif
<!-- Divider -->
<!-- <hr class="sidebar-divider"> -->
@if($roleperm->messages ==1)

<li class="nav-item">
    <a class="nav-link" href="{{route('admin.message.index')}}">
        <!-- <i class="fas fa-fw fa-cog"></i> -->
        <!-- <i class="fa-solid fa-person-circle-question text-light"></i> -->
        <i class="fa-solid fa-message text-light"></i>
        <span>Messages</span></a>
</li>
@endif

@if($roleperm->coupouns ==1)
<li class="nav-item">
    <a class="nav-link" href="{{route('admin.coupouns.index')}}">
        <!-- <i class="fas fa-fw fa-cog"></i> -->
        <!-- <i class="fa-solid fa-person-circle-question text-light"></i> -->
        <!-- <i class="fa-solid fa-message text-light"></i> -->
        <i class="fas fa-gift text-light"></i>
        <span>Coupouns</span></a>
</li>
@endif

@if($roleperm->membership ==1)
<li class="nav-item">
    <a class="nav-link" href="{{route('admin.membership.index')}}">
     
        <i class="fas fa-id-badge text-light"></i>
        <span>Memberships</span></a>
</li>
@endif


@if($roleperm-> competition ==1 || $roleperm->services==1 || $roleperm->slider==1)
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">

        <i class="fa-solid fa-globe text-light"></i>
        <span>CMS</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
     
        <div class="bg-white py-2 collapse-inner rounded">
@if($roleperm->competition ==1)
            <a class="collapse-item" href="{{route('admin.comp.index')}}">Competition Entries </a>
            @endif
@if($roleperm->services ==1)
            <a class="collapse-item" href="{{route('admin.services.index')}}">Services</a>
            @endif
@if($roleperm->slider ==1)
            <a class="collapse-item" href="{{route('admin.slider.index')}}"">Slider</a>
@endif
        </div>
    </div>
</li>
@endif

@if($roleperm-> user ==1 || $roleperm->adminroles==1 )
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#accounts"
        aria-expanded="true" aria-controls="accounts">

        <!-- <i class="fa-solid fa-globe text-light"></i> -->
    <i class="fas fa-user-lock text-light"></i>  

        <span>Accounts</span>
    </a>
    <div id="accounts" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
     
        <div class="bg-white py-2 collapse-inner rounded">
        
            <!-- <a class="collapse-item" href="{{route('admin.perm.index')}}">All Permissions </a> -->
@if($roleperm->user ==1)
            <a class="collapse-item" href="{{route('admin.roles.index')}}">Roles & Permission </a>
            @endif
            <!-- <a class="collapse-item" href="{{route('admin.rp.index')}}">Role In Permission </a> -->
@if($roleperm->adminroles ==1)
            <a class="collapse-item" href="{{route('admin.user.index')}}">Admin Users</a>
            @endif

        </div>
    </div>
</li>
@endif

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