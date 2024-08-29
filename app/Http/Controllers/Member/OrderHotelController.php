<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Hotel;
use App\Models\OrderHotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HotelRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class OrderHotelController extends Controller
{
    public function index()
    {
        $orderHotel = OrderHotel::with('room')->latest()->get();
        return view('landing.order-hotel.index', ['title' => 'Order Hotel'], compact('orderHotel'));
    }

    // Tambah Order Hotel
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
        ], [
            'room_id.required' => 'kamar harus diisi',
            'check_in_date.required' => 'tanggal check in harus diisi',
            'check_out_date.required' => 'tanggal check out harus diisi',
        ]);

        $hotelRoom = HotelRoom::findOrFail($request->room_id);
        $existingOrderHotel = OrderHotel::where('user_id', Auth::user()->id)
            ->where('payment_status', 'unpaid')
            ->where('room_id', $hotelRoom->id)
            ->first();

        if ($existingOrderHotel) {
            Alert::error('Error', 'Anda sudah memiliki pemesanan yang belum dibayarkan.');
            return redirect()->back();
        }

        if ($request->check_in_date < now()) {
            Alert::error('Error', 'Tanggal masuk tidak boleh kurang dari hari sekarang!');
            return redirect()->back();
        }

        if ($request->check_out_date < now()) {
            Alert::error('Error', 'Tanggal keluar tidak boleh kurang dari hari sekarang!');
            return redirect()->back();
        }


        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->check_out_date);
        $numberOfDays = $checkInDate->diffInDays($checkOutDate);
        $totalAmount = $hotelRoom->price_final * $numberOfDays;

        $code_order = 'HT/' . strtoupper(Str::random(10));

        OrderHotel::create([
            'user_id' => Auth::user()->id,
            'room_id' => $hotelRoom->id,
            'code_order' => $code_order,
            'order_date' => now(),
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'special_requests' => $request->special_requests,
            'amount' => $totalAmount,
        ]);

        Alert::success('Success', 'Berhasil Ditambahkan');
        return redirect()->back();
    }

    public function show(string $id)
    {
        $orderHotel = OrderHotel::with('room')->findOrFail($id);
        return view('landing.order-hotel.show', ['title' => 'Detail Order'], compact('orderHotel'));
    }

    public function edit(string $id)
    {
        $orderHotel = OrderHotel::findOrFail($id);
        return view('landing.order-hotel.edit', ['title' => 'Bukti Pemabayaran'], compact('orderHotel'));
    }

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
        $data = OrderHotel::findOrFail($id);
        $room = HotelRoom::findOrFail($data->room_id);

        // Update data order
        $data->update([
            'account_owner' => $request->account_owner,
            'bank_name' => $request->bank_name,
            'image' => $fileName,
            'payment_status' => 'process'
        ]);

        // Kurangi jumlah kamar di hotel
        $room->status == 'inactive';
        $room->save();

        Alert::success('Sukses', 'Bukti Pembayaran Berhasil di Upload!!');
        return redirect()->route('order-hotel.index');
    }

    public function printHotel($id)
    {
        $orderHotel = OrderHotel::with(['room', 'user'])->findOrFail($id);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('landing.order-hotel.cetak-hotel', ['title' => 'Cetak Hotek', 'orderHotel' => $orderHotel])->setPaper('a4', 'landscape');
        return $pdf->download('Hotel' . '-' . Carbon::now() . '.pdf');
    }
}
