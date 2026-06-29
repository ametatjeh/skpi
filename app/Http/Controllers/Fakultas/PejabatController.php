<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dekan;
use App\Models\WakilDekan;
use Illuminate\Support\Facades\Auth;

class PejabatController extends Controller
{
    public function index()
    {
        $fakultasUser = Auth::guard('fakultas')->user();
        $fakultasId = $fakultasUser->fakultas_id;

        $dekans = Dekan::where('fakultas_id', $fakultasId)->get();
        $wakilDekans = WakilDekan::where('fakultas_id', $fakultasId)->get();

        return view('fakultas.pejabat.index', compact('dekans', 'wakilDekans'));
    }
}
