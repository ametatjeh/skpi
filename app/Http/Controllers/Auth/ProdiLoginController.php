<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiLoginController extends Controller
{
    public function showLoginForm()
    {
        // Pastikan file 'auth.login-prodi' ada di resources/views/auth/
        return view('auth.login-prodi');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['is_activated'] = 1; // tambah syarat aktif

        if (Auth::guard('prodi')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('prodi.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password prodi salah, atau akun belum aktif.']);
    }


    public function logout(Request $request)
    {
        Auth::guard('prodi')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('prodi.login'));
    }
}
