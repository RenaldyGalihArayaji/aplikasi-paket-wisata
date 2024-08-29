<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HotelRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::where('user_id', '=', Auth::user()->id)
            ->with(['room' => function ($query) {
                $query->where('status', 'active');
            }])->latest()->get();


        return view('admin.hotel.index', ['title' => 'Hotel'], compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotel.create', ['title' => 'Tambah Hotel']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'star' => 'required|numeric|max:5|min:1',
            'location' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama Hotel wajib diisi',
            'star.required' => 'Bintang wajib diisi',
            'star.numeric' => 'Bintang harus berupa angka',
            'star.max' => 'Bintang maksimal 5',
            'star.min' => 'Bintang minimal 1',
            'location.required' => 'Jumlah kuota wajib diisi',
            'image.required' => 'Gambar wajib diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, jpeg',
            'image.max' => 'Gambar maksimal 2MB',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file lama dari storage
            if ($request->image && Storage::disk('public')->exists('image_hotels/' . $request->image)) {
                Storage::disk('public')->delete('image_hotels/' . $request->image);
            }

            // Upload file baru dengan format nama ditentukan
            $image = $request->file('image');
            $fileName = 'hotel_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('image_hotels', $fileName, 'public');
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $request->image;
        }

        Hotel::create([
            'user_id' => Auth::user()->id,
            'name' => strtolower($request->name),
            'location' => $request->location,
            'star' => $request->star,
            'image' => $fileName
        ]);

        Alert::success('Sukses', 'Data Berhasil Ditambahkan!');
        return redirect()->route('hotel.index');
    }

    public function edit($id)
    {
        $hotel = hotel::findOrFail($id);
        return view('admin.hotel.edit', ['title' => 'Edit Hotel'], compact('hotel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'star' => 'required|numeric|max:5|min:1',
            'location' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama Hotel wajib diisi',
            'location.required' => 'Lokasi Wajin diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, jpeg',
            'image.max' => 'Gambar maksimal 2MB',
            'star.required' => 'Bintang wajib diisi',
            'star.numeric' => 'Bintang harus berupa angka',
            'star.max' => 'Bintang maksimal 5',
        ]);

        $hotel = Hotel::findOrFail($id);

        // Cek apakah upload file
        if ($request->hasFile('image')) {
            // Hapus file lama dari storage
            if ($hotel->image && Storage::disk('public')->exists('image_hotels/' . $hotel->image)) {
                Storage::disk('public')->delete('image_hotels/' . $hotel->image);
            }

            // Upload file baru dengan format nama ditentukan
            $image = $request->file('image');
            $fileName = 'hotel_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('image_hotels', $fileName, 'public');
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $hotel->image;
        }


        $hotel->update([
            'name' => strtolower($request->name),
            'location' => $request->location,
            'star' => $request->star,
            'image' => $fileName,
        ]);

        Alert::success('Sukses', 'Data Berhasil Diperbarui!');
        return redirect()->route('hotel.index');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        Storage::delete('/public/image_hotels' . $hotel->image);
        $hotel->delete();
        return redirect()->back();
    }
}
