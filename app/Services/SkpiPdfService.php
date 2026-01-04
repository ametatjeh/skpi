<?php

namespace App\Services;

use App\Models\{
    DraftSkpi,
    VerifikasiSkpi,
    TemplateSkpi,
    SertifikasiKompetensi,
    PengabdianMasyarakat,
    Prestasi,
    Organisasi,
    Penghargaan
};
use Barryvdh\DomPDF\Facade\Pdf;

class SkpiPdfService
{
    /**
     * ✅ GET SKPI DATA (untuk preview HTML atau PDF)
     * 
     * @param int $draftSkpiId
     * @return array
     */
    public function getSkpiData($draftSkpiId)
    {
        $draftSkpi = DraftSkpi::with([
            'mahasiswa.prodi.fakultas',
            'mahasiswa.prodi.cpl'
        ])->findOrFail($draftSkpiId);

        // ===== AMBIL ID DARI VERIFIKASI_SKPI YANG INCLUDED/APPROVED =====
        $verifikasiIncluded = VerifikasiSkpi::where('mahasiswa_id', $draftSkpi->mahasiswa_id)
            ->whereIn('status', ['included_in_summary', 'approved'])
            ->get();

        // Ambil ID per kategori
        $idSertifikasi = $verifikasiIncluded
            ->where('verifiable_type', 'App\Models\SertifikasiKompetensi')
            ->pluck('verifiable_id')
            ->toArray();

        $idPrestasi = $verifikasiIncluded
            ->where('verifiable_type', 'App\Models\Prestasi')
            ->pluck('verifiable_id')
            ->toArray();

        $idOrganisasi = $verifikasiIncluded
            ->where('verifiable_type', 'App\Models\Organisasi')
            ->pluck('verifiable_id')
            ->toArray();

        $idPkm = $verifikasiIncluded
            ->where('verifiable_type', 'App\Models\PengabdianMasyarakat')
            ->pluck('verifiable_id')
            ->toArray();

        $idPenghargaan = $verifikasiIncluded
            ->where('verifiable_type', 'App\Models\Penghargaan')
            ->pluck('verifiable_id')
            ->toArray();

        // ===== AMBIL DATA LENGKAP DARI TABEL ASLI =====
        $sertifikasi = SertifikasiKompetensi::whereIn('id', $idSertifikasi)
            ->where('mahasiswa_id', $draftSkpi->mahasiswa_id)
            ->get();

        $prestasi = Prestasi::whereIn('id', $idPrestasi)
            ->where('mahasiswa_id', $draftSkpi->mahasiswa_id)
            ->get();

        $organisasi = Organisasi::whereIn('id', $idOrganisasi)
            ->where('mahasiswa_id', $draftSkpi->mahasiswa_id)
            ->get();

        $pkm = PengabdianMasyarakat::whereIn('id', $idPkm)
            ->where('mahasiswa_id', $draftSkpi->mahasiswa_id)
            ->get();

        $penghargaan = Penghargaan::whereIn('id', $idPenghargaan)
            ->where('mahasiswa_id', $draftSkpi->mahasiswa_id)
            ->get();

        // Template dan CPL
        $templateSkpi = TemplateSkpi::first();
        $cplData = $draftSkpi->mahasiswa->prodi->getAllCplForSkpi();

        // ✅ RETURN ARRAY DATA
        return compact(
            'sertifikasi',
            'prestasi',
            'organisasi',
            'pkm',
            'penghargaan',
            'templateSkpi',
            'cplData'
        );
    }

    /**
     * Generate PDF SKPI
     * 
     * @param int $draftSkpiId
     * @return \Barryvdh\DomPDF\PDF
     */
    public function generatePdf($draftSkpiId)
    {
        $draftSkpi = DraftSkpi::with([
            'mahasiswa.prodi.fakultas',
            'mahasiswa.prodi.cpl'
        ])->findOrFail($draftSkpiId);

        // ✅ PAKAI METHOD getSkpiData()
        $data = $this->getSkpiData($draftSkpiId);

        // Generate PDF
        $pdf = Pdf::loadView(
            'admin.draft.pdf',
            array_merge(['draftSkpi' => $draftSkpi], $data)
        )->setPaper('a4', 'portrait');

        return $pdf;
    }

    /**
     * Download PDF SKPI
     * 
     * @param int $draftSkpiId
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf($draftSkpiId)
    {
        $draftSkpi = DraftSkpi::findOrFail($draftSkpiId);
        $pdf = $this->generatePdf($draftSkpiId);

        $nomorSkpi = str_replace(['/', '\\'], '-', $draftSkpi->nomor_skpi);
        $namaMahasiswa = str_replace(['/', '\\'], '-', $draftSkpi->mahasiswa->nama);

        $filename = "SKPI_{$nomorSkpi}_{$namaMahasiswa}.pdf";

        return $pdf->download($filename);
    }

    /**
     * Stream PDF (buka di browser)
     * 
     * @param int $draftSkpiId
     * @return \Illuminate\Http\Response
     */
    public function streamPdf($draftSkpiId)
    {
        $pdf = $this->generatePdf($draftSkpiId);
        return $pdf->stream();
    }
}
