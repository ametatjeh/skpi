<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class TotalMahasiswaController extends Controller
{
    /**
     * Display a listing of all mahasiswa
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 50);

        $query = Mahasiswa::with(['prodi.fakultas', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('email', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc');

        // ✅ Ambil semua data sesuai limit (tanpa pagination)
        if ($perPage == 'all') {
            $mahasiswa = $query->get();
        } else {
            $mahasiswa = $query->limit((int)$perPage)->get();
        }

        return view('admin.total-mahasiswa.index', compact('mahasiswa', 'search'));
    }


    /**
     * Display the specified mahasiswa
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::with(['prodi.fakultas', 'user'])->findOrFail($id);
        return view('admin.total-mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new mahasiswa
     */
    public function create()
    {
        return redirect()->route('admin.mahasiswa.create');
    }

    /**
     * Show the form for editing the specified mahasiswa
     */
    public function edit($id)
    {
        return redirect()->route('admin.mahasiswa.edit', $id);
    }

    /**
     * Remove the specified mahasiswa from storage
     */
    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->delete();

            return redirect()->route('admin.total-mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data mahasiswa: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the import form
     */
    public function showImportForm()
    {
        return redirect()->route('admin.total-mahasiswa.index', ['open_import' => true]);
    }

    /**
     * Import mahasiswa from Excel/CSV
     */
    public function import(Request $request)
    {
        // Validasi file dengan mimetypes yang lebih lengkap
        $file = $request->file('file');
        
        if (!$file) {
            return redirect()->route('admin.total-mahasiswa.index')
                ->withErrors(['import' => 'File wajib diupload']);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $allowedExtensions = ['xlsx', 'xls', 'csv'];
        
        if (!in_array($extension, $allowedExtensions)) {
            return redirect()->route('admin.total-mahasiswa.index')
                ->withErrors(['import' => 'File harus berformat Excel (.xlsx, .xls) atau CSV (.csv)']);
        }

        // Validasi ukuran (max 10MB)
        if ($file->getSize() > 10485760) {
            return redirect()->route('admin.total-mahasiswa.index')
                ->withErrors(['import' => 'Ukuran file maksimal 10MB']);
        }

        try {
            // Extend time limit for large files (5 menit)
            set_time_limit(300);
            ini_set('memory_limit', '512M');
            
            $import = new \App\Imports\MahasiswaImport();
            
            // Untuk file .xls yang mungkin sebenarnya HTML table (export dari SIAKAD, dll)
            if ($extension === 'xls') {
                // Coba baca sebagai Xls dulu, kalau gagal coba sebagai Html
                try {
                    \Maatwebsite\Excel\Facades\Excel::import($import, $file, null, \Maatwebsite\Excel\Excel::XLS);
                } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                    // Jika gagal baca sebagai XLS, coba sebagai HTML (file export SIAKAD biasanya HTML)
                    $import = new \App\Imports\MahasiswaImport();
                    \Maatwebsite\Excel\Facades\Excel::import($import, $file, null, \Maatwebsite\Excel\Excel::HTML);
                }
            } elseif ($extension === 'csv') {
                \Maatwebsite\Excel\Facades\Excel::import($import, $file, null, \Maatwebsite\Excel\Excel::CSV);
            } else {
                \Maatwebsite\Excel\Facades\Excel::import($import, $file, null, \Maatwebsite\Excel\Excel::XLSX);
            }

            $imported = $import->getImportedCount();
            $skipped = $import->getSkippedCount();
            $errors = $import->getErrors();

            $message = "Berhasil import {$imported} data mahasiswa.";
            if ($skipped > 0) {
                $message .= " ({$skipped} data dilewati)";
            }

            if (!empty($errors)) {
                return redirect()->route('admin.total-mahasiswa.index')
                    ->with('success', $message)
                    ->with('import_errors', $errors);
            }

            return redirect()->route('admin.total-mahasiswa.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            
            // Handle error spesifik HTML/DOM (file .xls palsu)
            if (strpos($errorMsg, 'DOM Document') !== false || strpos($errorMsg, 'DOMDocument') !== false) {
                return redirect()->route('admin.total-mahasiswa.index')
                    ->withErrors(['import' => 'Gagal import: Format file .xls tidak valid (terdeteksi sebagai HTML). Solusi: Buka file ini di Excel, lalu pilih "Save As", dan simpan dengan format ".xlsx" (Excel Workbook). Lalu upload ulang file .xlsx tersebut.']);
            }

            return redirect()->route('admin.total-mahasiswa.index')
                ->withErrors(['import' => 'Gagal import: ' . $errorMsg]);
        }
    }

    /**
     * Download template Excel
     */
    public function downloadTemplate()
    {
        $headers = [
            'nim',
            'nama',
            'email',
            'prodi',
            'nik',
            'jenis_kelamin',
            'agama',
            'alamat',
            'tahun_masuk',
            'angkatan',
            'tanggal_masuk',
            'status_mahasiswa',
            'tempat_tanggal_lahir',
            'tanggal_lulus',
            'gelar',
            'no_ijazah',
        ];

        $callback = function() use ($headers) {
            $file = fopen('php://output', 'w');
            // BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // Header row
            fputcsv($file, $headers);
            // Example row
            fputcsv($file, [
                '2241801025',
                'Budi Setiawan',
                'budi@umpar.ac.id',
                'Profesi Pendidikan Profesi Guru',
                '7371234567890123',
                'L',
                'Islam',
                'Jl. Contoh Alamat No. 123',
                '2022',
                '2022',
                '2022-09-01',
                'aktif',
                'Parepare, 15 Januari 1999',
                '',
                '',
                '',
            ]);
            fclose($file);
        };

        $filename = 'template_import_mahasiswa_' . date('Y-m-d') . '.csv';

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
