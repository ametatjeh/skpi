<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\ProdiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\SendActivationEmailJob;

class EmailRegistrationController extends Controller
{
    public function showForm()
    {
        $prodis = Prodi::orderBy('nama_prodi')->get();
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('auth.register-email', compact('prodis', 'fakultas'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'role' => 'required|in:mahasiswa,prodi,fakultas,rektor',
        ]);

        if ($request->role === 'mahasiswa') {
            return $this->registerMahasiswa($request);
        } elseif ($request->role === 'prodi') {
            return $this->registerProdi($request);
        } else {
            return $this->registerStaff($request); // fakultas dan rektor
        }
    }

    protected function registerMahasiswa(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
        if (!$mahasiswa) {
            return back()->withErrors(['nim' => 'NIM tidak ditemukan dalam database']);
        }
        if ($mahasiswa->user_id) {
            $existingUser = User::find($mahasiswa->user_id);
            if ($existingUser && $existingUser->is_activated) {
                return back()->withErrors(['nim' => 'NIM sudah terdaftar dan aktif. Silakan login.']);
            }
        }

        $user = User::create([
            'prodi_id' => $mahasiswa->prodi_id,
            'name' => $mahasiswa->nama,
            'email' => $request->email,
            'role' => 'mahasiswa',
            'is_activated' => false,
            'activation_token' => Str::random(60),
            'activation_token_expires_at' => now()->addDays(7),
        ]);

        $mahasiswa->update([
            'user_id' => $user->id,
            'email' => $request->email,
        ]);

        SendActivationEmailJob::dispatch($user);

        return redirect()->route('email.registration.form')->with([
            'success' => 'Registrasi berhasil! Silakan cek email Anda untuk aktivasi akun.',
            'redirect_to_login' => true
        ]);
    }

    protected function registerProdi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:prodi_users,email',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $prodiUser = ProdiUser::create([
            'prodi_id' => $request->prodi_id,
            'name' => $request->name,
            'email' => $request->email,
            'is_activated' => false,
            'activation_token' => Str::random(60),
            'activation_token_expires_at' => now()->addDays(7),
        ]);

        SendActivationEmailJob::dispatch($prodiUser);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk aktivasi akun.');
    }

    protected function registerStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_activated' => false,
            'activation_token' => Str::random(60),
            'activation_token_expires_at' => now()->addDays(7),
        ];

        if ($request->role === 'fakultas') {
            $request->validate([
                'fakultas_id' => 'required|exists:fakultas,id',
            ]);
            $userData['fakultas_id'] = $request->fakultas_id;
        }

        $user = User::create($userData);

        SendActivationEmailJob::dispatch($user);

        return redirect()->route('mahasiswa.login')->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk aktivasi akun.');
    }
}
