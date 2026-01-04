<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Mahasiswa, Prestasi, VerifikasiSkpi};
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function list()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $prestasi = Prestasi::where('mahasiswa_id', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mahasiswa.prestasi.list', compact('prestasi'));
    }

    public function create()
    {
        return view('mahasiswa.prestasi.create');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $validated = $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|in:internasional,nasional,regional,provinsi,universitas,kampus',
            'penyelenggara' => 'required|string|max:255',
            'tanggal_perolehan' => 'required|date',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('prestasi', 'public');
        }
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
        $prestasi = Prestasi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => $status,
            ...$validated
        ]);

        // Cek duplikasi sebelum insert
        if ($status === 'submitted') {
            $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
                ->where('verifiable_type', Prestasi::class)
                ->where('verifiable_id', $prestasi->id)
                ->first();
            if (!$existing) {
                VerifikasiSkpi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'prodi_id' => $mahasiswa->prodi_id,
                    'verifiable_type' => Prestasi::class,
                    'verifiable_id' => $prestasi->id,
                    'level_verifikasi' => 'prodi',
                    'status' => 'pending',
                    'tanggal_pengajuan' => now(),
                ]);
            }
        }
        return redirect()->route('mahasiswa.prestasi.list')
            ->with(
                $status === 'submitted' ? 'success' : 'info',
                $status === 'submitted' ? '✅ Prestasi diajukan untuk verifikasi!' : 'Prestasi disimpan sebagai draft.'
            );
    }

    public function submit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $prestasi = Prestasi::where('id', $id)->where('mahasiswa_id', $mahasiswa->id)->where('status', 'draft')->firstOrFail();
        $prestasi->status = 'submitted';
        $prestasi->save();
        // Cek duplikasi sebelum insert
        $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->where('verifiable_type', Prestasi::class)
            ->where('verifiable_id', $prestasi->id)
            ->first();
        if (!$existing) {
            VerifikasiSkpi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'prodi_id' => $mahasiswa->prodi_id,
                'verifiable_type' => Prestasi::class,
                'verifiable_id' => $prestasi->id,
                'level_verifikasi' => 'prodi',
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
            ]);
        }
        return redirect()->route('mahasiswa.prestasi.list')->with('success', '✅ Prestasi diajukan untuk verifikasi!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $prestasi = Prestasi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();
        return view('mahasiswa.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $prestasi = Prestasi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->whereIn('status', ['draft', 'submitted']) // Bisa revisi!
            ->firstOrFail();

        $validated = $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|in:internasional,nasional,regional,provinsi,universitas,kampus',
            'penyelenggara' => 'required|string|max:255',
            'tanggal_perolehan' => 'required|date',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('file_path')) {
            if ($prestasi->file_path && Storage::disk('public')->exists($prestasi->file_path)) {
                Storage::disk('public')->delete($prestasi->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('prestasi', 'public');
        }
        $prestasi->update($validated);

        // Update status verifikasi SKPI jadi pending setelah revisi
        \App\Models\VerifikasiSkpi::where([
            ['verifiable_type', \App\Models\Prestasi::class],
            ['verifiable_id', $prestasi->id],
            ['mahasiswa_id', $mahasiswa->id]
        ])->update(['status' => 'pending']);

        return redirect()->route('mahasiswa.prestasi.list')
            ->with('success', '✅ Prestasi berhasil diupdate & dikirim ulang. Menunggu verifikasi prodi!');
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $prestasi = Prestasi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();
        if ($prestasi->file_path && Storage::disk('public')->exists($prestasi->file_path)) {
            Storage::disk('public')->delete($prestasi->file_path);
        }
        $prestasi->delete();
        return redirect()->route('mahasiswa.prestasi.list')->with('success', '✅ Prestasi berhasil dihapus!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $prestasi = Prestasi::with(['verifikasi' => function ($query) {
            $query->latest();
        }])->where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();
        return view('mahasiswa.prestasi.show', compact('prestasi'));
    }
}
