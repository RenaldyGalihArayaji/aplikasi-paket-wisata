<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Hotel;
use App\Models\Setting;
use Barryvdh\DomPDF\PDF;
use App\Models\TourPackage;
use Illuminate\Support\Str;
use App\Models\OrderPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class OrderPackageController extends Controller
{
    // Halaman Order/Pesanan
    public function index()
    {
        $orderPackage = OrderPackage::with(['package'])->latest()->get();
        return view('landing.order-package.index', ['title' => 'Order Package'], compact('orderPackage'));
    }

    // Tambah Pesanan di halaman Detail Paket
    public function store(Request $request)
    {
        $request->validate([
            'quantity_package' => 'required|numeric|min:1',
            'departure_date' => 'required',
        ], [
            'quantity_package.required' => 'Jumlah wajib diisi',
            'quantity_package.numeric' => 'Jumlah harus berupa angka',
            'quantity_package.min' => 'Jumlah minimal harus 1',
            'departure_date.required' => 'Tanggal keberangkatan wajib diisi',
        ]);

        $id = $request->id;
        $tourPackage = TourPackage::with('room')->findOrFail($id);

        $existingOrderPackage = OrderPackage::where('user_id', Auth::user()->id)
            ->where('tourPackage_id', $tourPackage->id)
            ->where('payment_status', 'unpaid')
            ->first();

        if ($existingOrderPackage) {
            Alert::error('Error', 'Anda sudah memiliki pemesanan yang belum dibayar. Tolong bayar terlebih dahulu!!');
            return redirect()->back();
        }

        if ($request->departure_date < now()) {
            Alert::error('Error', 'Tanggal keberangkatan tidak boleh di masa lalu.');
            return redirect()->back();
        }

        // Check if the hotel has enough rooms available
        if ($tourPackage->room->status == 'inactive') {
            Alert::error('Error', 'kamar Sudah Terisi.');
            return redirect()->back();
        }

        $code_order = 'PW/' . strtoupper(Str::random(10));
        $amount = $tourPackage->price_total * $request->quantity_package;

        OrderPackage::create([
            'user_id' => Auth::user()->id,
            'tourPackage_id' => $tourPackage->id,
            'code_order' => $code_order,
            'order_date' => now(),
            'departure_date' => $request->departure_date,
            'quantity_package' => $request->quantity_package,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        Alert::success('Success', 'Berhasil Ditambahkan');
        return redirect()->route('order-package.index');
    }

    // Halaman Detail Pesanan
    public function show(string $id)
    {
        $orderPackage = OrderPackage::with(['package'])->findOrFail($id);
        return view('landing.order-package.show', ['title' => 'Detai Order'], compact('orderPackage'));
    }

    // Halaman Pembayaran
    public function edit(string $id)
    {
        $orderPackage = OrderPackage::findOrFail($id);
        return view('landing.order-package.edit', ['title' => 'Upload Bukti'], compact('orderPackage'));
    }

    // Proses Pembayaran
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'account_owner' => 'required',
            'bank_name' => 'required'
        ], [
            'image.required' => 'Gambar wajib diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, jpeg',
            'image.max' => 'Gambar maksimal 2MB',
            'account_owner.required' => 'Nama pemilik akun wajib diisi',
            'bank_name.required' => 'Nama bank wajib diisi'
        ]);

        // Upload gambar
        if ($request->hasFile('image')) {
            // Hapus file lama dari storage
            if ($request->image && Storage::disk('public')->exists('image_payments/' . $request->image)) {
                Storage::disk('public')->delete('image_payments/' . $request->image);
            }

            // Upload file baru dengan format nama ditentukan
            $image = $request->file('image');
            $fileName = 'TourPayment_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('image_payments', $fileName, 'public');
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $request->image;
        }

        // Ambil data order
        $data = OrderPackage::with(['package'])->findOrFail($id);

        // Update data order
        $data->update([
            'account_owner' => $request->account_owner,
            'bank_name' => $request->bank_name,
            'image' => $fileName,
            'payment_status' => 'process'
        ]);

        // Kurangi jumlah kamar di hotel
        $data->package->room->status == 'inactive';
        $data->package->room->save();

        Alert::success('Sukses', 'Bukti Pembayaran Berhasil di Upload!!');
        return redirect()->route('order-package.index');
    }

    // Print Bukti Pembayaran
    public function printPackage($id)
    {
        $orderPackage = OrderPackage::with(['package', 'user'])->findOrFail($id);
        $setting = Setting::first();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('landing.order-package.cetak-package', ['title' => 'Cetak Paket Wisata', 'orderPackage' => $orderPackage, 'setting' => $setting]);
        return $pdf->download('paket-wisata' . '-' . Carbon::now() . '.pdf');
    }
}
