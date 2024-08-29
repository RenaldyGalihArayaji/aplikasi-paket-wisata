@extends('landing.layout.index')

@section('content')
  @php
    $setting = DB::table('settings')->where('id',1)->first();
  @endphp

  <section id="hero" style="background: url('{{ asset('storage/image_settings/' . $setting->image_hero) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0"><span>{{  $setting->name_hero}}</span></h1>
      <p>{{  $setting->short_description}}</p>
      <a href="{{ route('allTourPackage')}}" class="about-btn scrollto">Paket Wisata</a>
    </div>
  </section>

  <main id="main">

    <!-- ======= Wisata  ======= -->
    <section id="tour">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Destinasi Wisata</h2>
          <p>Kami menyediakan berbagai paket liburan dan tour sesuai dengan keinginan Anda dengan berbagai pilihan destinasi</p>
        </div>

            @if($tour->isEmpty())
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ asset('landing/assets/img/DataIsMissing.png') }}" alt="No Data" style="height: 500px;" class="img-fluid">
                    </div>
                </div>
            @else
                <div class="position-relative">
                  <div class="row">
                    @foreach ($tour as $item) 
                        <div class="col-md-3 mb-4">
                          <div class="card shadow position-relative" style="border-radius: 20px; overflow: hidden;">
                            <!-- Gambar tur -->
                            <img src="{{ asset('storage/image_tours/'. $item->image)}}" alt="" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover; border-radius: 20px;">
                            
                            <!-- Overlay dengan gradien -->
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6));">
                                <!-- Nama item dengan teks putih dan tebal -->
                                <h4 class="text-white"><strong>{{ ucwords($item->name) }}</strong></h4>
                                
                                <!-- Tombol lihat paket -->
                                <a href="{{ route('tourToPackage', $item->id) }}" class="btn btn-danger" style="border-radius: 30px; width: fit-content;">
                                    Lihat Paket <i class="bi bi-arrow-right-circle"></i>
                                </a>
                            </div>
                          </div>
                        </div>
                    @endforeach
                  </div>
                </div>
            @endif
      </div>
    </section><!-- End Wisata  -->

    <!-- ======= Hotel Terbaru ======= -->
    <section id="tour">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Hotel Terbaru</h2>
          <p>Tersedia beragam pilihan hotel untuk memenuhi kebutuhan akomodasi Anda dengan kenyamanan dan layanan terbaik di berbagai lokasi.</p>
        </div>

        @if($hotel->isEmpty())
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ asset('landing/assets/img/DataIsMissing.png') }}" alt="No Data" style="height: 500px;" class="img-fluid">
                    </div>
                </div>
            @else
                <div class="position-relative">
                    <div id="hotelCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($hotel->chunk(3) as $chunkIndex => $chunk)
                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($chunk as $item)
                                            <div class="col-md-4 d-flex justify-content-center mb-4">
                                              <div class="card shadow position-relative" style="border-radius: 20px; overflow: hidden;">
                                                <!-- Gambar hotel -->
                                                <img src="{{ asset('storage/image_hotels/'. $item->image)}}" alt="" class="img-fluid" style="width: 100%; height: 450px; object-fit: cover; border-radius: 20px;">
                                                
                                                <!-- Overlay dengan gradien -->
                                                <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6));">
                                                    <!-- Nama item dengan teks putih dan tebal -->
                                                    <h4 class="text-white"><strong>{{ ucwords($item->name) }}</strong></h4>
                                                    
                                                    <!-- Bintang hotel dan jumlah kamar -->
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div class="stars">
                                                            @for ($i = 0; $i < $item->star; $i++)
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                            @endfor
                                                            @for ($i = $item->star; $i < 5; $i++)
                                                                <i class="bi bi-star text-muted"></i>
                                                            @endfor
                                                        </div>
                                                        <p class="mb-0 text-white">{{ $item->room->count() }} Kamar</p>
                                                    </div>
                                                    
                                                    <!-- Rentang harga per malam -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        @php
                                                            $prices = $item->room->pluck('price_final')->toArray();
                                                            $minPrice = !empty($prices) ? min($prices) : 0;
                                                            $maxPrice = !empty($prices) ? max($prices) : 0;
                                                        @endphp
                                                        <p class="mb-0 text-white"><strong>@currency($minPrice) - @currency($maxPrice) / Malam</strong></p>
                                                    </div>
                                                    
                                                    <!-- Tombol lihat paket -->
                                                    <a href="{{ route('detailHotel', $item->id) }}" class="btn btn-danger" style="border-radius: 30px; width: fit-content;">
                                                        Detail Hotel <i class="bi bi-arrow-right-circle"></i>
                                                    </a>
                                                </div>
                                              </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#hotelCarousel" data-bs-slide="prev" style="position: absolute; left: -50px; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#hotelCarousel" data-bs-slide="next" style="position: absolute; right: -50px; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <i class="bi bi-arrow-right-circle"></i>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif



      </div>
    </section><!-- End Paket Wisata Terbaru -->

    <!-- ======= Paket Wisata Terbaru ======= -->
    <section id="tour">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Paket Wisata Terbaru</h2>
          <p>Nikmati paket wisata terbaru dengan pengalaman tak terlupakan yang dirancang khusus untuk Anda.</p>
        </div>

        @if($tourPackage->isEmpty())
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ asset('landing/assets/img/DataIsMissing.png') }}" alt="No Data" style="height: 500px;" class="img-fluid">
                    </div>
                </div>
            @else
                <div class="position-relative">
                    <div id="tourPackageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($tourPackage->chunk(3) as $chunkIndex => $chunk)
                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($chunk as $item)
                                          <div class="col-md-4 mb-4">
                                            <div class="card shadow position-relative" style="border-radius: 20px; overflow: hidden;">
                                              <!-- Gambar paket wisata -->
                                              <img src="{{ asset('storage/image_packages/'. $item->image)}}" alt="" class="img-fluid" style="width: 100%; height: 450px; object-fit: cover; border-radius: 20px;">
                                              
                                              <!-- Overlay dengan gradien -->
                                              <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6));">
                                                  <!-- Label Paket Wisata -->
                                                  <span class="text-white" style="font-size: 17px; letter-spacing: 1px;">Paket Wisata</span>
                                                  
                                                  <!-- Nama Paket -->
                                                  <h3 class="text-white" style="font-weight: bold; text-transform: uppercase;">
                                                      {{ ucwords($item->package_name) }}
                                                  </h3>
                                                  
                                                  <!-- Harga Paket -->
                                                  <span class="text-white" style="font-size: 25px;">@currency($item->price_total)</span>
                                                  <br>
                                                  
                                                  <!-- Tombol Detail Paket -->
                                                  <a href="{{ route('detailPackage', $item->id) }}" class="btn btn-danger" 
                                                    style="border-radius: 30px; width: fit-content; padding: 10px 20px; font-size: 14px;">
                                                      Detail Paket <i class="bi bi-arrow-right-circle"></i>
                                                  </a>
                                              </div>
                                            </div>
                                          </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#tourPackageCarousel" data-bs-slide="prev" style="position: absolute; left: -50px; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#tourPackageCarousel" data-bs-slide="next" style="position: absolute; right: -50px; top: 50%; transform: translateY(-50%);">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif



      </div>
    </section><!-- End Paket Wisata Terbaru -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="section-bg">

      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Hubungi Kami</h2>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Alamat</h3>
              <address>{{ $setting->address}}</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Nomor Telepon</h3>
              <p>{{ $setting->phone}}</p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p>{{ $setting->email}}</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

@endsection
