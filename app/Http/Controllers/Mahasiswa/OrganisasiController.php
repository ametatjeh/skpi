<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Mahasiswa, Organisasi, VerifikasiSkpi};
use Illuminate\Support\Facades\Storage;

class OrganisasiController extends Controller
{
    public function list()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        // Eager load relasi ke verifikasiSkpi (agar data status realistis di blade)
        $organisasi = Organisasi::with('verifikasiSkpi')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.organisasi.list', compact('organisasi'));
    }


    public function create()
    {
        return view('mahasiswa.organisasi.create');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $validated = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'posisi' => 'required|string|max:100',
            'tahun_masuk' => 'required|integer|min:1900|max:' . date('Y'),
            'tahun_keluar' => 'nullable|integer|min:1900|max:' . date('Y'),
            'deskripsi_peran' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('organisasi', 'public');
        }
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
        $organisasi = Organisasi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => $status,
            ...$validated
        ]);

        // Cek duplikasi sebelum insert
        if ($status === 'submitted') {
            $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
                ->where('verifiable_type', Organisasi::class)
                ->where('verifiable_id', $organisasi->id)
                ->first();
            if (!$existing) {
                VerifikasiSkpi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'prodi_id' => $mahasiswa->prodi_id,
                    'verifiable_type' => Organisasi::class,
                    'verifiable_id' => $organisasi->id,
                    'level_verifikasi' => 'prodi',
                    'status' => 'pending',
                    'tanggal_pengajuan' => now(),
                ]);
            }
        }
        return redirect()->route('mahasiswa.organisasi.list')
            ->with(
                $status === 'submitted' ? 'success' : 'info',
                $status === 'submitted' ? '✅ Organisasi diajukan untuk verifikasi!' : 'Organisasi disimpan sebagai draft.'
            );
    }

    public function submit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $organisasi = Organisasi::where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'draft')
            ->firstOrFail();

        $organisasi->status = 'submitted';
        $organisasi->save();

        // Cek duplikasi sebelum insert
        $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->where('verifiable_type', Organisasi::class)
            ->where('verifiable_id', $organisasi->id)
            ->first();
        if (!$existing) {
            VerifikasiSkpi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'prodi_id' => $mahasiswa->prodi_id,
                'verifiable_type' => Organisasi::class,
                'verifiable_id' => $organisasi->id,
                'level_verifikasi' => 'prodi',
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
            ]);
        }
        return redirect()->route('mahasiswa.organisasi.list')->with('success', '✅ Organisasi diajukan untuk verifikasi!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        // Data bisa diedit jika milik mahasiswa & status 'draft' atau 'submitted'
        $organisasi = Organisasi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->whereIn('status', ['draft', 'submitted']) // Bisa tambah 'verified' jika memang diperbolehkan revisi
            ->firstOrFail();

        // Opsional: Jika ingin benar-benar validasi status revisi, cek juga status verifikasi_skpi
        // $verifikasi = VerifikasiSkpi::where([
        //     ['verifiable_type', Organisasi::class],
        //     ['verifiable_id', $organisasi->id],
        //     ['mahasiswa_id', $mahasiswa->id],
        //     ['level_verifikasi', 'prodi'],
        // ])->first();
        // if (!$verifikasi || $verifikasi->status !== 'revision_required') {
        //     abort(403, "Data tidak sedang diminta revisi.");
        // }

        return view('mahasiswa.organisasi.edit', compact('organisasi'));
    }


    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        // Status harus bisa diedit jika draft atau submitted (revisi)
        $organisasi = Organisasi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->whereIn('status', ['draft', 'submitted'])   // <-- fix: tambahkan submitted!
            ->firstOrFail();

        $validated = $request->validate([
            'nama_organisasi' => 'required|string|max:255',
            'posisi' => 'required|string|max:100',
            'tahun_masuk' => 'required|integer|min:1900|max:' . date('Y'),
            'tahun_keluar' => 'nullable|integer|min:1900|max:' . date('Y'),
            'deskripsi_peran' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('file_path')) {
            if ($organisasi->file_path && Storage::disk('public')->exists($organisasi->file_path)) {
                Storage::disk('public')->delete($organisasi->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('organisasi', 'public');
        }
        $organisasi->update($validated);

        // Update status verifikasi SKPI jadi pending setelah revisi
        \App\Models\VerifikasiSkpi::where([
            ['verifiable_type', \App\Models\Organisasi::class],
            ['verifiable_id', $organisasi->id],
            ['mahasiswa_id', $mahasiswa->id]
        ])->update(['status' => 'pending']);

        return redirect()->route('mahasiswa.organisasi.list')->with('success', '✅ Organisasi berhasil diupdate & dikirim ulang. Menunggu verifikasi prodi.');
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $organisasi = Organisasi::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();
        if ($organisasi->file_path && Storage::disk('public')->exists($organisasi->file_path)) {
            Storage::disk('public')->delete($organisasi->file_path);
        }
        $organisasi->delete();
        return redirect()->route('mahasiswa.organisasi.list')->with('success', '✅ Organisasi berhasil dihapus!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $organisasi = Organisasi::with(['verifikasi' => function ($query) {
            $query->latest();
        }])->where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();
        return view('mahasiswa.organisasi.show', compact('organisasi'));
    }
}
