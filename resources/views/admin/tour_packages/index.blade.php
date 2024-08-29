@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket Wisata</h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Table Paket Wisata</h6>
              <a href="{{ route('tour-package.create')}}" class="btn btn-primary ms-auto">Tambah Data</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="table-responsive">
                  <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Foto</th>
                              <th>Paket</th>
                              <th>Wisata</th>
                              <th>Hotel</th>
                              <th>Kamar</th>
                              <th>Durasi</th>
                              <th>Harga Hotel</th>
                              <th>Harga Wisata</th>
                              <th>Total</th> 
                              {{-- <th>Kapasitas</th> --}}
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($tourPackage as $data)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td><img src="{{ asset('storage/image_packages/'. $data->image )}}" alt="" width="60"></td>
                              <td>{{ ucwords($data->package_name) }}</td>
                              <td>{{ ucwords($data->tour->name) }}</td>
                              <td>{{ ucwords($data->room->hotel->name) }}</td>
                              <td>{{ ucwords($data->room->room_type) }}</td>
                              <td>{{ $data->duration }} Hari</td>
                              <td>@currency($data->price_hotel)/Kamar</td>
                              <td>@currency($data->price_tour)/Tiket</td>
                              <td>@currency($data->price_total)</td>
                              {{-- <td>{{ $data->capacity }} Orang</td> --}}
                              <td>
                                  {{-- Tambahkan tombol aksi sesuai kebutuhan --}}
                                  <a href="{{ route('tour-package.show', $data->id)}}" class="btn btn-warning btn-sm my-1"><i class="fa-regular fa-eye"></i></a>
                                  <a href="{{ route('tour-package.edit', $data->id)}}" class="btn btn-success btn-sm my-1"><i class="fa-regular fa-pen-to-square"></i></a>
                                  <form action="{{ route('tour-package.destroy', $data->id)}}" method="post" class="d-inline">
                                      @csrf
                                      @method('delete')
                                      <button class="btn btn-danger btn-sm my-1 confirm-delete"><i class="fa-solid fa-trash"></i></button>
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