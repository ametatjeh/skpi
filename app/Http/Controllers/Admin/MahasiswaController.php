<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of mahasiswa (tanpa pagination)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = Mahasiswa::select(
            'mahasiswa.*',
            'users.email'
        )
            ->with('prodi')
            ->join('users', 'users.id', '=', 'mahasiswa.user_id')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('mahasiswa.nama', 'like', "%{$search}%")
                        ->orWhere('mahasiswa.nim', 'like', "%{$search}%")
                        ->orWhere('users.email', 'like', "%{$search}%");
                });
            })
            ->orderBy('mahasiswa.created_at', 'desc')
            ->get();

        return view('admin.users.mahasiswa', compact('users'));
    }

    /**
     * Store a newly created mahasiswa in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            // Data Users
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',

            // Data Mahasiswa
            'nim' => 'required|string|max:50|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:16',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'tahun_masuk' => 'required|integer|min:1900|max:' . date('Y'),
            'angkatan' => 'required|integer|min:1900|max:' . date('Y'),
            'tanggal_masuk' => 'required|date',
            'status_mahasiswa' => 'required|string|max:50',
            'tanggal_lulus' => 'nullable|date',
            'gelar' => 'nullable|string|max:20',
            'no_ijazah' => 'nullable|string|max:100',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'prodi_id' => 'required|integer|exists:prodi,id', // ✅ Ubah dari prodis ke prodi
        ]);

        DB::transaction(function () use ($request) {
            // Create user account
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
            ]);

            // Create mahasiswa record
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'tahun_masuk' => $request->tahun_masuk,
                'angkatan' => $request->angkatan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'status_mahasiswa' => $request->status_mahasiswa,
                'tanggal_lulus' => $request->tanggal_lulus,
                'gelar' => $request->gelar,
                'no_ijazah' => $request->no_ijazah,
                'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
                'prodi_id' => $request->prodi_id,
            ]);
        });

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Update the specified mahasiswa in storage
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            // Data Users
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user_id,
            'password' => 'nullable|string|min:8|confirmed',

            // Data Mahasiswa
            'nim' => 'required|string|max:50|unique:mahasiswa,nim,' . $id,
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:16',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'tahun_masuk' => 'required|integer|min:1900|max:' . date('Y'),
            'angkatan' => 'required|integer|min:1900|max:' . date('Y'),
            'tanggal_masuk' => 'required|date',
            'status_mahasiswa' => 'required|string|max:50',
            'tanggal_lulus' => 'nullable|date',
            'gelar' => 'nullable|string|max:20',
            'no_ijazah' => 'nullable|string|max:100',
            'tempat_tanggal_lahir' => 'required|string|max:255',
            'prodi_id' => 'required|integer|exists:prodi,id', // ✅ Ubah dari prodis ke prodi
        ]);

        DB::transaction(function () use ($request, $mahasiswa) {
            // Update mahasiswa
            $mahasiswa->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'tahun_masuk' => $request->tahun_masuk,
                'angkatan' => $request->angkatan,
                'tanggal_masuk' => $request->tanggal_masuk,
                'status_mahasiswa' => $request->status_mahasiswa,
                'tanggal_lulus' => $request->tanggal_lulus,
                'gelar' => $request->gelar,
                'no_ijazah' => $request->no_ijazah,
                'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
                'prodi_id' => $request->prodi_id,
            ]);

            // Update user account
            $userData = [
                'name' => $request->nama,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $mahasiswa->user->update($userData);
        });

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate!');
    }

    /**
     * Remove the specified mahasiswa from storage
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->user->delete();
            $mahasiswa->delete();
        });

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
