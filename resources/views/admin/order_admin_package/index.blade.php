@extends('admin.layout.index')

@section('content')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Data Pesanan | <span class="text-secondary fs-5">Paket Wisata</span></h1>
    </div>

    <div class="row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Table Paket Wisata</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kode Booking</th>
                              <th>Paket</th>
                              <th>Hotel</th>
                              <th>Kamar</th>   
                              <th>Jumlah Paket</th>  
                              <th>Total</th>   
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->code_order}}</td>
                            <td>{{ ucwords($item->package->package_name) }}</td>
                            <td>{{ ucwords($item->package->room->hotel->name) }}</td>
                            <td>{{ ucwords($item->package->room->room_type) }}</td>
                            <td>{{ $item->quantity_package}}</td>
                            <td>@currency($item->amount)</td>
                            <td>
                                @if ($item->payment_status == 'unpaid')
                                  Menunggu Pembayaran
                                @elseif ($item->payment_status == 'process')
                                  Menunggu Konfirmasi
                                @elseif ($item->payment_status == 'paid')
                                  Pembayaran Selesai
                                @endif
                            </td>
                            <td>
                                {{-- Tambahkan tombol aksi sesuai kebutuhan --}}
                                <a href="{{ route('order-package-admin.show', $item->id)}}" class="btn btn-warning btn-sm">Detail</a>
                                <a href="{{ route('order-package-admin.edit', $item->id)}}" class="btn btn-success btn-sm">Bukti Pembayaran</a>
                               <form action="{{ route('order-package-admin.destroy', $item->id)}}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm confirm-delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
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

@endsection