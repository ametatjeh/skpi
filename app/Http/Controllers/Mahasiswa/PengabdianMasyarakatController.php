<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Mahasiswa, PengabdianMasyarakat, VerifikasiSkpi};
use Illuminate\Support\Facades\Storage;

class PengabdianMasyarakatController extends Controller
{
    public function list()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $pengabdian_masyarakat = PengabdianMasyarakat::where('mahasiswa_id', $mahasiswa->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mahasiswa.pengabdian-masyarakat.list', compact('pengabdian_masyarakat'));
    }

    public function create()
    {
        return view('mahasiswa.pengabdian-masyarakat.create');
    }

    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $validated = $request->validate([
            'judul_pkm' => 'required|string|max:255',
            'pendanaan' => 'nullable|string|max:100',
            'tahun_pelaksanaan' => 'required|integer|min:1900|max:' . date('Y'),
            'anggota_tim' => 'nullable|integer|min:1',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,png',
        ]);
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('pengabdian_masyarakat', 'public');
        }
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
        $pkm = PengabdianMasyarakat::create([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => $status,
            ...$validated
        ]);

        // Cek duplikasi sebelum insert
        if ($status === 'submitted') {
            $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
                ->where('verifiable_type', PengabdianMasyarakat::class)
                ->where('verifiable_id', $pkm->id)
                ->first();
            if (!$existing) {
                VerifikasiSkpi::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'prodi_id' => $mahasiswa->prodi_id,
                    'verifiable_type' => PengabdianMasyarakat::class,
                    'verifiable_id' => $pkm->id,
                    'level_verifikasi' => 'prodi',
                    'status' => 'pending',
                    'tanggal_pengajuan' => now(),
                ]);
            }
        }
        return redirect()->route('mahasiswa.pkm.list')
            ->with(
                $status === 'submitted' ? 'success' : 'info',
                $status === 'submitted' ? '✅ PKM diajukan untuk verifikasi!' : 'PKM disimpan sebagai draft.'
            );
    }

    public function submit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $pkm = PengabdianMasyarakat::where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'draft')
            ->firstOrFail();

        $pkm->status = 'submitted';
        $pkm->save();

        // Cek duplikasi sebelum insert
        $existing = VerifikasiSkpi::where('mahasiswa_id', $mahasiswa->id)
            ->where('verifiable_type', PengabdianMasyarakat::class)
            ->where('verifiable_id', $pkm->id)
            ->first();
        if (!$existing) {
            VerifikasiSkpi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'prodi_id' => $mahasiswa->prodi_id,
                'verifiable_type' => PengabdianMasyarakat::class,
                'verifiable_id' => $pkm->id,
                'level_verifikasi' => 'prodi',
                'status' => 'pending',
                'tanggal_pengajuan' => now(),
            ]);
        }
        return redirect()->route('mahasiswa.pkm.list')->with('success', '✅ PKM diajukan untuk verifikasi!');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $pengabdian_masyarakat = PengabdianMasyarakat::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();
        return view('mahasiswa.pengabdian-masyarakat.edit', compact('pengabdian_masyarakat'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $pengabdian_masyarakat = PengabdianMasyarakat::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->whereIn('status', ['draft', 'submitted'])
            ->firstOrFail();

        $validated = $request->validate([
            'judul_pkm' => 'required|string|max:255',
            'pendanaan' => 'nullable|string|max:100',
            'tahun_pelaksanaan' => 'required|integer|min:1900|max:' . date('Y'),
            'anggota_tim' => 'nullable|integer|min:1',
            'deskripsi' => 'nullable|string',
            'file_path' => 'nullable|file|max:5120|mimes:pdf,doc,docx,jpg,png',
        ]);
        if ($request->hasFile('file_path')) {
            if ($pengabdian_masyarakat->file_path && Storage::disk('public')->exists($pengabdian_masyarakat->file_path)) {
                Storage::disk('public')->delete($pengabdian_masyarakat->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('pengabdian_masyarakat', 'public');
        }
        $pengabdian_masyarakat->update($validated);

        // Update status verifikasi SKPI jadi pending setelah revisi
        \App\Models\VerifikasiSkpi::where([
            ['verifiable_type', \App\Models\PengabdianMasyarakat::class],
            ['verifiable_id', $pengabdian_masyarakat->id],
            ['mahasiswa_id', $mahasiswa->id]
        ])->update(['status' => 'pending']);

        return redirect()->route('mahasiswa.pkm.list')
            ->with('success', '✅ PKM berhasil diupdate & dikirim ulang. Menunggu verifikasi prodi!');
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $pengabdian_masyarakat = PengabdianMasyarakat::where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->where('status', 'draft')
            ->firstOrFail();
        if ($pengabdian_masyarakat->file_path && Storage::disk('public')->exists($pengabdian_masyarakat->file_path)) {
            Storage::disk('public')->delete($pengabdian_masyarakat->file_path);
        }
        $pengabdian_masyarakat->delete();
        return redirect()->route('mahasiswa.pkm.list')->with('success', '✅ PKM berhasil dihapus!');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();
        $pengabdian_masyarakat = PengabdianMasyarakat::with(['verifikasi' => function ($query) {
            $query->latest();
        }])->where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();
        return view('mahasiswa.pengabdian-masyarakat.show', compact('pengabdian_masyarakat'));
    }
}
