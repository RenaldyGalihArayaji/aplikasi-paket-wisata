<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tour;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\HotelRoom;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TourPackageController extends Controller
{
    public function index()
    {
        $tourPackage = TourPackage::with(['room', 'tour'])
            ->where('user_id', '=', Auth::user()->id)
            ->latest()
            ->get();
        return view('admin.tour_packages.index', ['title' => 'Paket Wisata'], compact('tourPackage'));
    }

    public function create()
    {
        $tour = Tour::all();
        $room = HotelRoom::with('hotel')->where('status', '=', 'active')->get();
        return view('admin.tour_packages.create', ['title' => 'Tambah Paket Wisata'], compact('tour', 'room'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'package_name' => 'required|unique:tour_packages',
            'room_id' => 'required|exists:hotel_rooms,id',
            'tour_id' => 'required|exists:tours,id',
            'capacity' => 'required|numeric|min:1',
            'duration' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'package_name.required' => 'Nama paket wisata tidak boleh kosong',
            'package_name.unique' => 'Nama paket wisata sudah digunakan',
            'room_id.required' => 'Kamar tidak boleh kosong',
            'room_id.exists' => 'Kamar tidak ditemukan',
            'tour_id.required' => 'Tujuan Wisata tidak boleh kosong',
            'tour_id.exists' => 'Wisata tidak ditemukan',
            'capacity.required' => 'Jumlah kapasitas tidak boleh kosong',
            'capacity.numeric' => 'Jumlah kapasitas harus berupa angka',
            'capacity.min' => 'Jumlah kapasitas minimal 1',
            'duration.required' => 'Durasi tidak boleh kosong',
            'duration.numeric' => 'Durasi harus berupa angka',
            'duration.min' => 'Durasi minimal 1',
            'image.required' => 'Gambar tidak boleh kosong',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, atau jpeg',
            'image.max' => 'Gambar maksimal 2 MB',
        ]);

        // Proses upload gambar
        if ($request->hasFile('image')) {
            // Hapus file lama dari storage
            if ($request->image && Storage::disk('public')->exists('image_packages/' . $request->image)) {
                Storage::disk('public')->delete('image_packages/' . $request->image);
            }

            // Upload file baru dengan format nama ditentukan
            $image = $request->file('image');
            $fileName = 'TourPackage_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('image_packages', $fileName, 'public');
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $request->image;
        }

        // Ambil data kamar yang dipilih
        $room = HotelRoom::with('hotel')->find($request->room_id);
        if (!$room) {
            return redirect()->back()->withErrors(['room_id' => 'Kamar tidak ditemukan.']);
        }

        // Ambil data wisata yang dipilih
        $tour = Tour::find($request->tour_id);
        if (!$tour) {
            return redirect()->back()->withErrors(['tour_id' => 'Wisata tidak ditemukan.']);
        }

        // Hitung jumlah malam
        $numberOfNights = $request->duration > 1 ? $request->duration - 1 : 1;

        // Hitung harga hotel untuk jumlah malam
        $priceHotel = $room->price_final * $numberOfNights;

        // Hitung harga Wisata
        $priceTour = $tour->price;
        $pricePackageTotal = $priceHotel + $priceTour;

        // Simpan data paket tur
        TourPackage::create([
            'user_id' => Auth::user()->id,
            'tour_id' => $request->tour_id,
            'room_id' => $room->id, // Menyimpan room_id
            'package_name' => strtolower($request->package_name),
            'capacity' => $request->capacity,
            'duration' => $request->duration,
            'price_hotel' => $priceHotel,
            'price_tour' => $priceTour,
            'price_total' => $pricePackageTotal,
            'image' => $fileName,
        ]);

        // Tampilkan pesan sukses
        Alert::success('Sukses', 'Data Berhasil Ditambahkan!');
        return redirect()->route('tour-package.index');
    }

    public function show($id)
    {
        $tourPackage = TourPackage::with(['room', 'tour'])->findOrFail($id);
        return view('admin.tour_packages.show', ['title' => 'Detail Paket Wisata'], compact('tourPackage'));
    }

    public function edit($id)
    {
        $tourPackage = TourPackage::with(['room.hotel', 'tour'])->findOrFail($id);
        $rooms = HotelRoom::with('hotel')->where('id', '!=', $tourPackage->room_id)->get();
        $tours = Tour::where('id', '!=', $tourPackage->tour_id)->get(['id', 'name']);
        return view('admin.tour_packages.edit', ['title' => 'Edit Paket Wisata'], compact('tourPackage', 'rooms', 'tours'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'package_name' => 'required|unique:tour_packages,package_name,' . $id,
            'room_id' => 'required|exists:hotel_rooms,id',
            'tour_id' => 'required|exists:tours,id',
            'capacity' => 'required|numeric|min:1',
            'duration' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'package_name.required' => 'Nama paket wisata tidak boleh kosong',
            'package_name.unique' => 'Nama paket wisata sudah digunakan',
            'room_id.required' => 'Kamar tidak boleh kosong',
            'room_id.exists' => 'Kamar tidak ditemukan',
            'tour_id.required' => 'Tujuan Wisata tidak boleh kosong',
            'tour_id.exists' => 'Wisata tidak ditemukan',
            'capacity.required' => 'Jumlah kapasitas tidak boleh kosong',
            'capacity.numeric' => 'Jumlah kapasitas harus berupa angka',
            'capacity.min' => 'Jumlah kapasitas minimal 1',
            'duration.required' => 'Durasi tidak boleh kosong',
            'duration.numeric' => 'Durasi harus berupa angka',
            'duration.min' => 'Durasi minimal 1',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, atau jpeg',
            'image.max' => 'Gambar maksimal 2 MB',
        ]);

        $tourPackage = TourPackage::findOrFail($id);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus file lama dari storage
            if ($request->image && Storage::disk('public')->exists('image_packages/' . $request->image)) {
                Storage::disk('public')->delete('image_packages/' . $request->image);
            }

            // Upload file baru dengan format nama ditentukan
            $image = $request->file('image');
            $fileName = 'TourPackage_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('image_packages', $fileName, 'public');
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $request->image;
        }

        // Ambil data kamar yang dipilih
        $room = HotelRoom::with('hotel')->find($request->room_id);
        if (!$room) {
            return redirect()->back()->withErrors(['room_id' => 'Kamar tidak ditemukan.']);
        }

        // Ambil data wisata yang dipilih
        $tour = Tour::find($request->tour_id);
        if (!$tour) {
            return redirect()->back()->withErrors(['tour_id' => 'Wisata tidak ditemukan.']);
        }

        // Hitung jumlah malam
        $numberOfNights = $request->duration > 1 ? $request->duration - 1 : 1;

        // Hitung harga hotel untuk jumlah malam
        $priceHotel = $room->price_final * $numberOfNights;

        // Hitung harga Wisata
        $priceTour = $tour->price;
        $pricePackageTotal = $priceHotel + $priceTour;

        // Update data paket tur
        $tourPackage->update([
            'user_id' => Auth::user()->id,
            'tour_id' => $request->tour_id,
            'room_id' => $room->id, // Menyimpan room_id
            'package_name' => strtolower($request->package_name),
            'capacity' => $request->capacity,
            'duration' => $request->duration,
            'price_hotel' => $priceHotel,
            'price_tour' => $priceTour,
            'price_total' => $pricePackageTotal,
            'image' => $fileName,
        ]);

        // Tampilkan pesan sukses
        Alert::success('Sukses', 'Data Berhasil Diperbarui!');
        return redirect()->route('tour-package.index');
    }

    public function destroy($id)
    {
        $tourPackage = TourPackage::findOrFail($id);
        Storage::delete('/public/image_packages/' . $tourPackage->image);
        $tourPackage->delete();
        return redirect()->back();
    }
}
