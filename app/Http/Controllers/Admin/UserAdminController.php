<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserAdminController extends Controller
{
    public function index()
    {
        $admin = User::where('role', '=', 'admin')->latest()->get();
        return view('admin.users_admin.index', ['title' => 'Users Admin'], compact('admin'));
    }

    public function create()
    {
        return view('admin.users_admin.create', ['title' => 'Tambah Users Admin']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, jpeg',
            'image.max' => 'Gambar maksimal 2MB',
        ]);

        $fileName = 'profil.png';

        if ($request->hasFile('image')) {
            $name = $request->file('image');
            $fileName = 'Profil_' . time() . '.' . $name->getClientOriginalExtension();
            Storage::putFileAs('/public/image_profil', $request->file('image'), $fileName);
        }

        User::create([
            'name' => strtolower($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'image' => $fileName
        ]);

        Alert::success('Sukses', 'Data Berhasil Ditambahkan!');
        return redirect()->route('admin.index');
    }

    public function edit(string $id)
    {
        $admin = User::findOrFail($id);
        return view('admin.users_admin.edit', ['title' => 'Edit Users Admin'], compact('admin'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.mimes' => 'Gambar harus berupa jpg, png, jpeg',
            'image.max' => 'Gambar maksimal 2MB',
        ]);

        $admin = User::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('/public/image_profil' . $admin->image);
            $name = $request->file('image');
            $fileName = 'Profil_' . time() . '.' . $name->getClientOriginalExtension();
            $request->file('image')->storeAs('/public/image_profil', $fileName);
        } else {
            $fileName = $admin->image;
        }

        $admin->update([
            'name' => strtolower($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $fileName
        ]);

        Alert::success('Sukses', 'Data Berhasil Diperbarui!');
        return redirect()->route('admin.index');
    }

    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        Storage::delete('/public/image_profil' . $admin->image);
        $admin->delete();
        return redirect()->back();
    }
}
