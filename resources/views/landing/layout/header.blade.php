<header id="header" class="d-flex align-items-center shadow" style="background-color: #f82249">
    <div class="container container-xxl d-flex align-items-center">

      @php
        $setting = DB::table('settings')->where('id',1)->first();
      @endphp

      {{-- <div id="logo" class="me-auto">
        <h1><a href="{{ route('home')}}">{{ $setting->name_app}}</a></h1>
      </div> --}}

      <div class="me-auto">
        <img src="{{ asset('storage/image_settings/' . $setting->logo) }}" alt="" width="60" height="60">
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto {{ Request::segment(1) == '' ? 'active' : ''}}" href="{{ route('home')}}">Home</a></li>
          <li><a class="nav-link scrollto {{ Request::segment(1) == 'all-tour' ? 'active' : ''}}" href="{{ route('allTour')}}">Wisata</a></li>
          <li><a class="nav-link scrollto {{ Request::segment(1) == 'all-hotel' ? 'active' : ''}}" href="{{ route('allHotel')}}">Hotel</a></li> 
          <li><a class="nav-link scrollto {{ Request::segment(1) == 'all-tour-package' ? 'active' : ''}}" href="{{ route('allTourPackage')}}">Paket Wisata</a></li>
          @if (Auth::user())    
          <li class="dropdown">
            <a class="nav-link scrollto {{ Request::segment(1) == 'orders' ? 'active' : ''}}" href="#">Order <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a class="nav-link scrollto {{ Request::segment(2) == 'order-package' ? 'active' : ''}}" href="{{ route('order-package.index')}}">Order Paket</a></li>
                <li><a class="nav-link scrollto {{ Request::segment(2) == 'order-hotel' ? 'active' : ''}}" href="{{ route('order-hotel.index')}}">Order Hotel</a></li>
            </ul>
          </li>
          @endif
          @if (!Auth::user())
            <li><a class="nav-link scrollto {{ Request::segment(1) == 'login' ? 'active' : ''}}" href="{{ route('login')}}">Login</a></li> 
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      @if (Auth::user())
        <div class="dropdown">
          <a class="btn btn-outline-light dropdown-toggle buy-tickets scrollto" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name}}
          </a>
        
          <ul class="dropdown-menu mt-3">
            <li><a class="dropdown-item" href="{{ route('profil')}}">Profil</a></li>
            <li><a class="dropdown-item" href="{{ route('logout')}}">Logout</a></li>
          </ul>
        </div>
      @endif

    </div>
</header>