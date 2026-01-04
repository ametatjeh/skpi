<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // tampilkan daftar mahasiswa + filter/pencarian
        return view('pusat.mahasiswa.index');
    }
}
