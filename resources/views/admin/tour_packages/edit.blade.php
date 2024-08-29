@extends('admin.layout.index')

@section('content')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Wisata | <span class="text-secondary fs-5">Edit Data</span></h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{ route('tour-package.update', $tourPackage->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-4">
                            <label for="price_hotel" class="form-label">Harga Hotel</label>
                            <input type="text" class="form-control @error('price_hotel') is-invalid @enderror" id="price_hotel" name="price_hotel" value="@currency($tourPackage->price_hotel)" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="price_tour" class="form-label">Harga Tiket Wisata</label>
                            <input type="text" class="form-control @error('price_tour') is-invalid @enderror" id="price_tour" name="price_tour" value="@currency($tourPackage->price_tour)" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="price_total" class="form-label">Harga Total</label>
                            <input type="text" class="form-control @error('price_total') is-invalid @enderror" id="price_total" name="price_total" value="@currency($tourPackage->price_total)" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="package_name" class="form-label">Nama Paket<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('package_name') is-invalid @enderror" id="package_name" name="package_name" value="{{ old('package_name', $tourPackage->package_name) }}">
                            @error('package_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    
                        <div class="col-md-6">
                            <label for="room_id" class="form-label">Hotel<span class="text-danger">*</span></label>
                            <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id">
                                <option value="{{ $tourPackage->room->id }}">
                                    {{ ucwords($tourPackage->room->hotel->name) }} | 
                                    {{ ucwords($tourPackage->room->room_type) }} | 
                                    @currency($tourPackage->room->price_final)
                                </option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">
                                        {{ ucwords($room->hotel->name) }} | 
                                        {{ ucwords($room->room_type) }} | 
                                        @currency($room->price_final)
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="tour_id" class="form-label">Tujuan Wisata<span class="text-danger">*</span></label>
                            <select class="form-select @error('tour_id') is-invalid @enderror" id="tour_id" name="tour_id">
                                <option value="{{ $tourPackage->tour->id }}">{{ ucwords($tourPackage->tour->name) }}</option>
                                @foreach ($tours as $tour)
                                    <option value="{{ $tour->id }}">{{ ucwords($tour->name) }}</option>
                                @endforeach
                            </select>
                            @error('tour_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="capacity" class="form-label">Kapasitas Orang<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $tourPackage->capacity) }}">
                            @error('capacity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="duration" class="form-label">Durasi Hari<span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $tourPackage->duration) }}">
                            @error('duration')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="col-12">
                            <a href="{{ route('tour-package.index') }}" class="btn btn-outline-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>

@endsection
