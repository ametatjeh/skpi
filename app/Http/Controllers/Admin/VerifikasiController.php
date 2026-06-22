<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerifikasiSkpi;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Menunggu Prodi - Status pending di level prodi
     */
    public function prodi(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $verifikasiList = VerifikasiSkpi::with(['mahasiswa.prodi', 'verifiable'])
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'pending')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('verifiable_type', 'like', "%{$kategori}%");
            })
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        return view('admin.verifikasi.prodi', compact('verifikasiList', 'search', 'kategori'));
    }

    /**
     * Menunggu Fakultas - Status pending di level fakultas
     */
    public function fakultas(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');

        $verifikasiList = VerifikasiSkpi::with(['mahasiswa.prodi', 'verifiable'])
            ->where('level_verifikasi', 'fakultas')
            ->where('status', 'pending')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('verifiable_type', 'like', "%{$kategori}%");
            })
            ->orderBy('tanggal_pengajuan', 'desc')
            ->get();

        return view('admin.verifikasi.fakultas', compact('verifikasiList', 'search', 'kategori'));
    }

    /**
     * Semua Verifikasi - All history
     */
    public function semua(Request $request)
    {
        $search = $request->input('search');
        $kategori = $request->input('kategori');
        $status = $request->input('status');
        $level = $request->input('level');

        $verifikasiList = VerifikasiSkpi::with(['mahasiswa.prodi', 'verifiable'])
            ->when($search, function ($q) use ($search) {
                $q->whereHas('mahasiswa', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('verifiable_type', 'like', "%{$kategori}%");
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->when($level, function ($q) use ($level) {
                $q->where('level_verifikasi', $level);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.verifikasi.semua', compact('verifikasiList', 'search', 'kategori', 'status', 'level'));
    }

    /**
     * Show detail verifikasi
     */
    public function show($id)
    {
        $verifikasi = VerifikasiSkpi::with(['mahasiswa.prodi', 'verifiable'])->findOrFail($id);
        return view('admin.verifikasi.show', compact('verifikasi'));
    }

    /**
     * Approve verifikasi
     */
    public function approve(Request $request, $id)
    {
        try {
            $verifikasi = VerifikasiSkpi::findOrFail($id);

            // ✅ Update status jadi approved
            $verifikasi->update([
                'status' => 'approved',
                'verifikator_id' => auth('admin')->id() ?? 1,
                'verifikator_role' => $this->getVerifikatorRole($verifikasi->level_verifikasi),
                'tanggal_verifikasi' => now(),
                'catatan' => $request->input('catatan'),
            ]);

            // ✅ Jika approved di level prodi, naik ke fakultas
            if ($verifikasi->level_verifikasi == 'prodi') {
                $verifikasi->update([
                    'level_verifikasi' => 'fakultas',
                    'status' => 'pending',
                    'tanggal_verifikasi' => null, // Reset tanggal verifikasi
                ]);

                return back()->with('success', 'Verifikasi di-approve! Data diteruskan ke Fakultas.');
            }

            // ✅ Jika approved di level fakultas, naik ke pusat_bahasa (dekan)
            if ($verifikasi->level_verifikasi == 'fakultas') {
                $verifikasi->update([
                    'level_verifikasi' => 'pusat_bahasa',
                    'status' => 'pending',
                    'tanggal_verifikasi' => null,
                ]);

                return back()->with('success', 'Verifikasi di-approve! Data diteruskan ke Dekan.');
            }

            // ✅ Jika approved di level dekan, final
            if ($verifikasi->level_verifikasi == 'pusat_bahasa' || $verifikasi->level_verifikasi == 'dekan') {
                return back()->with('success', 'Verifikasi final berhasil! Data sudah disetujui sepenuhnya.');
            }

            return back()->with('success', 'Verifikasi berhasil di-approve');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal approve verifikasi: ' . $e->getMessage()]);
        }
    }

    /**
     * Reject verifikasi
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|min:10',
        ], [
            'catatan.required' => 'Catatan penolakan wajib diisi',
            'catatan.min' => 'Catatan minimal 10 karakter',
        ]);

        try {
            $verifikasi = VerifikasiSkpi::findOrFail($id);

            $verifikasi->update([
                'status' => 'rejected',
                'verifikator_id' => auth('admin')->id() ?? 1,
                'verifikator_role' => $this->getVerifikatorRole($verifikasi->level_verifikasi),
                'tanggal_verifikasi' => now(),
                'catatan' => $request->input('catatan'),
            ]);

            return back()->with('success', 'Verifikasi ditolak dengan catatan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal reject verifikasi: ' . $e->getMessage()]);
        }
    }

    /**
     * Request revision
     */
    public function revision(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|min:10',
        ], [
            'catatan.required' => 'Catatan revisi wajib diisi',
            'catatan.min' => 'Catatan minimal 10 karakter',
        ]);

        try {
            $verifikasi = VerifikasiSkpi::findOrFail($id);

            $verifikasi->update([
                'status' => 'revision_required',
                'verifikator_id' => auth('admin')->id() ?? 1,
                'verifikator_role' => $this->getVerifikatorRole($verifikasi->level_verifikasi),
                'tanggal_verifikasi' => now(),
                'catatan' => $request->input('catatan'),
            ]);

            return back()->with('success', 'Permintaan revisi berhasil dikirim ke mahasiswa');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal kirim revisi: ' . $e->getMessage()]);
        }
    }

    /**
     * Helper: Get verifikator role based on level
     */
    private function getVerifikatorRole($level)
    {
        return match ($level) {
            'prodi' => 'kaprodi',
            'fakultas' => 'wadek1',
            'pusat_bahasa' => 'staff_bahasa',
            'dekan' => 'dekan',
            default => 'admin',
        };
    }
}
