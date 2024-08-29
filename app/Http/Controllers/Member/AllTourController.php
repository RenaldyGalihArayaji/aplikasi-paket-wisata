<?php

namespace App\Http\Controllers\Member;

use App\Models\Tour;
use App\Http\Controllers\Controller;

class AllTourController extends Controller
{
    public function index()
    {
        $tour = Tour::latest()->paginate(16);
        return view('landing.all-tour.index', ['title' => 'Wisata'], compact('tour'));
    }

    public function detailTour($id){
        $tour = Tour::findOrFail($id);
        return view('landing.all-tour.detail_tour', ['title' => 'Detail Wisata'], compact('tour'));
    }
}
