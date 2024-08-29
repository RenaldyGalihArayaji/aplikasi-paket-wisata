@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a href="{{ route('order-package-admin.index')}}" class="text-decoration-none text-black">Pesanan Paket Wisata</a> | <span class="text-secondary fs-5">Detail Pesanan</span></h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
               <div class="row">
                    <div class="col-md-6">
                        <h4><strong>Data Pesanan</strong></h4>
                        <table class="table table-bordered table-striped mt-3">
                            <tr>
                                <td>Kode Booking</td>
                                <td>:</td>
                                <td>{{ $data->code_order}}</td>
                            </tr>
                            <tr>
                                <td>Paket Wisata</td>
                                <td>:</td>
                                <td>{{ ucwords($data->package->package_name)}}</td>
                            </tr>
                            <tr>
                                <td>Hotel</td>
                                <td>:</td>
                                <td>{{ ucwords($data->package->room->hotel->name)}}</td>
                            </tr>
                            <tr>
                                <td>Kamar</td>
                                <td>:</td>
                                <td>{{ ucwords($data->package->room->room_type)}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Paket</td>
                                <td>:</td>
                                <td>{{ $data->quantity_package }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pesanan</td>
                                <td>:</td>
                                <td>{{ date('d F Y', strtotime($data->order_date)) }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Keberangkatan</td>
                                <td>:</td>
                                <td>{{ date('d F Y', strtotime($data->departure_date)) }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td>@currency($data->amount)</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    @if ($data->payment_status == 'unpaid')
                                        Menunggu Pembayaran
                                    @elseif ($data->payment_status == 'process')
                                        Menunggu Konfirmasi
                                    @elseif ($data->payment_status == 'paid')
                                        Pembayaran Selesai
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4><strong>Identitas Pemesan</strong></h4>
                        <table class="table table-bordered table-striped mt-3">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $data->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $data->user->email }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td>:</td>
                                <td>{{ $data->user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>
                                    @if ($data->user->gender == 'male')
                                        <span>Laki-laki</span>
                                    @else
                                        <span>Perempuan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $data->user->address }}</td>
                            </tr>
                            <tr>
                                <td>Nama Bank</td>
                                <td>:</td>
                                <td>{{ ucwords($data->bank_name) }}</td>
                            </tr>
                            <tr>
                                <td>Nama Pemilik Rekening</td>
                                <td>:</td>
                                <td>{{ ucwords($data->account_owner) }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>
          </div>
        </div>
  
    </div>

@endsection