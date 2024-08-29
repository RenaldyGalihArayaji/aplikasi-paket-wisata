@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Wisata | <span class="text-secondary fs-5">Tambah Data</span></h1>
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
                <form class="row g-3" action="{{ route('tour.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-4">
                      <label for="name" class="form-label">Nama Wisata<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan Nama Paket">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-4">
                      <label for="price" class="form-label">Harga Tiket<span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Harga Tiket/Orang">
                      @error('price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
      
                    <div class="col-md-4">
                      <label for="image" class="form-label">Foto<span class="text-danger">*(Maximal 2 Mb)</span></label>
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                      @error('image')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Masukan Deskripsi" name="description"></textarea>
                        @error('description')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="col-12 ">
                      <a href="{{ route('tour.index')}}" class="btn btn-outline-primary">Kembali</a>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
          </div>
        </div>
  
    </div>

@endsection