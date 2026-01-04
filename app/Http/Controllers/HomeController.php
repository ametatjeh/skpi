<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // ===== REDIRECT BERDASARKAN ROLE =====

        // 1. Jika MAHASISWA → redirect ke /mahasiswa
        if ($user->role === 'mahasiswa') {
            // Return view, jangan redirect!
            return redirect('/mahasiswa');
        }

        // 2. Jika PRODI → redirect ke /prodi
        if ($user->role === 'prodi') {
            return redirect('/prodi');
        }

        // 3. Jika ADMIN → redirect ke /admin
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        // 4. Default fallback
        return view('home');
    }
}
