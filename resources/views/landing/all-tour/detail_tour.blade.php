@extends('landing.layout.index')

@section('content')

  {{-- <section id="hero" style="background: url('{{ asset('storage/image_tours/' . $tour->image) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <span class="text-white" style="font-size: 40px; letter-spacing: 1px;">View Wisata</span>
      <h1 class="mb-4 pb-0">{{ $tour->name}} ( Tiket Masuk : @currency($tour->price)/Org</Tiket> )</h1>
      <p style="font-size: 15px">{{ ucwords($tour->description) }}</p>
    </div>
  </section> --}}

  <main id="main" style="margin-top: 100px">
    <!-- ======= Paket Wisata Terbaru ======= -->
    <section id="tour">
      <div class="container" data-aos="fade-up">
        <div class="position-relative">
            <div class="row">
              <div class="col-md-7 mb-4">
                  <div class="card shadow position-relative" style="border-radius: 20px; overflow: hidden;">
                      <!-- Gambar paket wisata -->
                      <img src="{{ asset('storage/image_tours/'. $tour->image)}}" alt="" class="img-fluid" style="width: 100%; object-fit: cover; border-radius: 20px;">
                      
                      <!-- Overlay dengan gradien -->
                      <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6));">
                      </div>
                  </div>
              </div>

              <div class="col-md-5">
                <h2 class="card-title" style="font-size: 50px; font-weight: bold; text-transform: capitalize;">
                  {{ ucwords($tour->name) }}
                </h2>
                <h4 class="text-muted" style="font-size: 20px; margin-bottom: 20px;">
                  <strong>Tiket Masuk: @currency($tour->price)/Orang</strong>
                </h4>
                <p class="card-text" style="font-size: 18px; text-align: justify;">
                  {{ ucwords($tour->description) }}
                </p>
              </div>
            </div>
        </div>  
      </div>  
    </section>
    <!-- End Paket Wisata Terbaru -->

  </main>



@endsection