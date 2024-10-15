<style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 250px; /* Adjust the width as needed */
            background: #ff6600; /* Fallback color (Orange) */
            background: linear-gradient(to right, #ff6600, #ff6600); /* Standard syntax */
            z-index: 1000; /* Make sure it's above other content */
            overflow-y: auto; /* Allow scrolling if content overflows */
        }

        .collapse-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
        }

        .collapse-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .sidebar-brand img {
            width: 70px;
            height: 70px;
            margin-right: 10px;
        }

        .sidebar-brand-text {
            color: white;
        }

        /* Additional styles for collapsible menu */
        .collapse-inner {
            background-color: #fff;
            color: #333;
            padding: 10px;
        }

        .collapse-header {
            font-weight: bold;
            padding: 10px 0;
        }

        .text-center {
            text-align: center;
            margin-top: auto; /* Pushes toggler to the bottom */
        }

        #sidebarToggle {
            cursor: pointer;
        }

        #content 
        {
            width:85%;margin-right:auto;
        }
        .collapsed #content {
        width: 93%;
    }
    </style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarToggle = document.getElementById("sidebarToggle");
        const sidebar = document.getElementById("accordionSidebar");

        sidebarToggle.addEventListener("click", function() {
            sidebar.classList.toggle("collapsed");
            const content = document.getElementById("content");
            if (sidebar.classList.contains("collapsed")) {
                content.style.width = "93%"; // Change to 90% when collapsed
            } else {
                content.style.width = "85%"; // Change back to 85% when expanded
            }
        });
    });
</script>


@php 
$admin = Auth::guard('web')->user()->role_id;
@endphp

<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <img src="{{ asset('sitelogo/logo.jpg') }}" alt="">
        <div class="sidebar-brand-text mx-1">{{ __('sidebar.car_project') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <input type="text" id="sidebarSearchInput" class="form-control" placeholder="{{ __('sidebar.search') }}">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('sidebar.dashboard') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fa-solid fa-car text-light"></i>
            <span>{{ __('sidebar.showroom') }}</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('sidebar.car_showroom') }}:</h6>
                <a class="collapse-item" href="{{ route('admin.car_showroom') }}">{{ __('sidebar.view') }}</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<!-- Your main content would go here -->
