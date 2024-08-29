<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::with('user')->first();
        return view('admin.setting.index', ['title' => 'Pengaturan'], compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'logo' => 'image|mimes:jpg,png,jpeg|max:2048',
            'image_hero' => 'image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'logo.image' => 'File logo harus berupa gambar',
            'image_hero.image' => 'File gambar hero harus berupa gambar',
        ]);

        // Ambil user admin pertama
        $user = User::where('role', '=', 'admin')->firstOrFail();

        // Ambil setting berdasarkan user_id dan id
        $setting = Setting::where('user_id', $user->id)->findOrFail($id);

        if ($request->hasFile('logo')) {
            // Hapus file logo lama jika ada
            if ($setting->logo && Storage::disk('public')->exists('image_settings/' . $setting->logo)) {
                Storage::disk('public')->delete('image_settings/' . $setting->logo);
            }

            // Simpan file logo baru
            $fileNameLogo = 'Logo_' . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->storeAs('image_settings', $fileNameLogo, 'public');
        } else {
            $fileNameLogo = $setting->logo;
        }

        if ($request->hasFile('image_hero')) {
            // Hapus file image_hero lama jika ada
            if ($setting->image_hero && Storage::disk('public')->exists('image_settings/' . $setting->image_hero)) {
                Storage::disk('public')->delete('image_settings/' . $setting->image_hero);
            }

            // Simpan file image_hero baru
            $fileNameHero = 'Hero_' . time() . '.' . $request->image_hero->getClientOriginalExtension();
            $request->image_hero->storeAs('image_settings', $fileNameHero, 'public');
        } else {
            $fileNameHero = $setting->image_hero;
        }


        $setting->update([
            'user_id' => Auth::user()->id,
            'name_app' => $request->name_app,
            'short_description' => $request->short_description,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'name_hero' => $request->name_hero,
            'account_number' => $request->account_number,
            'account_owner' => $request->account_owner,
            'bank_name' => $request->bank_name,
            'link_youtube' => $request->link_youtube,
            'link_instagram' => $request->link_instagram,
            'logo' => $fileNameLogo,
            'image_hero' => $fileNameHero,
            'updated_at' => now(),
        ]);

        Alert::success('Sukses', 'Data Berhasil Diperbarui!');
        return redirect()->back();
    }
}
