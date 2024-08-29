@extends('landing.layout.index')

@section('content')

@php
$setting = DB::table('settings')->where('id',1)->first();
@endphp

<section id="hero" style="background: url('{{ asset('storage/image_hotels/' . $hotel->image) }}') no-repeat center center; background-size: cover;">
  <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
    <span class="text-white" style="font-size: 40px; letter-spacing: 1px;">Detail Hotel</span>
      <h1 class="mb-4 pb-0">{{ $hotel->name}}</h1>
  </div>
</section><!-- End Hero Section -->

<main id="main">

  <section id="tour-details" class="py-5 bg-light">
    <div class="container">      
      <div class="row">
        <div class="col-md-8 mb-2">
          <div class="details mb-4">
            <h2><strong>Booking Sekarang,untuk Tempat Istirahat Anda dalam Paket Wisata Kami!</strong></h2>
            <div class="stars">
              @for ($i = 0; $i < $hotel->star; $i++)
                  <i class="bi bi-star-fill text-warning"></i>
              @endfor
              @for ($i = $hotel->star; $i < 5; $i++)
                  <i class="bi bi-star text-muted"></i>
              @endfor
            </div>
            <p><strong>Jumlah Kamar:</strong> {{ $hotel->active_room_count }} Kamar</p>
            <p><strong>Lokasi:</strong> {{ ucwords($hotel->location) }}</p>
          </div>
          
          <div class="formData mb-3">
            <form action="{{ route('order-hotel.store') }}" method="POST">
              @csrf
              <div class="row">
                  <input type="hidden" name="id" value="{{ $hotel->id }}">
                  
                  <div class="col-md-6 mb-2">
                      <label for="check_in_date" class="form-label">Check In<span class="text-danger">*</span></label>
                      <input type="date" name="check_in_date" id="check_in_date" class="form-control @error('check_in_date') is-invalid @enderror" value="{{ old('check_in_date') }}">
                      @error('check_in_date')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                  </div>
                  
                  <div class="col-md-6 mb-2">
                      <label for="check_out_date" class="form-label">Check Out<span class="text-danger">*</span></label>
                      <input type="date" name="check_out_date" id="check_out_date" class="form-control @error('check_out_date') is-invalid @enderror" value="{{ old('check_out_date') }}">
                      @error('check_out_date')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                  </div>
                  
                  <div class="col-md-6 mb-2">
                      <label for="room_id" class="form-label">Kamar<span class="text-danger">*</span></label>
                      <select name="room_id" id="room_id" class="form-select">
                        <option value="">--Pilih--</option>
                        @foreach ($room as $item)
                            <option value="{{ $item->id}}">{{ ucwords($item->hotel->name) }} | {{ ucwords($item->room_type) }} | @currency($item->price_final)</option>
                        @endforeach
                      </select>
                      @error('room_id')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                  </div>
                  
                  <div class="col-md-6 mb-2">
                      <label for="special_requests" class="form-label">Request</label>
                      <input type="text" name="special_requests" id="special_requests" class="form-control @error('special_requests') is-invalid @enderror" placeholder="Optional">
                      @error('special_requests')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                  </div>  
                  
                  <div class="col-12">
                      @if (Auth::user())
                          <button type="submit" class="btn btn-danger btn-md mt-3">Booking Sekarang</button>
                      @else
                          <a href="{{ route('login')}}" class="btn btn-danger btn-md mt-3">Booking Sekarang</a>
                      @endif
                  </div>
              </div>
            </form>
          </div>

          <div class="card p-4">
            <h3><strong>Fasilitas</strong></h3>
            <p>Berikut kamar dan fasilitas yang ada di hotel <strong>{{ ucwords($hotel->name) }}</strong>:</p>
            <ul class="list-group list-group-flush">
              @foreach ($room as $item)
                <li class="list-group-item">Kamar <strong>{{ $item->room_type }}</strong> : <br> {{ $item->facility }}</li>
              @endforeach
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

@endsection
