<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Tampilkan form login mahasiswa
     */
    public function showLoginForm()
    {
        // Pastikan file ini ada di resources/views/auth/login-mahasiswa.blade.php
        return view('auth.login-mahasiswa');
    }

    /**
     * Tentukan redirect setelah login berdasarkan role user
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'rektorat':
                return route('rektor.dashboard');
            case 'bpm':
                return route('bpm.dashboard');
            case 'biro_akademik':
                return route('biro.dashboard');
            case 'fakultas':
                return route('fakultas.dashboard');
            case 'pusat_bahasa':
                return route('pusat.dashboard');
            case 'mahasiswa':
                return route('mahasiswa.dashboard');
            default:
                return '/home';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(\Illuminate\Http\Request $request)
    {
        $login = $request->input('login');

        // Check if input is an email
        $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            return [
                'email' => $login,
                'password' => $request->input('password'),
            ];
        }

        // It's a NIM, find the User via Mahasiswa
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $login)->first();

        if ($mahasiswa && $mahasiswa->user) {
            return [
                'email' => $mahasiswa->user->email,
                'password' => $request->input('password'),
            ];
        }

        // Fallback to force failure if NIM not found
        return [
            'email' => null,
            'password' => $request->input('password'),
        ];
    }
}
