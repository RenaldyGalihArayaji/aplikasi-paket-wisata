<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  @php
    $setting = DB::table('settings')->where('id',1)->first();
  @endphp

  <title>{{ ucwords($setting->name_app) }} | {{ $title }}</title>

  <link rel="shortcut icon" href="{{ asset('storage/image_settings/' . $setting->logo) }}" type="image/x-icon">

  <!-- Favicons -->
  <link href="" rel="icon">
  <link href="{{ asset('landing/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

   {{-- Datatables css --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landing/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('landing/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  @include('landing.layout.header')
  <!-- End Header -->

 @yield('content')

  <!-- ======= Footer ======= -->
  @include('landing.layout.footer')
  <!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  {{-- sweetalert --}}
  @include('sweetalert::alert')

  <!-- Vendor JS Files -->
  <script src="{{ asset('landing/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('landing/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('landing/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('landing/assets/js/main.js')}}"></script>

   {{-- datables js --}}
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  {{-- Datatables --}}
  <script>
    new DataTable('#example');
  </script>


</body>

</html>
