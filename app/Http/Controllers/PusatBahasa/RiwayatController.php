<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        // tampilkan halaman riwayat/verifikasi yang sudah selesai
        return view('pusat.riwayat.index');
    }
}
