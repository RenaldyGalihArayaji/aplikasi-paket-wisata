<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AuthContoller extends Controller
{
    public function login()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'member') {
                return redirect()->route('home');
            } else {
                return redirect()->route('dashboard');
            }
        }

        Alert::error('Gagal', 'Email dan Password Salah!!');
        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register', ['title' => 'Registrasi']);
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|max:13',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'phone.required' => 'Nomor Telepon harus diisi',
            'phone.max' => 'Nomor Telepon maksimal 13 karakter',
            'address.required' => 'Alamat harus diisi',
            'gender.required' => 'Jenis Kelamin harus diisi',
            'image.required' => 'Foto harus diisi',
            'image.image' => 'Foto harus berupa gambar',
            'image.mimes' => 'Foto harus berupa jpg, png, atau jpeg',
            'image.max' => 'Foto maksimal 2MB',
        ]);

        if ($request->hasFile('image')) {
            $name = $request->file('image');
            $fileName = 'Profil_' . time() . '.' . $name->getClientOriginalExtension();
            Storage::putFileAs('/public/image_profil', $request->file('image'), $fileName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'image' => $fileName,
        ]);

        Alert::success('Sukses', 'Pendaftaran Berhasil!!');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
