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
        // Ambil data email, password
        $credentials = $request->only('email', 'password');
        // Anggap admin adalah biro_akademik


        $remember = $request->filled('remember');

        // Gunakan guard admin, coba login
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect setelah login sukses ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Gagal login, kembali ke form dengan pesan error
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
