<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProdiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ActivationController extends Controller
{
    /**
     * Menampilkan form aktivasi berdasarkan token
     */
    public function showActivationForm($token)
    {
        // Cek token di tabel users (untuk mahasiswa)
        $user = User::where('activation_token', $token)
            ->where('activation_token_expires_at', '>', now())
            ->first();

        // Jika tidak ditemukan, cek di tabel prodi_users (untuk prodi)
        if (!$user) {
            $user = ProdiUser::where('activation_token', $token)
                ->where('activation_token_expires_at', '>', now())
                ->first();
        }

        // Jika token tidak valid atau kadaluarsa
        if (!$user) {
            abort(404, 'Token aktivasi tidak valid atau sudah kadaluarsa');
        }
        // Jika akun sudah diaktifkan sebelumnya
        if ($user->is_activated) {
            return redirect()->route('mahasiswa.login')->with('info', 'Akun sudah diaktifkan, silakan login.');
        }

        return view('auth.activation', compact('user'));
    }

    /**
     * Proses aktivasi akun dan set password
     */
    public function activate(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ], [
            'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, dan angka.',
        ]);

        // Cek token di tabel users
        $user = User::where('activation_token', $token)
            ->where('activation_token_expires_at', '>', now())
            ->first();

        // Jika tidak ada, cek di tabel prodi_users
        if (!$user) {
            $user = ProdiUser::where('activation_token', $token)
                ->where('activation_token_expires_at', '>', now())
                ->first();
        }

        // Jika token tidak valid
        if (!$user) {
            abort(404, 'Token tidak valid atau sudah kadaluarsa');
        }

        // Update password dan status aktivasi
        $user->update([
            'password' => Hash::make($request->password),
            'is_activated' => true,
            'activation_token' => null,
            'activation_token_expires_at' => null,
        ]);

        return redirect()->route('mahasiswa.login')->with('activation_success', 'Akun berhasil diaktifkan! Silakan login dengan email dan password Anda.');
    }
}
