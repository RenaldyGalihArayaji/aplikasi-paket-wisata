@extends('landing.layout.index')

@section('content')

    @php
    $setting = DB::table('settings')->where('id',1)->first();
    @endphp

    {{-- <section id="hero" style="background: url('{{ asset('storage/image_settings/' . $setting->image_hero) }}') no-repeat center center; background-size: cover;">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
        <h1 class="mb-4 pb-0">Semua <span>Hotel</span></h1>
        </div>
    </section> --}}



    <main id="main" style="margin-top: 100px">

        <section id="hotels" class="section-with-bg">
            <div class="container">
                @if($hotel->isEmpty())
                    <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ asset('landing/assets/img/DataIsMissing.png') }}" alt="No Data" style="height: 500px;" class="img-fluid">
                    </div>
                    </div>
                @else
                <div class="row">
                    @foreach ($hotel as $item) 
                        <div class="col-md-4 mb-4">
                            <div class="card shadow position-relative" style="border-radius: 20px; overflow: hidden;">
                                <!-- Gambar hotel -->
                                <img src="{{ asset('storage/image_hotels/'. $item->image)}}" alt="" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover; border-radius: 20px;">
                                
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
                                    <a href="{{ route('detailHotel', $item->id) }}" class="btn btn-danger text-white" style="border-radius: 30px; width: fit-content;">
                                        Detail Hotel <i class="bi bi-arrow-right-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif

                <div class="d-flex justify-content-center">
                    {{ $hotel->links() }}
                </div>
            </div>
        </section>

    </main>

@endsection