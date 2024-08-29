<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PackageExport;
use Carbon\Carbon;
use App\Models\OrderPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportPackageController extends Controller
{
    public function index()
    {
        return view('admin.report_package.index', ['title' => 'Laporan Paket Wisata']);
    }

    public function reportPdf(Request $request)
    {
        $packageStart = $request->input('packageStart');
        $packageEnd = $request->input('packageEnd');

        // Sesuaikan query sesuai kebutuhan Anda
        $packageData = OrderPackage::with(['package', 'user'])
            ->whereBetween('created_at', [$packageStart . ' 00:00:00', $packageEnd . ' 23:59:59'])
            ->latest()->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.report_package.cetak', ['title' => 'Laporan Paket Wisata', 'packageData' => $packageData])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-paket-wisata' . '-' . Carbon::now() . '.pdf');
    }

    public function print($packageStart, $packageEnd)
    {
        // Sesuaikan query sesuai kebutuhan Anda
        $packageData = OrderPackage::with(['package', 'user'])
            ->whereBetween('created_at', [$packageStart . ' 00:00:00', $packageEnd . ' 23:59:59'])
            ->latest()->get();

        return view('admin.report_package.cetak', ['title' => 'Cetak Paket Wisata', 'packageData' => $packageData]);
    }

    public function excelPackage($packageStart, $packageEnd)
    {
        return Excel::download(new PackageExport($packageStart, $packageEnd), 'laporan-paket-wisata' . '-' . Carbon::now() . '.xlsx');
    }
}
