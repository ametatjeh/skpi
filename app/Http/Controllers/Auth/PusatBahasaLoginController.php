<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PusatBahasaLoginController extends Controller
{
    public function showLoginForm()
    {
        // Pastikan file 'auth.login-pusat-bahasa' ada di resources/views/auth/
        return view('auth.login-pusat-bahasa');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'pusat_bahasa';

        // Guard harus sama dengan yang didefinisikan di config/auth.php
        if (Auth::guard('pusat_bahasa')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->route('pusat.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password pusat bahasa salah, atau Anda bukan Pusat Bahasa.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('pusat_bahasa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('pusat.login'));
    }
}
