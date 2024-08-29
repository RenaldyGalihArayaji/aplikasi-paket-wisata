@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kamar Hotel | <span class="text-secondary fs-5">Edit Data</span></h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row g-3" action="{{ route('hotelRoomUpdate', $hotelRoom->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                      <label for="room_type" class="form-label">Type Kamar<span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('room_type') is-invalid @enderror" id="room_type" name="room_type" value="{{ $hotelRoom->room_type}}">
                      @error('room_type')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label for="price_start" class="form-label">Harga<span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('price_start') is-invalid @enderror" id="price_start" name="price_start" value="{{ $hotelRoom->price_start}}">
                      @error('price_start')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label for="discount" class="form-label">Diskon<span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ $hotelRoom->discount}}">
                      @error('discount')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>

                    <div class="col-md-6">
                      <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                      <select name="status" id="status" class="form-select">
                        <option value="active" @if($hotelRoom->status == 'active') selected @endif>Aktif</option>
                          <option value="inactive" @if($hotelRoom->status == 'inactive') selected @endif>Tidak Aktif</option>
                          @error('status')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                      </select>
                    </div>


                    <div class="col-md-12">
                      <label for="facility" class="form-label">Fasilitas<span class="text-danger">*</span></label>
                      <textarea type="text" class="form-control @error('facility') is-invalid @enderror" id="facility" name="facility">{{ $hotelRoom->facility}}</textarea>
                      @error('facility')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                    <div class="col-12 ">
                      <a href="{{ route('hotelRoom', $hotel->id)}}" class="btn btn-outline-primary">Kembali</a>
                      <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>

                </form>
            </div>
          </div>
        </div>
  
      </div>

@endsection