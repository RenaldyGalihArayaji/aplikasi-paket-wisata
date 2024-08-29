@extends('landing.layout.index')

@section('content')

  @php
    $setting = DB::table('settings')->where('id',1)->first();
  @endphp
  
  <section id="hero" style="background: url('{{ asset('storage/image_settings/' . $setting->image_hero) }}') no-repeat center center; background-size: cover;">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
        <h1 class="mb-4 pb-0">Detail<span> Order</span></h1>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <section id="order" class="my-5">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-body">
                    <!-- Identitas Pemesan Section -->
                    <div class="pemesan p-3">
                      <h5 class="text-center"><strong>Identitas Pemesan</strong></h5>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td><strong>Nama</strong></td>
                            <td>:</td>
                            <td>{{ Auth::user()->name }}</td>
                          </tr>
                          <tr>
                            <td><strong>Email</strong></td>
                            <td>:</td>
                            <td>{{ Auth::user()->email }}</td>
                          </tr>
                          <tr>
                            <td><strong>Nomor Telepon</strong></td>
                            <td>:</td>
                            <td>{{ Auth::user()->phone }}</td>
                          </tr>
                          <tr>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td>:</td>
                            <td>
                              @if (Auth::user()->gender == 'male')
                                Laki-laki
                              @else
                                Perempuan
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td><strong>Alamat</strong></td>
                            <td>:</td>
                            <td>{{ Auth::user()->address }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <!-- Data Pesanan Section -->
                    <div class="pesanan mt-2 p-3">
                      <h5 class="text-center"><strong>Data Pesanan</strong></h5>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td><strong>Kode Booking</strong></td>
                            <td>:</td>
                            <td>{{ $orderHotel->code_order }}</td>
                          </tr>
                          <tr>
                            <td><strong>Hotel</strong></td>
                            <td>:</td>
                            <td>{{ ucwords($orderHotel->room->hotel->name) }}</td>
                          </tr>
                          <tr>
                            <td><strong>Jumlah Kamar</strong></td>
                            <td>:</td>
                            <td>{{ ucwords($orderHotel->room->room_type) }}</td>
                          </tr>
                          <tr>
                            <td><strong>Tanggal Check In</strong></td>
                            <td>:</td>
                            <td>{{ date('d F Y', strtotime($orderHotel->check_in_date)) }}</td>
                          </tr>
                          <tr>
                            <td><strong>Tanggal Check Out</strong></td>
                            <td>:</td>
                            <td>{{ date('d F Y', strtotime($orderHotel->check_out_date)) }}</td>
                          </tr>
                          @if ($orderHotel->special_requests === '')
                          <tr>
                            <td><strong>Request Kamar</strong></td>
                            <td>:</td>
                            <td>{{ ucwords($orderHotel->special_requests) }}</td>
                          </tr>
                          @endif
                          <tr>
                            <td><strong>Total Pembayaran</strong></td>
                            <td>:</td>
                            <td>@currency($orderHotel->amount)</td>
                          </tr>
                          <tr>
                            <td><strong>Status Pembayaran</strong></td>
                            <td>:</td>
                            <td>
                              @if ($orderHotel->payment_status == 'unpaid')
                                Menunggu Pembayaran
                              @elseif ($orderHotel->payment_status == 'process')
                                Menunggu Konfirmasi
                              @elseif ($orderHotel->payment_status == 'paid')
                                Pembayaran Selesai
                              @endif
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                  </div>
                </div>
              </div>
          </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection
