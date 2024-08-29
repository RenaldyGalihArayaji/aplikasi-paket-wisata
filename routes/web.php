<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Member\HomeController;
use App\Http\Controllers\Member\AllTourController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HotelRoomController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Member\AllHotelController;
use App\Http\Controllers\Admin\UserMemberController;
use App\Http\Controllers\Admin\ReportHotelController;
use App\Http\Controllers\Admin\TourPackageController;
use App\Http\Controllers\Member\OrderHotelController;
use App\Http\Controllers\Admin\ReportPackageController;
use App\Http\Controllers\Member\OrderPackageController;
use App\Http\Controllers\Admin\OrderHotelAdminController;
use App\Http\Controllers\Member\AllTourPackageController;
use App\Http\Controllers\Admin\OrderPackageAdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Member\ProfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthContoller::class, 'login'])->name('login');
    Route::post('login', [AuthContoller::class, 'loginPost'])->name('login.post');
    Route::get('register', [AuthContoller::class, 'register'])->name('register');
    Route::post('register', [AuthContoller::class, 'registerPost'])->name('register.post');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/detail-package/{id}', [HomeController::class, 'detailPackage'])->name('detailPackage');
Route::get('/detail-tour/{id}', [AllTourController::class, 'detailTour'])->name('detailTour');
Route::get('/detail-hotel/{id}', [HomeController::class, 'detailHotel'])->name('detailHotel');
Route::get('/detail-tour-package/{id}', [HomeController::class, 'tourToPackage'])->name('tourToPackage');
Route::get('all-tour', [AllTourController::class, 'index'])->name('allTour');
Route::get('all-tour-package', [AllTourPackageController::class, 'index'])->name('allTourPackage');
Route::get('all-hotel', [AllHotelController::class, 'index'])->name('allHotel');


Route::middleware(['auth', 'is_member'])->group(function () {
    // Bagian User
    Route::redirect('/home', '/');

    Route::prefix('orders')->group(function () {
        Route::resource('order-package', OrderPackageController::class);
        Route::get('order-package/pdf/{id}', [OrderPackageController::class, 'printPackage'])->name('printPackage');
        Route::resource('order-hotel', OrderHotelController::class);
        Route::get('order-hotel/pdf/{id}', [OrderHotelController::class, 'printHotel'])->name('printHotel');
    });

    Route::get('profil-member', [ProfilController::class, 'index'])->name('profil');
    Route::put('profil-member-update', [ProfilController::class, 'update'])->name('profilUpdate');
});

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::redirect('/home', '/dashboard');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::resource('admin', UserAdminController::class);
        Route::get('member', [UserMemberController::class, 'index'])->name('users.member');
        Route::delete('member/{id}', [UserMemberController::class, 'destroy'])->name('member.destroy');
    });

    Route::prefix('masters')->group(function () {
        Route::resource('category', CategoryController::class);
        Route::resource('tour', TourController::class);
        Route::resource('hotel', HotelController::class);
        Route::resource('tour-package', TourPackageController::class);
        Route::get('/hotel-room/{id}', [HotelRoomController::class, 'index'])->name('hotelRoom');
        Route::get('/hotel-room-create/{id}', [HotelRoomController::class, 'create'])->name('hotelRoomCreate');
        Route::post('/hotel-room/{id}', [HotelRoomController::class, 'store'])->name('hotelRoomStore');
        Route::get('/hotel-room-edit/{id}', [HotelRoomController::class, 'edit'])->name('hotelRoomEdit');
        Route::put('/hotel-room-edit/{id}', [HotelRoomController::class, 'update'])->name('hotelRoomUpdate');
        Route::delete('/hotel-room/{id}', [HotelRoomController::class, 'destroy'])->name('hotelRoomDestroy');
        Route::post('/hotel-room/update-status/{id}', [HotelRoomController::class, 'updateStatus'])->name('hotelRoomUpdateStatus');
    });

    Route::prefix('order-admin')->group(function () {
        Route::resource('order-hotel-admin', OrderHotelAdminController::class);
        Route::resource('order-package-admin', OrderPackageAdminController::class);
    });

    Route::prefix('reports')->group(function () {
        // Package Tour
        Route::get('report-package', [ReportPackageController::class, 'index'])->name('reportPackage');
        Route::get('report-package-pdf', [ReportPackageController::class, 'reportPdf'])->name('reportPackagePdf');
        Route::get('report-package-print/{packageStart}/{packageEnd}', [ReportPackageController::class, 'print'])->name('reportPackagePrint');
        Route::get('report-package-excel/{packageStart}/{packageEnd}', [ReportPackageController::class, 'excelPackage'])->name('reportPackageExcel');

        // Hotel
        Route::get('report-hotel', [ReportHotelController::class, 'index'])->name('reportHotel');
        Route::get('report-hotel-pdf', [ReportHotelController::class, 'reportPdf'])->name('reportHotelPdf');
        Route::get('report-hotel-print/{hotelStart}/{hotelEnd}', [ReportHotelController::class, 'print'])->name('reportHotelPrint');
        Route::get('report-hotel-excel/{hotelStart}/{hotelEnd}', [ReportHotelController::class, 'excelHotel'])->name('reportHotelExcel');
    });

    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::put('setting/{id}', [SettingController::class, 'update'])->name('settingUpdate');
});

// Rute logout yang dapat diakses oleh semua pengguna yang diautentikasi
Route::middleware('auth')->get('logout', [AuthContoller::class, 'logout'])->name('logout');
