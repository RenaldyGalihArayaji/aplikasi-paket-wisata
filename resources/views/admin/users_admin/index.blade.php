@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Admin</h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Table Data Admin</h6>
              <a href="{{ route('admin.create')}}" class="btn btn-primary ms-auto">Tambah Data</a>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="table-responsive">
                  <table id="example" class="table table-striped" style="width:100%">
                      <thead>
                          <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>   
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($admin as $data)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td><img src="{{ asset('storage/image_profil/'. $data->image )}}" alt="" width="50" class="img-thumbnail rounded-circle"></td>
                          <td>{{ ucwords($data->name) }}</td>
                          <td>{{ $data->email }}</td>
                            <td>
                                {{-- Tambahkan tombol aksi sesuai kebutuhan --}}
                               <a href="{{ route('admin.edit', $data->id)}}" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                               <form action="{{ route('admin.destroy', $data->id)}}" method="post" class="d-inline">
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