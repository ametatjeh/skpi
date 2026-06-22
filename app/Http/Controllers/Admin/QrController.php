<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index()
    {
        // Auto-sync for Final SKPI
        $finalSkpis = \App\Models\DraftSkpi::where('status', 'final_issued')->get();
        foreach ($finalSkpis as $skpi) {
            \App\Models\QrCode::firstOrCreate([
                'skpi_id' => $skpi->id,
                'mahasiswa_id' => $skpi->mahasiswa_id,
            ], [
                'qr_code_string' => route('skpi.verify', $skpi->nomor_skpi ?? 'invalid'),
                'is_active' => true,
                'created_at' => now(),
            ]);
        }

        $data = QrCode::with(['mahasiswa', 'draftSkpi'])->latest('created_at')->get();
        return view('admin.pengaturan.qr.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'is_active' => 'required|boolean',
            'expired_at' => 'nullable|date',
        ]);
        
        QrCode::findOrFail($id)->update($request->all());
        return back()->with('success', 'Status QR Code diperbarui');
    }
    
    public function destroy($id)
    {
        QrCode::findOrFail($id)->delete();
        return back()->with('success', 'QR Code berhasil dihapus');
    }
}
