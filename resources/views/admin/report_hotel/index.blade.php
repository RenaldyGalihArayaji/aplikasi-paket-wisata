@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan | <span class="text-secondary fs-5">Hotel</span></h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-8">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Data Hotel</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row g-3" action="{{ route('reportHotelPdf')}}" method="GET">
                    @csrf
                    
                    <div class="col-md-6 mb-2">
                        <label for="hotelStart" class="form-label">Tanggal Awal</label>
                        <input type="date" name="hotelStart" id="hotelStart" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="hotelEnd" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="hotelEnd" id="hotelEnd" class="form-control">
                    </div>

                    <div class="col-12 mt-3">
                      <button type="submit" class="btn btn-danger mb-2"><i class="fa-solid fa-file-pdf"></i> Export PDF</button>
                     
                      <a href="{{ route('reportHotelExcel', ['hotelStart' => 'placeholder', 'hotelEnd' => 'placeholder']) }}" onclick="this.href='/reports/report-hotel-excel/' + document.getElementById('hotelStart').value + '/' + document.getElementById('hotelEnd').value" class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                      
                      <a href="{{ route('reportHotelPrint', ['hotelStart' => 'placeholder', 'hotelEnd' => 'placeholder']) }}" onclick="this.href='/reports/report-hotel-print/'+  document.getElementById('hotelStart').value + '/' + document.getElementById('hotelEnd').value" class="btn btn-info mb-2" target="_blank"><i class="fa-solid fa-print"></i> Print</a>
                   </div>
                </form>
            </div>
          </div>
        </div>
  
    </div>

@endsection