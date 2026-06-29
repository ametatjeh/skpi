<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPusatBahasaRole
{
    /**
     * Handle an incoming request.
     * Memastikan user sudah login via guard 'pusat_bahasa' dan memiliki role 'pusat_bahasa'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek user login via guard pusat_bahasa dan rolenya sesuai
        if (auth('pusat_bahasa')->check() && auth('pusat_bahasa')->user()->role === 'pusat_bahasa') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Akses ditolak! Hanya untuk Pusat Bahasa.');
    }
}
