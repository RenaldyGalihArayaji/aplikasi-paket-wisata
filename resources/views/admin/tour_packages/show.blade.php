@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Paket Wisata | <span class="text-secondary fs-5">Detail Data</span></h1>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Detail Data</h6>
              <a href="{{ route('tour-package.index')}}" class="btn btn-outline-primary">Kembali</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-8">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="package_name" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="package_name" name="package_name" value="{{ ucwords($tourPackage->package_name)}}" disabled>
                      </div>
    
                      <div class="col-md-4 mb-3">
                        <label for="hotel_id" class="form-label">Hotel</label>
                        <input type="text" class="form-control" id="hotel_id" name="hotel_id" value="{{ ucwords($tourPackage->room->hotel->name)}}" disabled>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label for="room_id" class="form-label">Kamar</label>
                        <input type="text" class="form-control" id="room_id" name="room_id" value="{{ ucwords($tourPackage->room->room_type)}}" disabled>
                      </div>
    
                      <div class="col-md-4 mb-3">
                        <label for="tour_id" class="form-label">Tujuan Wisata</label>
                        <input type="text" class="form-control" id="tour_id" name="tour_id" value="{{ ucwords($tourPackage->tour->name)}}" disabled>
                      </div>
    
                      <div class="col-md-4 mb-3">
                        <label for="capacity" class="form-label">Kapasitas</label>
                        <input type="text" class="form-control" id="capacity" name="capacity" value="{{ $tourPackage->capacity}} Orang" disabled>
                      </div>
    
                      <div class="col-md-4 mb-3">
                        <label for="duration" class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="duration" name="duration" value="{{ $tourPackage->duration}} Hari" disabled>
                      </div>

                      
                      <div class="col-md-4 mb-3">
                        <label for="price_hotel" class="form-label">Harga Hotel</label>
                        <input type="text" class="form-control" id="price_hotel" name="price_hotel" value="@currency($tourPackage->price_hotel)/Kamar" disabled>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label for="price_tour" class="form-label">Harga Wisata</label>
                        <input type="text" class="form-control" id="price_tour" name="price_tour" value="@currency($tourPackage->price_tour)/Tiket" disabled>
                      </div>
    
                      <div class="col-md-4 mb-3">
                        <label for="price_total" class="form-label">Total</label>
                        <input type="text" class="form-control" id="price_total" name="price_total" value="@currency($tourPackage->price_total)" disabled>
                      </div>
    
                      <div class="col-md-12 mb-3">
                        <label for="facility" class="form-label">Fasilitas</label>
                        <textarea name="facility" id="facility" class="form-control" disabled>{{ ucwords($tourPackage->room->facility) }}</textarea>
                      </div>
    
                  </div>
                </div>

                <div class="col-md-4 d-flex justify-content-center">
                  <img src="{{ asset('storage/image_packages/'. $tourPackage->image )}}" class="img-fluid" alt="" style="width: 100%; height: 45vh;">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection