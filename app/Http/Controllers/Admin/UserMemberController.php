<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserMemberController extends Controller
{
    public function index()
    {
        $member = User::where('role', '=', 'member')->latest()->get();
        return view('admin.users_member.index', ['title' => 'Users Member'], compact('member'));
    }

    public function destroy($id)
    {
        $member = User::find($id);
        Storage::delete('/public/image_profil' . $member->image);
        $member->delete();
        return redirect()->back();
    }
}
