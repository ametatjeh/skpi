<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        // tampilkan halaman pengaturan akun operator pusat bahasa
        return view('pusat.pengaturan.index');
    }

    public function update(Request $request)
    {
        $user = auth()->guard('pusat_bahasa')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pusat_bahasa_users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil dan pengaturan berhasil diperbarui!');
    }
}
