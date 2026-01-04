<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-fakultas');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email'        => $request->email,
            'password'     => $request->password,
            'is_activated' => 1
        ];

        if (Auth::guard('fakultas')->attempt($credentials, $request->remember)) {
            return redirect()->intended(route('fakultas.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah, atau akun belum diaktifkan.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('fakultas')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('fakultas.login');
    }
}
