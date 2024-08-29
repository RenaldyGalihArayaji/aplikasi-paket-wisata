<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    public function index()
    {
        return view('landing.profil.index', ['title' => 'Profil']);
    }

    public function update(Request $request)
    {
        $data = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $data->id,
            'password' => 'nullable|min:8',
            'phone' => 'required|max:13',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'phone.required' => 'Nomor Telepon harus diisi',
            'phone.max' => 'Nomor Telepon maksimal 13 karakter',
            'address.required' => 'Alamat harus diisi',
            'gender.required' => 'Jenis Kelamin harus diisi',
            'image.image' => 'Foto harus berupa gambar',
            'image.mimes' => 'Foto harus berupa jpg, png, atau jpeg',
            'image.max' => 'Foto maksimal 2MB',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            Storage::delete('public/image_profil/' . $data->image);
            $name = $request->file('image');
            $fileName = 'Profil_' . time() . '.' . $name->getClientOriginalExtension();
            $request->file('image')->storeAs('public/image_profil', $fileName);
            $updateData['image'] = $fileName;
        }

        $data->update($updateData);

        Alert::success('Sukses', 'Profil berhasil diperbarui!');
        return redirect()->route('profil');
    }
}
