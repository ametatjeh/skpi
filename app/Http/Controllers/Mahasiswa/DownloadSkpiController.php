<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Skpi;
use PDF; // pastikan sudah install barryvdh/laravel-dompdf

class DownloadSkpiController extends Controller
{
    // Tampilkan daftar/matrix SKPI milik mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $skpis = Skpi::where('mahasiswa_id', $mahasiswa->id)->get();

        return view('mahasiswa.download.index', compact('skpis', 'mahasiswa'));
    }

    // Download PDF SKPI DRAFT atau FINAL dari storage maupun hasil DomPDF
    public function downloadPdf($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $skpi = Skpi::where('mahasiswa_id', $mahasiswa->id)->where('id', $id)->firstOrFail();

        // Jika status masih draft, boleh tetap download (tambahkan watermark di blade cetak)
        // Jika tidak ingin draft bisa di-download, batasi status dengan if berikut ini:
        // if (!in_array($skpi->status, ['selesai', 'final', 'draft'])) {
        //     abort(403, 'SKPI belum tersedia untuk diunduh.');
        // }

        $filePath = $skpi->pdf_file_path;
        if ($filePath && file_exists(storage_path('app/public/' . $filePath))) {
            // Download dari file yang sudah tersimpan (misal: SKPI Final sudah divalidasi operator)
            $downloadName = 'SKPI-' . str_replace(' ', '_', $mahasiswa->nama) . '.pdf';
            return response()->download(storage_path('app/public/' . $filePath), $downloadName);
        } else {
            // Jika belum ada file, generate dari blade (DRAFT)
            $data = [
                'mahasiswa' => $mahasiswa,
                'skpi' => $skpi
            ];
            $pdf = PDF::loadView('mahasiswa.download.cetak_skpi', $data); // tambahkan watermark draft di blade ini!
            return $pdf->download('SKPI-DRFT-' . str_replace(' ', '_', $mahasiswa->nama) . '.pdf');
        }
    }

    // Preview PDF SKPI (embed file)
    public function preview($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $skpi = Skpi::where('mahasiswa_id', $mahasiswa->id)->where('id', $id)->firstOrFail();

        $filePath = $skpi->pdf_file_path;
        $exists = $filePath && file_exists(storage_path('app/public/' . $filePath));

        return view('mahasiswa.download.preview', [
            'skpi' => $skpi,
            'mahasiswa' => $mahasiswa,
            'pdf_exists' => $exists,
        ]);
    }

    // (OPSIONAL) Generate PDF DRAFT (force dari blade, tidak ambil file siap publish)
    public function generateDraftPdf($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();
        $skpi = Skpi::where('mahasiswa_id', $mahasiswa->id)->where('id', $id)->firstOrFail();

        $data = [
            'mahasiswa' => $mahasiswa,
            'skpi' => $skpi
        ];
        // Pastikan blade "cetak_skpi" ada watermark/tanda "DRAFT"
        $pdf = PDF::loadView('mahasiswa.download.cetak_skpi', $data);

        return $pdf->download('SKPI-DRAFT-' . str_replace(' ', '_', $mahasiswa->nama) . '.pdf');
    }
}
