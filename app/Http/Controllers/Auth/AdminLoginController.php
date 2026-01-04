<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        // View login admin, pastikan resources/views/auth/login-admin.blade.php ada
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        // Ambil data email, password, dan wajib ada kolom is_activated = 1
        $credentials = $request->only('email', 'password');
        $credentials['is_activated'] = 1; // hanya akun aktif yang bisa login

        $remember = $request->filled('remember');

        // Gunakan guard admin, coba login
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect setelah login sukses ke dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }

        // Gagal login, kembali ke form dengan pesan error
        return back()->withErrors(['email' => 'Email atau password admin salah, atau akun belum aktif.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
