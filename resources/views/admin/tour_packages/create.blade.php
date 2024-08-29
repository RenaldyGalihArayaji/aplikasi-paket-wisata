@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Paket Wisata | <span class="text-secondary fs-5">Tambah Data</span></h1>
    </div>

    <div class="row">
        <!-- Area Chart -->
        <div class="col-md-8">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <form class="row g-3" action="{{ route('tour-package.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="col-md-6">
                    <label for="package_name" class="form-label">Nama Paket<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('package_name') is-invalid @enderror" id="package_name" name="package_name" placeholder="Masukan Nama Paket">
                    @error('package_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="col-md-6">
                    <label for="room_id" class="form-label">Hotel<span class="text-danger">*</span></label>
                    <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id">
                        <option value="" disabled selected>--Pilih--</option>
                        @foreach ($room as $item)
                        <option value="{{ $item->id }}">{{ ucwords($item->hotel->name) }} | {{ ucwords($item->room_type) }} | @currency($item->price_final) </option>
                        @endforeach
                    </select>
                    @error('room_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                          
                <div class="col-md-6">
                    <label for="tour_id" class="form-label">Tujuan Wisata<span class="text-danger">*</span></label>
                    <select class="form-select @error('tour_id') is-invalid @enderror" id="tour_id" name="tour_id">
                        <option value="" disabled selected>--Pilih--</option>
                        @foreach ($tour as $item)
                            <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                        @endforeach
                    </select>
                    @error('tour_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="col-md-6">
                    <label for="capacity" class="form-label">Kapasitas Orang<span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" placeholder="Masukan Kapasitas Orang">
                    @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="col-md-6">
                    <label for="duration" class="form-label">Durasi Hari<span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Masukan Durasi Hari">
                    @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="col-md-6">
                    <label for="image" class="form-label">Foto<span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="col-12">
                    <a href="{{ route('tour-package.index') }}" class="btn btn-outline-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            
            </div>
          </div>
        </div>
    </div>

@endsection