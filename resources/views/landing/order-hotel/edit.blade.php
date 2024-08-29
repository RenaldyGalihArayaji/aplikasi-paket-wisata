@extends('landing.layout.index')

@section('content')

  @php
    $setting = DB::table('settings')->where('id',1)->first();
  @endphp
  
  <section id="hero" style="background: url('{{ asset('storage/image_settings/' . $setting->image_hero) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
        <h1 class="mb-4 pb-0">Upload<span> Bukti Pembayaran</span></h1>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <section id="order" class="my-5">
      <div class="container mt-5 p-5">
        <div class="text-center mb-5">
          <h3><strong>TERIMAKASIH</strong></h3>
          <p>ANDA SUDAH MELAKUKAN PEMESANAN,SILAKAN UPLOAD BUKTI PEMBAYARAN </p>
          <hr class="w-100">
        </div>

        <div class="row">

          <div class="col-md-6 mb-3">
            <div class="pt-4 border shadow">
              <h5 class="text-center"><strong>ID Order : {{ $orderHotel->code_order }}</strong></h5>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <div class="pt-4 border shadow">
              <h5 class="text-center"><strong>Total Pembayaran : @currency($orderHotel->amount)</strong></h5>
            </div>
          </div>
          
        </div>

        <div class="row mt-5 shadow border p-4">
          <div class="col-md-6">
            <div class="alert alert-info" role="alert">
                  <h4 class="text-center mt-2"><strong>Informasi Penting!</strong></h4>
                  <p class="text-center">Silakan Transfer Pembayaran Melalui Nomor Rekening di Bawah Ini:</p>
                  <hr>
                  <p>
                      <strong>Bank:</strong> {{ ucwords($setting->bank_name)}}<br>
                      <strong>Nomor Rekening:</strong> {{ $setting->account_number}}<br>
                      <strong>Atas Nama:</strong> {{ ucwords($setting->account_owner)}}
                  </p>
                  <hr>
                  <p class="text-center">Setelah Transfer Selesai, Silakan Upload Bukti Pembayaran <br> Kami Akan Mengkonfirmasi Pembayaran Anda</p>
            </div>
          </div>

          <div class="col-md-6">
            <form action="{{ route('order-hotel.update', $orderHotel->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="account_owner" class="form-label">Atas Nama</label>
                <input type="text" class="form-control @error('account_owner') is-invalid @enderror" id="account_owner" name="account_owner" placeholder="masukan nama pemilik bank">
                @error('account_owner')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3 col-md-6">
                <label for="bank_name" class="form-label">Nama Bank</label>
                <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" placeholder="masukan nama bank">
                @error('bank_name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Bukti Pembayaran</label>
              <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
              @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
              <button type="submit" class="btn btn-primary">Upload</button>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection
