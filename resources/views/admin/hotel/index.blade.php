@extends('admin.layout.index')

@section('content')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Hotel</h1>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Table Hotel</h6>
              <a href="{{ route('hotel.create')}}" class="btn btn-primary ms-auto">Tambah Data</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Foto</th>
                              <th>Hotel</th>  
                              <th>Jumlah Kamar</th>  
                              <th>Bintang</th>  
                              <th>Lokasi</th>  
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($hotels as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td><img src="{{ asset('storage/image_hotels/'. $item->image )}}" alt="" width="60"></td>
                              <td>{{ ucwords($item->name) }}</td>
                              <td>{{ $item->active_room_count }}</td> 
                              <td>{{ $item->star }}</td>
                              <td>{{ ucwords($item->location) }}</td>
                              <td>
                                  {{-- Tambahkan tombol aksi sesuai kebutuhan --}}
                                  <a href="{{ route('hotelRoom', $item->id)}}" class="btn btn-primary btn-sm">Tipe Kamar</a>
                                  <a href="{{ route('hotel.edit', $item->id)}}" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                  <form action="{{ route('hotel.destroy', $item->id)}}" method="post" class="d-inline">
                                      @csrf
                                      @method('delete')
                                      <button class="btn btn-danger btn-sm confirm-delete"><i class="fa-solid fa-trash"></i></button>
                                  </form>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
  
    </div>

@endsection