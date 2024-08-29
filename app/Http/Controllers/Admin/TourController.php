<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TourController extends Controller
{
    public function index()
    {
        $tour = Tour::where('user_id', '=', Auth::user()->id)->latest()->get();
        return view('admin.tour.index', ['title' => 'Wisata'], compact('tour'));
    }

    public function create()
    {
        return view('admin.tour.create', ['title' => 'Tambah Wisata']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama Wisata wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga minimal Rp. 1',
            'image.required' => 'Gambar wajib diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, jpeg',
            'image.max' => 'Gambar maksimal 2MB',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file lama dari storage
            if ($request->image && Storage::disk('public')->exists('image_tours/' . $request->image)) {
                Storage::disk('public')->delete('image_tours/' . $request->image);
            }

            // Upload file baru dengan format nama ditentukan
            $image = $request->file('image');
            $fileName = 'Tour_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('image_tours', $fileName, 'public');
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $request->image;
        }

        Tour::create([
            'user_id' => Auth::user()->id,
            'name' => strtolower($request->name),
            'price' => $request->price,
            'description' => strtolower($request->description),
            'image' => $fileName
        ]);

        Alert::success('Sukses', 'Data Berhasil Ditambahkan!');
        return redirect()->route('tour.index');
    }

    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        return view('admin.tour.edit', ['title' => 'Edit Wisata'], compact('tour'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga minimal Rp. 1',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, jpeg',
            'image.max' => 'Gambar maksimal 2MB',
        ]);

        $tour = Tour::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus file lama dari storage
            if ($tour->image && Storage::disk('public')->exists('image_tours/' . $tour->image)) {
                Storage::disk('public')->delete('image_tours/' . $tour->image);
            }

            // Upload file baru dengan format nama ditentukan
            $image = $request->file('image');
            $fileName = 'Tour_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('image_tours', $fileName, 'public');
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $tour->image;
        }

        $tour->update([
            'user_id' => Auth::user()->id,
            'name' => strtolower($request->name),
            'price' => $request->price,
            'description' => strtolower($request->description),
            'image' => $fileName,
        ]);

        Alert::success('Sukses', 'Data Berhasil Diperbarui!');
        return redirect()->route('tour.index');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        Storage::delete('/public/image_tours' . $tour->image);
        $tour->delete();
        return redirect()->back();
    }
}
