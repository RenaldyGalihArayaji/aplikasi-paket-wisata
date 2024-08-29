<?php

namespace App\Http\Controllers\Member;

use App\Models\TourPackage;
use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelRoom;

class HomeController extends Controller
{
    public function index()
    {
        $tourPackage = TourPackage::latest()->paginate(8);
        $tour = Tour::latest()->paginate(8);
        $hotel = Hotel::with(['room' => function ($query) {
            $query->where('status', 'active');
        }])->latest()->paginate(15);
        return view('landing.home.index', ['title' => 'Home'], compact('tourPackage', 'hotel','tour'));
    }

    public function detailPackage($id)
    {
        $tourPackage = TourPackage::with('room', 'tour')->findOrFail($id);
        return view('landing.home.detail_package', ['title' => 'Detail Wisata'], compact('tourPackage'));
    }

    public function detailHotel($id)
    {
        $hotel = Hotel::with('room')->findOrFail($id);
        $room = HotelRoom::where('hotel_id', '=', $hotel->id)->get();
        return view('landing.home.detail_hotel', ['title' => 'Detail Hotel'], compact('room', 'hotel'));
    }

    public function tourToPackage($id){
        $tour = Tour::findOrFail($id);
        $tourPackage = TourPackage::with('room', 'tour')->where('tour_id', $tour->id)->latest()->get();
        return view('landing.home.detail_tour_to_package',['title' => 'Wisata'], compact('tourPackage','tour'));
    }
}
