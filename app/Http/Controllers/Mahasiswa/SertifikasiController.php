<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Mahasiswa, SertifikasiKompetensi, VerifikasiSkpi};
use Illuminate\Support\Facades\Storage;

class SertifikasiController extends Controller
{
    public function list()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $sertifikasi = SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mahasiswa.sertifikasi.list', compact('sertifikasi'));
    }

    public function create()
    {
        return view('mahasiswa.sertifikasi.create');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $validated = $request->validate([
            'nama_sertifikasi' => 'required|string|max:255',
            'nomor_sertifikat' => 'required|string|max:100|unique:sertifikasi_kompetensi',
            'penerbit' => 'required|string|max:255',
            'tanggal_terbit' => 'required|date',
            'tanggal_kadaluarsa' => 'nullable|date|after:tanggal_terbit',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        // Upload file if exists
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('sertifikasi', 'public');
        }
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
        $sertifikasi = SertifikasiKompetensi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => $status,
            ...$validated
        ]);
        // FIX: Cek duplikasi sebelum insert
        if ($status === 'submitted') {
            $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
                ->where('verifiable_type', SertifikasiKompetensi::class)
                ->where('verifiable_id', $sertifikasi->id)
                ->first();
            if (!$existing) {
                VerifikasiSkpi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'prodi_id' => $mahasiswa->prodi_id,
                    'verifiable_type' => SertifikasiKompetensi::class,
                    'verifiable_id' => $sertifikasi->id,
                    'level_verifikasi' => 'prodi',
                    'status' => 'pending',
                    'tanggal_pengajuan' => now(),
                ]);
            }
            return redirect()->route('mahasiswa.sertifikasi.list')
                ->with('success', '✅ Sertifikasi berhasil diajukan untuk verifikasi! Menunggu review Kaprodi.');
        } else {
            return redirect()->route('mahasiswa.sertifikasi.list')
                ->with('info', '💾 Sertifikasi disimpan sebagai draft. Submit nanti untuk verifikasi.');
        }
    }

    public function submit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $sertifikasi = SertifikasiKompetensi::where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'draft')
            ->firstOrFail();
        // Update status ke submitted
        $sertifikasi->status = 'submitted';
        $sertifikasi->save();
        // FIX: Cek duplikasi sebelum insert
        $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->where('verifiable_type', SertifikasiKompetensi::class)
            ->where('verifiable_id', $sertifikasi->id)
            ->first();
        if (!$existing) {
            VerifikasiSkpi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'prodi_id' => $mahasiswa->prodi_id,
                'verifiable_type' => SertifikasiKompetensi::class,
                'verifiable_id' => $sertifikasi->id,
                'level_verifikasi' => 'prodi',
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
            ]);
        }
        return redirect()->route('mahasiswa.sertifikasi.list')
            ->with('success', '✅ Sertifikasi berhasil diajukan ke verifikasi!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $sertifikasi = SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();
        return view('mahasiswa.sertifikasi.edit', compact('sertifikasi'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $sertifikasi = SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->whereIn('status', ['draft', 'submitted'])
            ->firstOrFail();

        $validated = $request->validate([
            'nama_sertifikasi' => 'required|string|max:255',
            'nomor_sertifikat' => 'required|string|max:100|unique:sertifikasi_kompetensi,nomor_sertifikat,' . $id,
            'penerbit' => 'required|string|max:255',
            'tanggal_terbit' => 'required|date',
            'tanggal_kadaluarsa' => 'nullable|date|after:tanggal_terbit',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('file_path')) {
            if ($sertifikasi->file_path && Storage::disk('public')->exists($sertifikasi->file_path)) {
                Storage::disk('public')->delete($sertifikasi->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('sertifikasi', 'public');
        }
        $sertifikasi->update($validated);

        // Update status verifikasi SKPI jadi pending setelah revisi
        \App\Models\VerifikasiSkpi::where([
            ['verifiable_type', \App\Models\SertifikasiKompetensi::class],
            ['verifiable_id', $sertifikasi->id],
            ['mahasiswa_id', $mahasiswa->id]
        ])->update(['status' => 'pending']);

        return redirect()->route('mahasiswa.sertifikasi.list')
            ->with('success', '✅ Sertifikasi berhasil diupdate & dikirim ulang. Menunggu verifikasi prodi!');
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $sertifikasi = SertifikasiKompetensi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();
        if ($sertifikasi->file_path && Storage::disk('public')->exists($sertifikasi->file_path)) {
            Storage::disk('public')->delete($sertifikasi->file_path);
        }
        $sertifikasi->delete();
        return redirect()->route('mahasiswa.sertifikasi.list')
            ->with('success', '✅ Sertifikasi berhasil dihapus!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $sertifikasi = SertifikasiKompetensi::with(['verifikasi' => function ($query) {
            $query->latest();
        }])->where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();
        return view('mahasiswa.sertifikasi.show', compact('sertifikasi'));
    }
}
