@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kamar Hotel | <span class="text-secondary fs-5">Tambah Data</span></h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row g-3" action="{{ route('hotelRoomStore', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-6">
                      <label for="room_type" class="form-label">Type Kamar<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('room_type') is-invalid @enderror" id="room_type" name="room_type" placeholder="Masukan Type Kamar">
                      @error('room_type')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label for="price_start" class="form-label">Harga<span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('price_start') is-invalid @enderror" id="price_start" name="price_start" placeholder="Masukan Harga Kamar">
                      @error('price_start')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                  </div>
      
                    <div class="col-md-12">
                      <label for="facility" class="form-label">Fasilitas<span class="text-danger">*</span></label>
                      <textarea type="text" class="form-control @error('facility') is-invalid @enderror" id="facility" name="facility" placeholder="Masukan Fasilitas Hotel"></textarea>
                      @error('facility')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                    <div class="col-12 ">
                      <a href="{{ route('hotelRoom', $hotel->id)}}" class="btn btn-outline-primary">Kembali</a>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
          </div>
        </div>
  
      </div>

@endsection