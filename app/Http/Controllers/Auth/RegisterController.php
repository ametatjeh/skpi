<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Setelah registrasi, user diarahkan ke /home
     */
    protected $redirectTo = '/home';

    /**
     * Middleware guest (tidak boleh login)
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validasi form registrasi
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Simpan user baru ke tabel users dan mahasiswa
     */
    protected function create(array $data)
    {
        // 1️⃣ Simpan user baru ke tabel users
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'mahasiswa', // default role untuk user baru
        ]);

        // 2️⃣ Tambahkan otomatis ke tabel mahasiswa
        \App\Models\Mahasiswa::create([
            'user_id' => $user->id,
            'prodi_id' => 1,
            'nim' => 'TEMP-' . $user->id,
            'nama' => $data['name'],
            'tempat_lahir' => '-', // default kosong tapi non-null
            'tanggal_lahir' => now(), // atau null kalau boleh
            'tahun_masuk' => date('Y'),
            'tanggal_lulus' => null,
            'gelar' => '-',
            'no_ijazah' => '-',
        ]);


        return $user;
    }
}
