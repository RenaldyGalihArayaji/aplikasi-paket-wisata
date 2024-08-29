@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Wisata | <span class="text-secondary fs-5">Edit Data</span></h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-md-8">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row g-3" action="{{ route('tour.update', $tour->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-md-4">
                      <label for="name" class="form-label">Nama Wisata<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $tour->name}}">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-4">
                      <label for="price" class="form-label">Harga Tiket<span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $tour->price}}">
                      @error('price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-4">
                      <label for="image" class="form-label">Foto<span class="text-danger">*(Maximal 2 Mb)</span></label>
                      <img src="{{ asset('storage/image_tours/'. $tour->image )}}" alt="" width="30">
                      <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
                      @error('image')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Masukan Deskripsi" name="description">{{ $tour->description}}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="col-12 ">
                      <a href="{{ route('tour.index')}}" class="btn btn-outline-primary">Kembali</a>
                      <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>

                </form>
            </div>
          </div>
        </div>
  
    </div>

@endsection