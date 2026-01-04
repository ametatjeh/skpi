<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpi;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class DraftSkpiController extends Controller
{
    /**
     * List SKPI yang sudah final_issued untuk mahasiswa aktif
     * Mahasiswa hanya bisa MELIHAT STATUS, tidak bisa download
     * Download hanya bisa dilakukan oleh Admin dan Biro Akademik
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        if (!$mahasiswa) {
            abort(404, 'Mahasiswa tidak ditemukan');
        }

        // Tampilkan semua SKPI milik mahasiswa (termasuk yang belum final untuk tracking)
        $skpis = DraftSkpi::with(['mahasiswa.prodi'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->orderByDesc('updated_at')
            ->get();

        return view('mahasiswa.download.index', compact('skpis', 'mahasiswa'));
    }

    // ================================================================
    // CATATAN: Download dan Preview DIHAPUS dari sisi Mahasiswa
    // Mahasiswa harus datang ke Biro Akademik (Pusat Bahasa) untuk
    // mencetak SKPI resmi setelah status menjadi 'final_issued'
    // ================================================================
}
