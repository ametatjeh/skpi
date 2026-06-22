<?php

namespace App\Http\Controllers;

use App\Models\DraftSkpi;
use App\Models\QrCode;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(string $nomor_skpi)
    {
        // Decode url if needed
        $nomor_skpi = urldecode($nomor_skpi);
        
        // Find the SKPI
        $skpi = DraftSkpi::with(['mahasiswa.prodi'])->where('nomor_skpi', $nomor_skpi)
            ->where('status', 'final_issued')
            ->first();

        if (!$skpi) {
            return view('verify', [
                'status' => 'not_found',
                'message' => 'SKPI dengan nomor tersebut tidak ditemukan atau belum diterbitkan secara final.'
            ]);
        }

        // Check QR Code status
        $qrCode = QrCode::where('skpi_id', $skpi->id)->first();
        if ($qrCode) {
            if (!$qrCode->is_active) {
                return view('verify', [
                    'status' => 'inactive',
                    'message' => 'Akses QR Code untuk SKPI ini sedang dinonaktifkan.'
                ]);
            }
            if ($qrCode->expired_at && $qrCode->expired_at->isPast()) {
                return view('verify', [
                    'status' => 'expired',
                    'message' => 'Masa berlaku QR Code untuk SKPI ini telah berakhir.'
                ]);
            }
        }

        // Return view valid
        return view('verify', [
            'status' => 'valid',
            'skpi' => $skpi
        ]);
    }
}
