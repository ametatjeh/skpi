<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PengaturanAdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.pengaturan.index', compact('admin'));
    }

    public function updateProfil(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $data = $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->password_lama, $admin->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah']);
        }

        $admin->password = bcrypt($request->password_baru);
        $admin->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
