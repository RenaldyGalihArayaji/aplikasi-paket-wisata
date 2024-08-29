@extends('admin.layout.index')

@section('content')
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Customer</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Table Data Customer</h6>
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
                              <th>Nomor Telepon</th>  
                              <th>Alamat</th>  
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($member as $data)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td><img src="{{ asset('storage/image_profil/'. $data->image )}}" alt="" width="40"></td>
                              <td>{{ ucwords($data->name) }}</td>
                              <td>{{ $data->email }}</td>
                              <td>{{ $data->phone }}</td>
                              <td>{{ ucwords($data->address) }}</td>
                              <td>
                                <form action="{{ route('member.destroy', $data->id)}}" method="post" class="d-inline">
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