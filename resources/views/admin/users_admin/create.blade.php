@extends('admin.layout.index')

@section('content')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Admin| <span class="text-secondary fs-5">Tambah Data</span></h1>
    </div>

    <div class="row">
        <div class="col-md-8">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row g-3" action="{{ route('admin.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-6">
                      <label for="name" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan Nama Lengkap">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
      
                    <div class="col-md-6">
                      <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukan Email">
                      @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="xxxxxxxxxxx">
                        @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
      
                    <div class="col-md-6">
                      <label for="image" class="form-label">Foto</label>
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                      @error('image')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                    <div class="col-12 ">
                      <a href="{{ route('admin.index')}}" class="btn btn-outline-primary">Kembali</a>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
          </div>
        </div>
    </div>

@endsection