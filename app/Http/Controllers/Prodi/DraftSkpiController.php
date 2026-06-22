<?php

namespace App\Http\Controllers\Prodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{DraftSkpi, Mahasiswa, VerifikasiSkpi};
use Illuminate\Support\Facades\DB;

class DraftSkpiController extends Controller
{
    public function index()
    {
        $prodiId = auth()->user()->prodi_id;
        $drafts = DraftSkpi::where('prodi_id', $prodiId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $requiredCategories = [
            'App\Models\SertifikasiKompetensi',
            'App\Models\Prestasi',
            'App\Models\Organisasi',
            'App\Models\PengabdianMasyarakat'
        ];

        // Mahasiswa yang BELUM punya draft serta minimal punya 2 kategori achievement yang approved
        $mahasiswaEligible = Mahasiswa::with('verifikasiSkpi')
            ->where('prodi_id', $prodiId)
            ->whereDoesntHave('draftSkpi', function ($q) {
                $q->where('status', 'valid_prodi');
            })
            ->get()
            ->filter(function ($m) use ($requiredCategories) {
                // Ambil kategori achievement yang sudah approved (unique)
                $approvedCats = $m->verifikasiSkpi()
                    ->where('level_verifikasi', 'prodi')
                    ->where('status', 'approved')
                    ->pluck('verifiable_type')
                    ->unique()
                    ->toArray();
                // Cek: minimal 2 kategori required yang approved
                return count(array_intersect($requiredCategories, $approvedCats)) >= 2;
            })->map(function ($m) {
                // Ambil id verifikasi salah satu achievement (buat parameter route draft)
                $vk = $m->verifikasiSkpi()->approved()->first();
                $m->verifikasi_skpi_approved_id = $vk?->id;
                return $m;
            })->filter(function ($m) {
                // Pastikan ada achievement yang approved untuk route
                return !!$m->verifikasi_skpi_approved_id;
            });

        return view('prodi.draft-skpi.index', compact('drafts', 'mahasiswaEligible'));
    }



    // --- Create draft from verifikasi_id (ambil mahasiswa_id berdasarkan verifikasi)
    public function create($verifikasi_id)
    {
        $verifikasi = VerifikasiSkpi::with('mahasiswa')->findOrFail($verifikasi_id);
        $mahasiswa = $verifikasi->mahasiswa;
        // Tampilkan form dan data pengajuan di view
        return view('prodi.draft-skpi.create', compact('mahasiswa', 'verifikasi'));
    }

    public function store(Request $request)
    {
        // Ambil prodi_id dari tabel prodi_users/guard yang sedang login
        $user = auth('prodi')->user();

        $data = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'tahun_lulus' => 'nullable|integer',
            'nomor_skpi' => 'nullable|string',
            'catatan' => 'nullable|string'
        ]);
        $data['prodi_id'] = $user->prodi_id;
        $data['status'] = 'valid_prodi';

        // Prevent double draft for the same mahasiswa at level valid_prodi
        $existing = DraftSkpi::where('mahasiswa_id', $data['mahasiswa_id'])
            ->where('status', 'valid_prodi')
            ->first();
        if ($existing) {
            return back()->with('warning', 'Draft SKPI sudah pernah dibuat.');
        }

        $draft = DraftSkpi::create($data);

        // Update kategori SKPI status: kolom status harus cukup panjang (varchar/bisa string) sesuai isi
        // Kalau field status di verifikasi_skpi bertipe ENUM atau ada limit string, pastikan sudah tambahkan value 'included_in_summary'
        VerifikasiSkpi::where('mahasiswa_id', $data['mahasiswa_id'])
            ->where('status', 'approved')
            ->where('level_verifikasi', 'prodi')
            ->update(['status' => 'included_in_summary']);

        return redirect()->route('prodi.draft-skpi.preview', $draft->id)
            ->with('success', 'Draft SKPI berhasil dibuat. Silakan review sebelum submit ke fakultas.');
    }

    public function edit($id)
    {
        $skpi = DraftSkpi::with('mahasiswa.prodi')->findOrFail($id);
        return view('prodi.draft-skpi.edit', compact('skpi'));
    }


    public function update(Request $request, $id)
    {
        $draft = DraftSkpi::findOrFail($id);

        $data = $request->validate([
            'tahun_lulus' => 'nullable|integer',
            'catatan' => 'nullable|string',
            'ringkasan_id' => 'nullable|string|max:5000',  // Ringkasan Bahasa Indonesia
            'ringkasan_en' => 'nullable|string|max:5000',  // Ringkasan English
        ]);

        $draft->update($data);

        return redirect()
            ->route('prodi.draft-skpi.preview', $draft->id)
            ->with('success', 'Draft SKPI berhasil diperbarui.');
    }


    public function preview($id)
    {
        $skpi = DraftSkpi::with('mahasiswa.prodi')->findOrFail($id);
        // Data lain jika perlu
        return view('prodi.draft-skpi.preview', compact('skpi'));
    }


    public function generatePdf($id)
    {
        $draft = DraftSkpi::with('mahasiswa')->findOrFail($id);
        // Implementasi PDF menggunakan dompdf/snappy/dll
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('prodi.draft-skpi.pdf', compact('draft'));

        return $pdf->download('SKPI-' . $draft->mahasiswa_id . '.pdf');
        // Or save to file_path, then return download link
    }

    public function submit(Request $request, $id)
    {
        $draft = DraftSkpi::findOrFail($id);
        // Update status sesuai approval SKPI di prodi ke pusat bahasa (alur baru)
        $draft->status = 'valid_pusat_bahasa'; // next level: Pusat Bahasa
        $draft->save();

        // Log, notifikasi, dsb
        return redirect()->route('prodi.draft-skpi.preview', $draft->id)
            ->with('success', 'SKPI berhasil dikirim ke Pusat Bahasa!');
    }
    public function submitFakultas($id)
    {
        $draft = DraftSkpi::findOrFail($id);

        // Update achievement-linked verifikasi to Pusat Bahasa (alur baru)
        VerifikasiSkpi::where('mahasiswa_id', $draft->mahasiswa_id)
            ->where('status', 'included_in_summary')
            ->where('level_verifikasi', 'prodi')
            ->update([
                'level_verifikasi' => 'pusat_bahasa',  // Alur baru: ke Pusat Bahasa dulu
                'status' => 'pending'
            ]);

        $draft->update(['status' => 'valid_pusat_bahasa']);

        return redirect()->route('prodi.draft-skpi.preview', $draft->id)
            ->with('success', 'Draft berhasil diteruskan ke Pusat Bahasa!');
    }
}
