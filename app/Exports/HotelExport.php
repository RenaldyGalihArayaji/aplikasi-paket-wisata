<?php

namespace App\Exports;

use App\Models\OrderHotel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HotelExport implements FromView
{
    protected $hotelStart;
    protected $hotelEnd;

    public function __construct($hotelStart, $hotelEnd)
    {
        $this->hotelStart = $hotelStart;
        $this->hotelEnd = $hotelEnd;
    }

    public function view(): View
    {
        $hotelData = OrderHotel::with(['user'])
            ->whereBetween('created_at', [$this->hotelStart . ' 00:00:00', $this->hotelEnd . ' 23:59:59'])
            ->latest()->get();

        return view('admin.report_hotel.cetak', [
            'hotelData' => $hotelData,
        ]);
    }
}
