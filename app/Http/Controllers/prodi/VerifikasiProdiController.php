<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    VerifikasiSkpi,
    ApprovalLog,
    Notifikasi,
    SertifikasiKompetensi,
    Prestasi,
    Organisasi,
    PengabdianMasyarakat,
    KaryaIlmiah,
    Penghargaan
};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerifikasiProdiController extends Controller
{
    /**
     * List pengajuan SKPI level Prodi
     */
    public function index(Request $request)
    {
        $prodiUser = auth('prodi')->user();
        $prodiId = $prodiUser->prodi_id;

        // Ambil id mahasiswa yang ada pengajuan di Prodi
        $idMahasiswaYangAdaPengajuan = VerifikasiSkpi::whereHas('mahasiswa', function ($q) use ($prodiId) {
            $q->where('prodi_id', $prodiId);
        })
            ->where('level_verifikasi', 'prodi')
            ->pluck('mahasiswa_id')
            ->unique()
            ->toArray();

        // Ambil list mahasiswa + achievement, plus filter/search
        $mahasiswaPengajuan = \App\Models\Mahasiswa::with([
            'verifikasiSkpi' => function ($q) use ($prodiId, $request) {
                $q->whereHas('mahasiswa', function ($qq) use ($prodiId) {
                    $qq->where('prodi_id', $prodiId);
                })
                    ->where('level_verifikasi', 'prodi')
                    ->with('verifiable')
                    ->orderBy('created_at', 'desc');

                $allowedStatus = ['pending', 'approved', 'rejected', 'revision_required'];
                if ($request->filled('status') && in_array($request->status, $allowedStatus)) {
                    $q->where('status', $request->status);
                }
                if ($request->filled('date_from')) {
                    $q->whereDate('created_at', '>=', $request->date_from);
                }
                if ($request->filled('date_to')) {
                    $q->whereDate('created_at', '<=', $request->date_to);
                }
            }
        ])
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($qq) use ($search) {
                    $qq->where('nim', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%");
                });
            })
            ->whereIn('id', $idMahasiswaYangAdaPengajuan)
            ->orderBy('nama')
            ->get();

        // Fitur BADGE: Hitung sisa kategori belum approved (misal total 4)
        $totalCategories = 4;
        foreach ($mahasiswaPengajuan as $m) {
            $approvedCount = $m->verifikasiSkpi
                ->where('status', 'approved')
                ->pluck('verifiable_type')
                ->unique()
                ->count();
            $m->badge_verifikasi_count = $totalCategories - $approvedCount;
        }

        // Statistik dasar
        $baseStats = VerifikasiSkpi::whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId))
            ->where('level_verifikasi', 'prodi');

        $stats = [
            'all' => (clone $baseStats)->count(),
            'pending' => (clone $baseStats)->where('status', 'pending')->count(),
            'approved' => (clone $baseStats)->where('status', 'approved')->count(),
            'rejected' => (clone $baseStats)->where('status', 'rejected')->count(),
            'revision_required' => (clone $baseStats)->where('status', 'revision_required')->count(),
        ];

        return view('prodi.verifikasi.index', compact(
            'mahasiswaPengajuan',
            'stats'
        ));
    }



    /**
     * Detail pengajuan SKPI + eligibility draft
     */
    public function detail($id)
    {
        $prodiUser = auth('prodi')->user();
        $prodiId = $prodiUser->prodi_id;

        $verifikasi = VerifikasiSkpi::with([
            'mahasiswa.prodi',
            'approvalLogs.approver',
            'dokumenPendukung',
            'verifiable',
        ])
            ->whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId))
            ->findOrFail($id);

        $mahasiswa = $verifikasi->mahasiswa;
        $achievement = $verifikasi->verifiable;
        $dokumen = $verifikasi->dokumenPendukung ?? collect();
        $approvalHistory = $verifikasi->approvalLogs ?? collect();

        $slaProdi = \App\Models\Setting::getSlaProdi() ?? 3;
        $daysPassed = Carbon::parse($verifikasi->created_at)->diffInDays(now());
        $slaRemaining = $slaProdi - $daysPassed;
        $slaStatus = $slaRemaining > 0 ? 'safe' : 'overdue';

        // Eligibility draft SKPI
        $requiredCategories = [
            'App\Models\SertifikasiKompetensi',
            'App\Models\Prestasi',
            'App\Models\Organisasi',
            'App\Models\PengabdianMasyarakat'
        ];
        $approvedCats = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->where('level_verifikasi', 'prodi')
            ->where('status', 'approved')
            ->pluck('verifiable_type')->toArray();
        $isDraftEligible = (count(array_diff($requiredCategories, $approvedCats)) === 0);

        return view('prodi.verifikasi.detail', compact(
            'verifikasi',
            'mahasiswa',
            'achievement',
            'dokumen',
            'approvalHistory',
            'slaProdi',
            'slaRemaining',
            'slaStatus',
            'isDraftEligible'
        ));
    }

    /**
     * Approve pengajuan SKPI (tetap level_verifikasi = prodi)
     */
    public function approve(Request $request, $id)
    {

        $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        $prodiUser = auth('prodi')->user();
        $prodiId   = $prodiUser->prodi_id;

        DB::beginTransaction();

        try {
            // Ambil verifikasi milik prodi yang login
            $verifikasi = VerifikasiSkpi::where('id', $id)
                ->whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId))
                ->firstOrFail();

            $oldStatus = $verifikasi->status;
            $newStatus = 'approved';

            // Update status di verifikasi_skpi
            $verifikasi->update([
                'status'             => $newStatus,
                'verifikator_role'   => 'prodi',
                'tanggal_verifikasi' => now(),
                'catatan'            => $request->catatan ?? $verifikasi->catatan,
            ]);

            // Catat ke approval_log (approver_id dikosongkan karena FK ke users)
            ApprovalLog::create([
                'verifikasi_skpi_id' => $verifikasi->id,
                'approver_id'        => null,
                'approver_role'      => 'prodi',
                'action'             => 'approve',
                'status_from'        => $oldStatus,
                'status_to'          => $newStatus,
                'catatan'            => $request->catatan ?? 'Pengajuan SKPI disetujui oleh Prodi',
            ]);

            // Kirim notifikasi ke mahasiswa
            Notifikasi::create([
                'user_id' => $verifikasi->mahasiswa->user_id ?? null,
                'judul'   => 'SKPI Disetujui Prodi',
                'pesan'   => 'Pengajuan SKPI Anda telah disetujui oleh Program Studi.',
                'tipe'    => 'success',
                'link'    => route('mahasiswa.dashboard'),
            ]);

            DB::commit();

            return redirect()
                ->route('prodi.verifikasi.detail', $id)
                ->with('success', 'Pengajuan SKPI berhasil disetujui!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Gagal menyetujui pengajuan: ' . $e->getMessage());
        }
    }




    /**
     * Reject pengajuan SKPI
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:1000',
        ], [
            'catatan.required' => 'Alasan penolakan wajib diisi!',
        ]);

        $prodiUser = auth('prodi')->user();
        $prodiId   = $prodiUser->prodi_id;

        DB::beginTransaction();

        try {
            $verifikasi = VerifikasiSkpi::where('id', $id)
                ->whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId))
                ->firstOrFail();

            $oldStatus = $verifikasi->status;
            $newStatus = 'rejected';

            $verifikasi->update([
                'status'             => $newStatus,
                'verifikator_role'   => 'prodi',
                'tanggal_verifikasi' => now(),
                'catatan'            => $request->catatan,
            ]);

            ApprovalLog::create([
                'verifikasi_skpi_id' => $verifikasi->id,
                'approver_id'        => null,
                'approver_role'      => 'prodi',
                'action'             => 'reject',
                'status_from'        => $oldStatus,
                'status_to'          => $newStatus,
                'catatan'            => $request->catatan,
            ]);

            Notifikasi::create([
                'user_id' => $verifikasi->mahasiswa->user_id ?? null,
                'judul'   => 'SKPI Ditolak Prodi',
                'pesan'   => 'Pengajuan SKPI Anda ditolak oleh Program Studi. Alasan: ' . $request->catatan,
                'tipe'    => 'error',
                'link'    => route('mahasiswa.dashboard'),
            ]);

            DB::commit();

            return redirect()
                ->route('prodi.verifikasi.index')
                ->with('success', 'Pengajuan SKPI berhasil ditolak.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menolak pengajuan: ' . $e->getMessage());
        }
    }





    /**
     * Minta revisi pengajuan SKPI
     */
    public function revisi(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:1000',
        ], [
            'catatan.required' => 'Catatan revisi wajib diisi!',
        ]);

        $prodiUser = auth('prodi')->user();
        $prodiId   = $prodiUser->prodi_id;

        DB::beginTransaction();

        try {
            $verifikasi = VerifikasiSkpi::where('id', $id)
                ->whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId))
                ->firstOrFail();

            $oldStatus = $verifikasi->status;
            $newStatus = 'revision_required';

            // update status verifikasi
            $verifikasi->update([
                'status'             => $newStatus,
                'verifikator_role'   => 'prodi',
                'tanggal_verifikasi' => now(),
                'catatan'            => $request->catatan,
            ]);

            // log revisi (approver_id null karena FK ke users)
            ApprovalLog::create([
                'verifikasi_skpi_id' => $verifikasi->id,
                'approver_id'        => null,
                'approver_role'      => 'prodi',
                'action'             => 'revision_request',
                'status_from'        => $oldStatus,
                'status_to'          => $newStatus,
                'catatan'            => $request->catatan,
            ]);

            // notifikasi ke mahasiswa
            Notifikasi::create([
                'user_id' => $verifikasi->mahasiswa->user_id ?? null,
                'judul'   => 'SKPI Perlu Revisi',
                'pesan'   => 'Pengajuan SKPI Anda memerlukan revisi dari Program Studi. Catatan: ' . $request->catatan,
                'tipe'    => 'warning',
                'link'    => route('mahasiswa.dashboard'),
            ]);

            DB::commit();

            return redirect()
                ->route('prodi.verifikasi.index')
                ->with('success', 'Permintaan revisi berhasil dikirim ke mahasiswa.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengirim revisi: ' . $e->getMessage());
        }
    }


    /**
     * Data kategori via AJAX (opsional)
     */
    public function getDataKategori($id, $kategori)
    {
        $verifikasi  = VerifikasiSkpi::findOrFail($id);
        $mahasiswaId = $verifikasi->mahasiswa_id;

        $data = match ($kategori) {
            'sertifikasi'  => SertifikasiKompetensi::where('mahasiswa_id', $mahasiswaId)->get(),
            'prestasi'     => Prestasi::where('mahasiswa_id', $mahasiswaId)->get(),
            'organisasi'   => Organisasi::where('mahasiswa_id', $mahasiswaId)->get(),
            'pkm'          => PengabdianMasyarakat::where('mahasiswa_id', $mahasiswaId)->get(),
            'karya_ilmiah' => KaryaIlmiah::where('mahasiswa_id', $mahasiswaId)->get(),
            'penghargaan'  => Penghargaan::where('mahasiswa_id', $mahasiswaId)->get(),
            default        => [],
        };

        return response()->json([
            'success' => true,
            'data'    => $data,
        ]);
    }
}
