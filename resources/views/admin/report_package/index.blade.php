@extends('admin.layout.index')

@section('content')
    
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan | <span class="text-secondary fs-5">Paket Wisata</span></h1>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-md-8">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Data Paket Wisata</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form class="row g-3" action="{{ route('reportPackagePdf')}}" method="GET">
                    @csrf
                    
                    <div class="col-md-6 mb-2">
                        <label for="packageStart" class="form-label">Tanggal Awal</label>
                        <input type="date" name="packageStart" id="packageStart" class="form-control">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="packageEnd" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="packageEnd" id="packageEnd" class="form-control">
                    </div>

                    <div class="col-12 mt-3">
                      <button type="submit" class="btn btn-danger mb-2"><i class="fa-solid fa-file-pdf"></i> Export PDF</button>
  
                      <a href="{{ route('reportPackageExcel', ['packageStart' => 'placeholder', 'packageEnd' => 'placeholder']) }}" onclick="this.href='/reports/report-package-excel/' + document.getElementById('packageStart').value + '/' + document.getElementById('packageEnd').value" class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>

                      <a href="{{ route('reportPackagePrint', ['packageStart' => 'placeholder', 'packageEnd' => 'placeholder']) }}" onclick="this.href='/reports/report-package-print/'+  document.getElementById('packageStart').value + '/' + document.getElementById('packageEnd').value" class="btn btn-info mb-2" target="_blank"><i class="fa-solid fa-print"></i> Print</a>
  
                   </div>

                </form>
            </div>
          </div>
        </div>
  
    </div>

@endsection