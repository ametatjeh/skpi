<?php

namespace App\Http\Controllers\PusatBahasa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\DraftSkpi;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with(['prodi.fakultas', 'draftSkpi'])
            ->whereHas('draftSkpi', function ($q) {
                $q->whereIn('status', ['valid_pusat_bahasa', 'valid_fakultas', 'final_issued', 'di_pusat_bahasa']);
            });

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('nim', 'like', "%$term%")
                    ->orWhere('nama', 'like', "%$term%");
            });
        }

        $mahasiswas = $query->orderByDesc('updated_at')->paginate(15);

        return view('pusat.mahasiswa.index', compact('mahasiswas'));
    }
}
