<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class AllHotelController extends Controller
{
    public function index()
    {
        $hotel = Hotel::latest()->paginate(12);
        return view('landing.all-hotel.index', ['title' => 'Paket Wisata'], compact('hotel'));
    }
}
