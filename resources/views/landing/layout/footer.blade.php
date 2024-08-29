<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          @php
            $setting = DB::table('settings')->where('id',1)->first();
          @endphp

          <div class="col-lg-4 col-md-4 footer-info">
            <h1><a href="{{ route('home')}}">{{ ucwords($setting->name_app)}}</a></h1>
            <p>{{  $setting->short_description}}</p>
          </div>

          <div class="col-lg-4 col-md-4 footer-links">
            <h4>Menu Website</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home')}}">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('allTour')}}">Wisata</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('allTourPackage')}}">Paket Wisata</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="{{ route('allHotel')}}">Hotel</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-4 footer-contact">
            <h4>Hubungi kami</h4>
            <p>
              {{  $setting->address}} <br>
              <strong>Telepon:</strong> {{  $setting->phone}}<br>
              <strong>Email:</strong> {{  $setting->email}}<br>
            </p>

            <div class="social-links">
              <a href="{{  $setting->link_youtube}}" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="{{  $setting->link_instagram}}" class="google-plus"><i class="bi bi-youtube"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>App Tour</strong>. All Rights Reserved
      </div>
    </div>
</footer>