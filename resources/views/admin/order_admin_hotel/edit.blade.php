@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><a href="{{ route('order-hotel-admin.index')}}" class="text-decoration-none text-black">Pesanan Hotel</a> | <span class="text-secondary fs-5">Bukti Pembayaran</span></h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary"> Bukti Pembayaran</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <img src="{{ asset('storage/image_payments/'. $data->image)}}" alt="" width="100%">
                    </div>
                </div>

                @if ($data->payment_status != 'paid')
                    <form class="row g-3 mt-2" action="{{ route('order-hotel-admin.update', $data->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-12 ">
                        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                        </div>

                    </form>
                @endif

            </div>
          </div>
        </div>
  
      </div>

@endsection