<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class OrderPackageAdminController extends Controller
{

    public function index()
    {
        $data = OrderPackage::with(['package'])->latest()->get();
        return view('admin.order_admin_package.index', ['title' => 'Order Paket Wisata'], compact('data'));
    }


    public function show(string $id)
    {
        $data = OrderPackage::with(['package', 'user'])->findOrFail($id);
        return view('admin.order_admin_package.show', ['title' => 'Detai Order'], compact('data'));
    }

    public function edit(string $id)
    {
        $data = OrderPackage::with(['package'])->findOrFail($id);
        return view('admin.order_admin_package.edit', ['title' => 'Bukti Pembayaran'], compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = OrderPackage::with(['package'])->findOrFail($id);
        $data->update([
            'payment_status' => 'paid',
        ]);

        Alert::success('Sukses', 'Konfirmasi Pembayar Berhasil!!');
        return redirect()->route('order-package-admin.index');
    }


    public function destroy(string $id)
    {
        $data = OrderPackage::with(['package'])->findOrFail($id);
        Storage::delete('/public/image_payments' . $data->image);
        $data->delete();
        return redirect()->back();
    }
}
