<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelRoom;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HotelRoomController extends Controller
{
    public function index($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotelRoom = HotelRoom::where('hotel_id', '=', $hotel->id)->latest()->get();
        return view('admin.hotel_room.index', ['title' => 'Kamar Hotel'], compact('hotelRoom', 'hotel'));
    }

    public function create($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotel_room.create', ['title' => 'Tambah Kamar'], compact('hotel'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'room_type' => 'required',
            'facility' => 'required',
            'price_start' => 'required|numeric',
        ], [
            'room_type.required' => 'Tipe Kamar harus diisi',
            'facility.required' => 'Fasilitas harus diisi',
            'price_start.required' => 'Harga harus diisi',
            'price_start.numeric' => 'Harga harus berupa angka',
        ]);

        $hotel = Hotel::findOrFail($id);

        HotelRoom::create([
            'hotel_id' => $hotel->id,
            'room_type' => $request->room_type,
            'facility' => $request->facility,
            'price_start' => $request->price_start,
            'price_final' => $request->price_start,
        ]);

        Alert::success('Sukses', 'Data Berhasil Ditambahkan!');
        return redirect()->route('hotelRoom', $hotel->id);
    }

    public function edit($id)
    {
        $hotelRoom = HotelRoom::findOrFail($id);
        $hotel = Hotel::findOrFail($hotelRoom->hotel_id);
        return view('admin.hotel_room.edit', ['title' => 'Edit Kamar'], compact('hotelRoom', 'hotel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_type' => 'required',
            'facility' => 'required',
            'price_start' => 'required|numeric',
            'discount' => 'nullable|numeric|max:100',
            'status' => 'required'
        ], [
            'room_type.required' => 'Tipe Kamar harus diisi',
            'facility.required' => 'Fasilitas harus diisi',
            'price_start.required' => 'Harga harus diisi',
            'price_start.numeric' => 'Harga harus berupa angka',
            'discount.numeric' => 'Diskon harus berupa angka',
            'discount.max' => 'Diskon maksimal 100%',
            'status.required' => 'Status harus diisi'
        ]);

        $hotelRoom = HotelRoom::findOrFail($id);
        $hotel = Hotel::findOrFail($hotelRoom->hotel_id);

        $price_start = $request->price_start;
        $discount = $request->discount;
        $price_final = $price_start - ($price_start * ($discount / 100));

        $hotelRoom->update([
            'hotel_id' => $hotel->id,
            'room_type' => $request->room_type,
            'facility' => $request->facility,
            'price_start' => $price_start,
            'price_final' => $price_final,
            'discount' => $discount,
            'status' => $request->status
        ]);

        Alert::success('Sukses', 'Data Berhasil Diperbarui!');
        return redirect()->route('hotelRoom', $hotel->id);
    }

    public function destroy($id)
    {
        $hotelRoom = HotelRoom::findOrFail($id);
        $hotelRoom->delete();
        return redirect()->back();
    }
}
