<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkpiDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pastikan user login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $nim = $user->nim ?? null;
        if (!$nim) {
            return redirect()->back()->with('error', 'Data NIM mahasiswa tidak ditemukan.');
        }

        // 🔹 Hitung isi data mahasiswa dari tiap kategori SKPI
        $kategori = [
            'sertifikasi' => DB::table('sertifikat')->where('nim', $nim)->count(),
            'prestasi' => DB::table('prestasi')->where('nim', $nim)->count(),
            'organisasi' => DB::table('organisasi')->where('nim', $nim)->count(),
            'karya_ilmiah' => DB::table('karya_ilmiah')->where('nim', $nim)->count(),
            'pengabdian' => DB::table('pengabdian')->where('nim', $nim)->count(),
            'penghargaan' => DB::table('penghargaan')->where('nim', $nim)->count(),
        ];

        // 🔹 Hitung berapa kategori yang sudah diisi (>= 1 data)
        $jumlahKategoriTerisi = collect($kategori)->filter(function ($jumlah) {
            return $jumlah > 0;
        })->count();

        $totalKategori = count($kategori);
        $persentaseLengkap = round(($jumlahKategoriTerisi / $totalKategori) * 100, 1);

        // 🔹 Status teks dinamis
        if ($persentaseLengkap == 100) {
            $statusText = 'Lengkap';
            $statusColor = 'green';
        } elseif ($persentaseLengkap >= 50) {
            $statusText = 'Sebagian Terisi';
            $statusColor = 'yellow';
        } else {
            $statusText = 'Belum Lengkap';
            $statusColor = 'red';
        }

        // 🔹 Kirim data ke view
        return view('skpi.dashboard', [
            'user' => $user,
            'jumlahKategoriTerisi' => $jumlahKategoriTerisi,
            'persentaseLengkap' => $persentaseLengkap,
            'statusText' => $statusText,
            'statusColor' => $statusColor,
        ]);
    }
}
