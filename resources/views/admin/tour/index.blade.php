@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Wisata</h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Table Wisata</h6>
              <a href="{{ route('tour.create')}}" class="btn btn-primary ms-auto">Tambah Data</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="table-responsive">
                  <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Foto</th>
                              <th>Nama Wisata</th>
                              <th>Harga Tiket</th>
                              <th>Deskripsi</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($tour as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/image_tours/'. $data->image )}}" alt="" width="60"></td>
                            <td>{{ ucwords($data->name) }}</td>
                            <td>@currency($data->price)</td>
                            <td>{{ ucwords($data->description) }}</td>
                            <td>
                               <a href="{{ route('tour.edit', $data->id)}}" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                               <form action="{{ route('tour.destroy', $data->id)}}" method="post" class="d-inline">
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