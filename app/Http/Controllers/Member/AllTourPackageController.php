<?php

namespace App\Http\Controllers\Member;

use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllTourPackageController extends Controller
{
    public function index()
    {
        $tourPackage = TourPackage::latest()->paginate(16);
        return view('landing.all-tour-package.index', ['title' => 'Paket Wisata'], compact('tourPackage'));
    }
}
