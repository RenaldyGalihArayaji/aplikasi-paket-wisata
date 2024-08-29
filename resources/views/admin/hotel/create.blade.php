@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hotel | <span class="text-secondary fs-5">Tambah Data</span></h1>
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
                <form class="row g-3" action="{{ route('hotel.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-6">
                      <label for="name" class="form-label">Nama Hotel<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan Nama Hotel">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label for="star" class="form-label">Bintang<span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('star') is-invalid @enderror" id="star" name="star" placeholder="cth:5">
                      @error('star')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                  </div>
      
                    <div class="col-md-6">
                      <label for="image" class="form-label">Foto<span class="text-danger">*(Maximal 2 Mb)</span></label>
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                      @error('image')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
      
                    <div class="col-md-6">
                      <label for="location" class="form-label">Lokasi<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" placeholder="Masukan Lokasi Hotel">
                      @error('location')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                    <div class="col-12 ">
                      <a href="{{ route('hotel.index')}}" class="btn btn-outline-primary">Kembali</a>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
          </div>
        </div>
  
      </div>

@endsection