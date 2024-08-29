@extends('landing.layout.index')

@section('content')

  @php
  $setting = DB::table('settings')->where('id',1)->first();
  @endphp

  {{-- <section id="hero" style="background: url('{{ asset('storage/image_settings/' . $setting->image_hero) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">Semua <span>Paket Wisata</span></h1>
    </div>
  </section> --}}

  <main id="main" style="margin-top: 100px">
    <!-- ======= Paket Wisata Terbaru ======= -->
    <section id="tour">
      <div class="container" data-aos="fade-up">
        <h1></h1>
        @if($tourPackage->isEmpty())
            <div class="col-md-12">
                <div class="text-center">
                    <img src="{{ asset('landing/assets/img/DataIsMissing.png') }}" alt="No Data" style="height: 500px;" class="img-fluid">
                </div>
            </div>
        @else
            <div class="position-relative">
                <div class="row">
                    @foreach ($tourPackage as $item) 
                        <div class="col-md-3 mb-4">
                            <div class="card shadow position-relative" style="border-radius: 20px; overflow: hidden;">
                                <!-- Gambar paket wisata -->
                                <img src="{{ asset('storage/image_packages/'. $item->image)}}" alt="" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover; border-radius: 20px;">
                                
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
        @endif

      
        <div class="d-flex justify-content-center">
            {{ $tourPackage->links() }}
        </div>
      </div>
    </section>
    <!-- End Paket Wisata Terbaru -->

  </main>

@endsection