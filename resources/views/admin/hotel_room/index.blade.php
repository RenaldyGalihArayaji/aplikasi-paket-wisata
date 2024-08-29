@extends('admin.layout.index')

@section('content')
    
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kamar Hotel</h1>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Table Kamar Hotel</h6>
              <div>
                <a href="{{ route('hotelRoomCreate', $hotel->id)}}" class="btn btn-primary ms-auto btn-sm">Tambah Data</a>
                <a href="{{ route('hotel.index')}}" class="btn btn-outline-primary ms-auto btn-sm">Kembali</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                  <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Type Kamar</th>
                              <th>Harga Awal</th>
                              <th>Diskon</th>
                              <th>Harga Akhir</th>
                              <th>Fasilitas</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($hotelRoom as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ ucwords($item->room_type) }}</td>
                              <td>@currency($item->price_start)</td>
                              <td>@percent($item->discount)</td>
                              <td>@currency($item->price_final)</td>
                              <td>{{ ucwords($item->facility) }}</td>
                              <td>
                                @if($item->status == 'active')
                                  <span class="badge bg-success">Aktif</span>
                                @else
                                  <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                              </td>
                              <td>
                                {{-- <form action="{{ route('hotelRoomUpdateStatus', $item->id) }}" method="post" class="d-inline">
                                  @csrf
                                  <button type="submit" class="btn btn-warning btn-sm">
                                      @if($item->status == 'active')
                                          Tidak Aktif
                                      @else
                                          Aktif
                                      @endif
                                  </button>
                                </form>--}}
                                <a href="{{ route('hotelRoomEdit', $item->id)}}" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form action="{{ route('hotelRoomDestroy', $item->id)}}" method="post" class="d-inline">
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