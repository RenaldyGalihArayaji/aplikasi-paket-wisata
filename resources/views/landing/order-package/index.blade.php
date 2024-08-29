@extends('landing.layout.index')

@section('content')

  @php
  $setting = DB::table('settings')->where('id',1)->first();
  @endphp

  <section id="hero" style="background: url('{{ asset('storage/image_settings/' . $setting->image_hero) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">Order<span> Paket Wisata</span></h1>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">
    <section id="order" class="my-5">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="table-responsive">
                              <table id="example" class="table table-striped" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Kode Booking</th>
                                          <th>Paket</th>
                                          <th>Hotel</th>
                                          <th>Status</th>
                                          <th>Total</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($orderPackage as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->code_order }}</td>
                                        <td>{{ ucwords($item->package->package_name) }}</td>
                                        <td>{{ ucwords($item->package->room->hotel->name) }} ( {{ ucwords($item->package->room->room_type) }} )</td>
                                        <td>
                                          @if ($item->payment_status == 'unpaid')
                                            Menunggu Pembayaran
                                          @elseif ($item->payment_status == 'process')
                                            Menunggu Konfirmasi
                                          @elseif ($item->payment_status == 'paid')
                                            Pembayaran Selesai
                                          @endif
                                        </td>
                                        <td>@currency($item->amount)</td>
                                        <td>
                                          <a href="{{ route('order-package.show', $item->id)}}" class="btn btn-warning btn-sm text-white my-1">Detail</a>
                                          @if ($item->image == null)
                                          <a href="{{ route('order-package.edit', $item->id)}}" class="btn btn-success btn-sm my-1">Upload Bukti</a>
                                          @endif
                                          @if ($item->payment_status == 'paid')
                                            <a href="{{ route('printPackage', $item->id)}}" class="btn btn-primary btn-sm">Cetak</a>
                                          @endif
                                        </td>
                                    </tr>
                                @endforeach
                                  </tbody>
                              </table>
                          </div>
                        </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </main>



@endsection