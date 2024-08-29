@extends('landing.layout.index')

@section('content')

  @php
  $setting = DB::table('settings')->where('id',1)->first();
  @endphp

  <section id="hero" style="background: url('{{ asset('storage/image_packages/' . $tourPackage->image) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <span class="text-white" style="font-size: 40px; letter-spacing: 1px;">Detail Paket Wisata</span>
      <h1 class="mb-4 pb-0">{{ $tourPackage->package_name}} ( {{ $tourPackage->duration }} hari / {{ $tourPackage->capacity }} Orang)</h1>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">


    <section id="tour-details" class="py-5 bg-light">
        <div class="container">      
          <div class="row">
            <div class="col-md-6">
              <div class="details mb-4">
                <h2><strong>Booking Sekarang,Untuk Liburanmu Nanti!</strong></h2>
              </div>
              
              <div class="informasi mb-4">
                <ul class="list-unstyled">
                  <li><strong>Tujuan Wisata:</strong> {{ ucwords($tourPackage->tour->name) }} </li>
                  <li><strong>Hotel:</strong> {{ ucwords($tourPackage->room->hotel->name) }}</li>
                  <li><strong>Durasi:</strong> {{ $tourPackage->duration }} hari</li>
                  <li>
                    <i class="fas fa-tag mr-2"></i><strong>Harga:</strong> 
                    @currency($tourPackage->price_total) /Paket
                </li>
                </ul>
              </div>
              
              <div class="formData mb-5">

                <form action="{{ route('order-package.store') }}" method="post">
                  @csrf
                  <div class="row">
                      <input type="hidden" name="id" value="{{ $tourPackage->id }}">
              
                      <div class="col-md-6 mb-2">
                          <label for="quantity_package" class="form-label">Jumlah Paket Wisata<span class="text-danger">*</span></label>
                          <input type="number" name="quantity_package" id="quantity_package" class="form-control @error('quantity_package') is-invalid @enderror" min="1" placeholder="Cth:1">
                          @error('quantity_package')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
              
                      <div class="col-md-6 mb-2">
                          <label for="departure_date" class="form-label">Tgl. Keberangkatan<span class="text-danger">*</span></label>
                          <input type="date" name="departure_date" id="departure_date" class="form-control @error('departure_date') is-invalid @enderror">
                          @error('departure_date')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
              
                      <div class="col-12">
                        @if ($tourPackage->room === 0)
                          <button class="btn btn-secondary btn-md mt-3 disabled">Booking Sekarang</button>
                        @else  
                          @if (Auth::user())
                            <button type="submit" class="btn btn-danger btn-md mt-3">Booking Sekarang</button>
                          @else
                            <a href="{{ route('login')}}" class="btn btn-danger btn-md mt-3">Booking Sekarang</a>
                          @endif 
                        @endif
                      </div>
                  </div>
                </form>

              </div>

              <div class="card p-3">
                <h5><strong>Fasilitas</strong></h5>
                <p style="text-align: justify;">
                  Pelanggan akan mendapatkan fasilitas-fasilitas dari paket wisata <strong>{{ ucwords($tourPackage->package_name) }}</strong> serta menginap di hotel <strong>{{ ucwords($tourPackage->room->hotel->name) }}</strong> pada kamar <strong>{{ ucwords($tourPackage->room->room_type) }}</strong>. Berikut penjelasan lebih lanjut mengenai fasilitas yang disediakan:<br>
                  {{ ucwords($tourPackage->room->facility) }}
                </p>              
              </div>
            </div>
          </div>
        </div>
      </section>
      

  </main><!-- End #main -->

@endsection