<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\VerifikasiSkpi;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanSkpiExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $fakultasId    = auth()->user()->fakultas_id ?? null;
        $status        = $request->get('status');
        $prodiId       = $request->get('prodi_id');
        $kategoriReq   = $request->get('kategori');
        $tanggalDari   = $request->get('dari');
        $tanggalSampai = $request->get('sampai');

        // Query utama tabel verifikasi untuk statistik rekap/summary
        $query = \App\Models\VerifikasiSkpi::with(['mahasiswa.prodi'])
            ->where('level_verifikasi', 'fakultas');

        if ($fakultasId) {
            $query->whereHas('mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId));
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($kategoriReq) {
            $query->whereRaw('LOWER(verifiable_type) LIKE ?', ['%' . strtolower($kategoriReq) . '%']);
        }
        if ($prodiId) {
            $query->whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId));
        }
        if ($tanggalDari) {
            $query->whereDate('tanggal_pengajuan', '>=', $tanggalDari);
        }
        if ($tanggalSampai) {
            $query->whereDate('tanggal_pengajuan', '<=', $tanggalSampai);
        }

        $verifikasis = $query->orderByDesc('tanggal_pengajuan')->paginate(15);

        // Statistik rekap agregat (pie chart/stat summary)
        $rekap = \App\Models\VerifikasiSkpi::where('level_verifikasi', 'fakultas')
            ->when($fakultasId, fn($q) => $q->whereHas('mahasiswa.prodi', fn($p) => $p->where('fakultas_id', $fakultasId)));
        $totalPengajuan = (clone $rekap)->count();
        $totalApproved  = (clone $rekap)->where('status', 'approved')->count();
        $totalRejected  = (clone $rekap)->where('status', 'rejected')->count();
        $totalPending   = (clone $rekap)->where('status', 'pending')->count();

        // Untuk chart: passing dalam bentuk array statistik
        $stat = [
            'total_diajukan' => $totalPengajuan,
            'total_final'    => $totalApproved,
            'total_revisi'   => $totalRejected,
            'total_pending'  => $totalPending,
        ];

        // List kategori untuk dropdown
        $listKategori = \App\Models\VerifikasiSkpi::where('level_verifikasi', 'fakultas')
            ->when($fakultasId, fn($q) => $q->whereHas('mahasiswa.prodi', fn($p) => $p->where('fakultas_id', $fakultasId)))
            ->select('verifiable_type')->distinct()
            ->pluck('verifiable_type')
            ->map(fn($type) => class_basename($type))
            ->filter()->sort()->values()->toArray();

        // List prodi untuk dropdown filter
        $prodis = \App\Models\Prodi::when($fakultasId, fn($q) => $q->where('fakultas_id', $fakultasId))
            ->orderBy('nama_prodi')->get();

        // Data SKPI yang sudah final 1 tahun terakhir (riwayat untuk tabel bawah)
        $listFinal = \App\Models\DraftSkpi::with(['mahasiswa.prodi'])
            ->where('status', 'final_issued')
            ->when($fakultasId, function ($q) use ($fakultasId) {
                $q->whereHas('mahasiswa.prodi', fn($p) => $p->where('fakultas_id', $fakultasId));
            })
            ->where('updated_at', '>=', now()->subYear())
            ->orderByDesc('updated_at')
            ->take(30)
            ->get();

        return view('fakultas.laporan.index', compact(
            'verifikasis',
            'prodis',
            'totalPengajuan',
            'totalApproved',
            'totalRejected',
            'totalPending',
            'status',
            'prodiId',
            'kategoriReq',
            'tanggalDari',
            'tanggalSampai',
            'listKategori',
            'stat',
            'listFinal'
        ));
    }


    public function exportPdf(Request $request)
    {
        $fakultasId     = auth()->user()->fakultas_id ?? null;
        $status         = $request->get('status');
        $prodiId        = $request->get('prodi_id');
        $kategoriReq    = $request->get('kategori');
        $tanggalDari    = $request->get('dari');
        $tanggalSampai  = $request->get('sampai');

        $query = VerifikasiSkpi::with(['mahasiswa.prodi'])
            ->where('level_verifikasi', 'fakultas');

        if ($fakultasId) {
            $query->whereHas('mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId));
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($kategoriReq) {
            $query->whereRaw('LOWER(verifiable_type) LIKE ?', ['%' . strtolower($kategoriReq) . '%']);
        }
        if ($prodiId) {
            $query->whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId));
        }
        if ($tanggalDari) {
            $query->whereDate('tanggal_pengajuan', '>=', $tanggalDari);
        }
        if ($tanggalSampai) {
            $query->whereDate('tanggal_pengajuan', '<=', $tanggalSampai);
        }
        $datas = $query->orderByDesc('tanggal_pengajuan')->get();

        $pdf = Pdf::loadView('fakultas.laporan.export-pdf', compact('datas'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan-skpi-fakultas-' . now()->format('Y-m-d-His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $fakultasId     = auth()->user()->fakultas_id ?? null;
        $status         = $request->get('status');
        $prodiId        = $request->get('prodi_id');
        $kategoriReq    = $request->get('kategori');
        $tanggalDari    = $request->get('dari');
        $tanggalSampai  = $request->get('sampai');

        $query = VerifikasiSkpi::with(['mahasiswa.prodi'])
            ->where('level_verifikasi', 'fakultas');

        if ($fakultasId) {
            $query->whereHas('mahasiswa.prodi', fn($q) => $q->where('fakultas_id', $fakultasId));
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($kategoriReq) {
            $query->whereRaw('LOWER(verifiable_type) LIKE ?', ['%' . strtolower($kategoriReq) . '%']);
        }
        if ($prodiId) {
            $query->whereHas('mahasiswa', fn($q) => $q->where('prodi_id', $prodiId));
        }
        if ($tanggalDari) {
            $query->whereDate('tanggal_pengajuan', '>=', $tanggalDari);
        }
        if ($tanggalSampai) {
            $query->whereDate('tanggal_pengajuan', '<=', $tanggalSampai);
        }
        $datas = $query->orderByDesc('tanggal_pengajuan')->get();

        return Excel::download(
            new LaporanSkpiExport($datas),
            'laporan-skpi-fakultas-' . now()->format('Y-m-d-His') . '.xlsx'
        );
    }
}
