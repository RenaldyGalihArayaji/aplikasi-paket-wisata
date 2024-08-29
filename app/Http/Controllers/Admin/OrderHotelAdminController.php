<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderHotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class OrderHotelAdminController extends Controller
{
    public function index()
    {
        $data = OrderHotel::with('room')->latest()->get();
        return view('admin.order_admin_hotel.index', ['title' => 'Order Hotel'], compact('data'));
    }


    public function show(string $id)
    {
        $data = OrderHotel::with('room')->findOrFail($id);
        return view('admin.order_admin_hotel.show', ['title' => 'Detail Order Hotel'], compact('data'));
    }

    public function edit(string $id)
    {
        $data = OrderHotel::with('user')->findOrFail($id);
        return view('admin.order_admin_hotel.edit', ['title' => 'Bukti Pemabayaran'], compact('data'));
    }


    public function update(Request $request, string $id)
    {
        $data = OrderHotel::findOrFail($id);
        $data->update([
            'payment_status' => 'paid',
        ]);

        Alert::success('Sukses', 'Konfirmasi Pembayar Berhasil!!');
        return redirect()->route('order-hotel-admin.index');
    }

    public function destroy(string $id)
    {
        $data = OrderHotel::findOrFail($id);
        Storage::delete('/public/image_payments' . $data->image);
        $data->delete();
        return redirect()->back();
    }
}
