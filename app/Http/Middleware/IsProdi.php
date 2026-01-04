<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsProdi
{
    public function handle(Request $request, Closure $next)
    {
        // Cek user login dan rolenya
        if (auth()->check() && auth()->user()->role === 'prodi') {
            // Cek apakah user ini sudah punya prodi_id di session atau di user
            if (auth()->user()->prodi_id || session('prodi_id')) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Akses ditolak! Hanya untuk Program Studi.');
    }
}
