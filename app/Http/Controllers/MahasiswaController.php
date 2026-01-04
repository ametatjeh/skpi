<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\VerifikasiSkpi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MahasiswaController extends Controller
{
    /**
     * Mengajukan permintaan verifikasi SKPI oleh Mahasiswa.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ajukan(Request $request)
    {
        // =========================================================================
        // !!! LOKASI KRITIS DEBUGGING 1 (Paling Awal) !!!
        // Jika baris ini tidak muncul, masalahnya ada pada ROUTE atau FORM.
        // dd('Controller Ajukan Tereksekusi!'); 
        // =========================================================================

        $user = Auth::user();

        // 1. Cari data mahasiswa berdasarkan user login (Auth::user()->id)
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            // Jika data mahasiswa tidak ditemukan, tampilkan error dan kembali.
            return redirect()->back()->with('error', 'Data Mahasiswa tidak ditemukan. Pastikan data profil sudah lengkap dan terhubung dengan akun Anda.');
        }

        // 2. Cek apakah sudah pernah mengajukan SKPI dan masih dalam proses verifikasi.
        $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', [
                'diajukan',
                'disetujui_prodi',
                'disetujui_fakultas',
                'final'
            ])
            ->first();

        if ($existing) {
            // Jika sudah ada pengajuan yang sedang diproses/final, kembalikan dengan warning.
            return redirect()->back()->with('warning', 'Anda sudah pernah mengajukan SKPI dan sedang dalam proses verifikasi atau sudah final.');
        }

        // 3. Simpan pengajuan baru dengan menggunakan blok Try-Catch
        try {
            VerifikasiSkpi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'status' => 'diajukan', // Nilai ENUM yang valid
                'tanggal_pengajuan' => now(),
            ]);

            // 4. Redirect Sukses
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan SKPI berhasil dikirim untuk verifikasi Prodi.');
        } catch (\Exception $e) {
            // =========================================================================
            // !!! LOKASI KRITIS DEBUGGING 2 (Error Database Spesifik) !!!
            // Jika ini yang muncul, maka data mahasiswa sudah ditemukan, tetapi terjadi error saat menyimpan ke DB.
            dd('Gagal menyimpan data ke Verifikasi SKPI. Pesan Error:', $e->getMessage());
            // =========================================================================

            Log::error("Gagal menyimpan Verifikasi SKPI untuk Mahasiswa ID {$mahasiswa->id}: " . $e->getMessage());

            // Tampilkan pesan error umum ke pengguna.
            return redirect()->back()->with('error', 'Gagal mengajukan SKPI. Terjadi kesalahan sistem. Silakan cek log Laravel Anda.');
        }
    }
}
