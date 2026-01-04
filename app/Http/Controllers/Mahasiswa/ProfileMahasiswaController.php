<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class ProfileMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $user = auth()->user();
        return view('mahasiswa.profile.index', compact('mahasiswa', 'user'));
    }

    public function update(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'nama'                   => 'required|string|max:255',
            'email'                  => 'required|email|max:255|unique:users,email,' . $mahasiswa->user_id,
            'no_hp'                  => 'nullable|string|max:20',
            'alamat'                 => 'nullable|string',
            'jenis_kelamin'          => 'nullable|in:L,P',
            'agama'                  => 'nullable|string|max:25',
            'tempat_tanggal_lahir'   => 'nullable|string|max:255',
            'tanggal_lulus'          => 'nullable|string|max:50',
            'gelar'                  => 'nullable|string|max:50',
            'no_ijazah'              => 'nullable|string|max:100',
        ]);

        $mahasiswa->update([
            'nama'                 => $validated['nama'],
            'alamat'               => $validated['alamat'] ?? $mahasiswa->alamat,
            'no_hp'                => $validated['no_hp'] ?? $mahasiswa->no_hp,
            'jenis_kelamin'        => $validated['jenis_kelamin'] ?? $mahasiswa->jenis_kelamin,
            'agama'                => $validated['agama'] ?? $mahasiswa->agama,
            'tempat_tanggal_lahir' => $validated['tempat_tanggal_lahir'] ?? $mahasiswa->tempat_tanggal_lahir,
            'tanggal_lulus'        => $validated['tanggal_lulus'] ?? $mahasiswa->tanggal_lulus,
            'gelar'                => $validated['gelar'] ?? $mahasiswa->gelar,
            'no_ijazah'            => $validated['no_ijazah'] ?? $mahasiswa->no_ijazah,
        ]);
        $mahasiswa->user->update(['email' => $validated['email']]);
        return redirect()->route('mahasiswa.profile')->with('success', 'Profile berhasil diupdate!');
    }
}
