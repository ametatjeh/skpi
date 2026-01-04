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
        // simpan update pengaturan: misal password, email, dsb
        // Validasi + proses logic di sini
        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
