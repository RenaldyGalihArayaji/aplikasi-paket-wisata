<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\OrderHotel;
use App\Exports\HotelExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportHotelController extends Controller
{
    public function index()
    {
        return view('admin.report_hotel.index', ['title' => 'Laporan Hotel']);
    }

    public function reportPdf(Request $request)
    {
        $hotelStart = $request->input('hotelStart');
        $hotelEnd = $request->input('hotelEnd');

        // Sesuaikan query sesuai kebutuhan Anda
        $hotelData = OrderHotel::with(['room', 'user'])
            ->whereBetween('created_at', [$hotelStart . ' 00:00:00', $hotelEnd . ' 23:59:59'])
            ->latest()->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.report_hotel.cetak', ['title' => 'Laporan Hotel', 'hotelData' => $hotelData])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-hotel' . '-' . Carbon::now() . '.pdf');
    }

    public function print($hotelStart, $hotelEnd)
    {
        // Sesuaikan query sesuai kebutuhan Anda
        $hotelData = OrderHotel::with(['room', 'user'])
            ->whereBetween('created_at', [$hotelStart . ' 00:00:00', $hotelEnd . ' 23:59:59'])
            ->latest()->get();

        return view('admin.report_hotel.cetak', ['title' => 'Cetak Hotel', 'hotelData' => $hotelData]);
    }

    public function excelHotel($hotelStart, $hotelEnd)
    {
        return Excel::download(new HotelExport($hotelStart, $hotelEnd), 'laporan-hotel' . '-' . Carbon::now() . '.xlsx');
    }
}
