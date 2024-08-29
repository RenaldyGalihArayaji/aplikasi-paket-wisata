<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\OrderHotel;
use App\Models\OrderPackage;
use App\Models\Tour;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orderPackages = OrderPackage::with(['package'])->where('payment_status', 'paid')->get();
        $orderHotels = OrderHotel::where('payment_status', 'paid')->get();

        // Calculate the total earnings from packages
        $totalPackageEarnings = $orderPackages->map(function ($orderPackage) {
            return $orderPackage->package->tour->price * $orderPackage->quantity_package;
        })->sum();

        // Calculate the total earnings from hotels
        $totalHotelEarnings = $orderHotels->sum('amount') + $orderPackages->map(function ($orderPackage) {
            return $orderPackage->package->price_hotel * $orderPackage->quantity_package;
        })->sum();

        // Calculate the total earnings
        $totalEarnings = $totalPackageEarnings + $totalHotelEarnings;

        // Count the orders based on their status
        $orderPackageCount = OrderPackage::whereIn('payment_status', ['unpaid'])->count();
        $orderHotelCount = OrderHotel::whereIn('payment_status', ['unpaid'])->count();

        // Count the users based on their role
        $adminCount = User::where('role', '=', 'admin')->count();
        $memberCount = User::where('role', '=', 'member')->count();

        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'orderPackages' => $orderPackages,
            'orderHotels' => $orderHotels,
            'adminCount' => $adminCount,
            'memberCount' => $memberCount,
            'orderPackageCount' => $orderPackageCount,
            'orderHotelCount' => $orderHotelCount,
            'totalPackageEarnings' => $totalPackageEarnings,
            'totalHotelEarnings' => $totalHotelEarnings,
            'totalEarnings' => $totalEarnings,
        ]);
    }
}
