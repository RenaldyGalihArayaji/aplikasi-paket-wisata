@extends('admin.layout.index')

@section('content')
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Welcome Message -->
    <div class="text-center my-5">
      <h1>Selamat Datang, <strong>{{ ucwords(Auth::user()->name) }}</strong></h1>
      <p class="card-text">Anda masuk sebagai <strong>{{ ucwords(Auth::user()->role) }}</strong>.</p>
      <p class="card-text">Kelola data dan informasi Anda dengan mudah dan efisien di aplikasi paket wisata kami.</p>
      @php
        $setting = DB::table('settings')->where('id',1)->first();
      @endphp
      <img src="{{ asset('storage/image_settings/' . $setting->logo) }}" alt="" class="img-fluid" style="width: 50vh; height: 50vh; object-fit: cover;">
    </div>


@endsection
