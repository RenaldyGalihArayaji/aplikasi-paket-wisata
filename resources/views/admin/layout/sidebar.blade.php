<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard')}}">
      <div class="sidebar-brand-icon">
        @php
          $setting = DB::table('settings')->where('id',1)->first();
        @endphp

        <img src="{{ asset('storage/image_settings/' . $setting->logo) }}" alt="" class="img-fluid rounded-circle" style="width: 7vh; height: 7vh; object-fit: cover;">
      </div>
      <div class="sidebar-brand-text mx-1 px-1">{{ ucwords($setting->name_app) }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::segment(1) == 'role' ? 'dashboard' : ''}}">
      <a class="nav-link" href="{{ route('dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Interface
    </div>

    <!-- Data Users -->
    <li class="nav-item {{ Request::segment(1) == 'users' ? 'active' : ''}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa-solid fa-users"></i>
        <span>Data Pengguna</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Data Pengguna</h6>
          <a class="collapse-item {{ Request::segment(2) == 'admin' ? 'active' : '' }}" href="{{ route('admin.index')}}">Kelola Admin</a>
          <a class="collapse-item {{ Request::segment(2) == 'member' ? 'active' : '' }}" href="{{ route('users.member')}}">Data Customer</a>
        </div>
      </div>
    </li>

    <!-- master -->
    <li class="nav-item {{ Request::segment(1) == 'masters' ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#component" aria-expanded="true" aria-controls="component">
            <i class="fa-solid fa-sliders"></i>
            <span>Data Master</span>
        </a>
        <div id="component" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Master</h6>
            <a class="collapse-item {{ Request::segment(2) == 'tour' ? 'active' : ''}}" href="{{ route('tour.index')}}">Kelola Wisata</a>
            <a class="collapse-item {{ Request::segment(2) == 'hotel' ? 'active' : ''}}" href="{{ route('hotel.index')}}">Kelola Hotel</a>
            <a class="collapse-item {{ Request::segment(2) == 'tour-package' ? 'active' : ''}}" href="{{ route('tour-package.index')}}">Kelola Paket Wisata</a>
          </div>
        </div>
    </li>

     <!-- Orders -->
     <li class="nav-item {{ Request::segment(1) == 'order-admin' ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Orders" aria-expanded="true" aria-controls="Orders">
            <i class="fa-solid fa-paper-plane"></i>
            <span>Data Pesanan</span>
        </a>
        <div id="Orders" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Pesanan</h6>
            <a class="collapse-item {{ Request::segment(2) == 'order-package-admin' ? 'active' : ''}}" href="{{ route('order-package-admin.index')}}">Paket Wisata</a>
            <a class="collapse-item {{ Request::segment(2) == 'order-hotel-admin' ? 'active' : ''}}" href="{{ route('order-hotel-admin.index')}}">Hotel</a>
          </div>
        </div>
    </li>

     <!-- report -->
     <li class="nav-item {{ Request::segment(1) == 'reports' ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report" aria-expanded="true" aria-controls="report">
            <i class="fa-solid fa-book-open"></i>
            <span>Data Laporan</span>
        </a>
        <div id="report" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Orders</h6>
            <a class="collapse-item {{ Request::segment(2) == 'report-package' ? 'active' : ''}}" href="{{ route('reportPackage')}}">Paket Wisata</a>
            <a class="collapse-item {{ Request::segment(2) == 'report-hotel' ? 'active' : ''}}" href="{{ route('reportHotel')}}">Hotel</a>
          </div>
        </div>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>