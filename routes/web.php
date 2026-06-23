<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProdiLoginController;
// use App\Http\Controllers\Fakultas\LaporanController;

use App\Http\Controllers\Auth\FakultasLoginController;

use App\Http\Controllers\Auth\PusatBahasaLoginController;


use App\Http\Controllers\Auth\EmailRegistrationController;
use App\Http\Controllers\Auth\ActivationController;
use Illuminate\Support\Facades\Auth;

// ===============================================
// SEO ROUTES
// ===============================================
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// ===============================================
// HALAMAN AWAL & VERIFIKASI SKPI
// ===============================================
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/skema', fn() => view('skema'))->name('skema');
Route::get('/capaian', fn() => view('capaian'))->name('capaian');

Route::get('/skpi/verify/{nomor_skpi}', [\App\Http\Controllers\VerificationController::class, 'verify'])
    ->where('nomor_skpi', '.*')
    ->name('skpi.verify');

// ===============================================
// HALAMAN PILIHAN LOGIN (HUB)
// ===============================================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
// ===============================================
// LOGIN & LOGOUT MAHASISWA
// ===============================================
Route::get('/mahasiswa/login', [LoginController::class, 'showLoginForm'])->name('mahasiswa.login');
Route::post('/mahasiswa/login', [LoginController::class, 'login']);
Route::post('/mahasiswa/logout', [LoginController::class, 'logout'])->name('mahasiswa.logout');

// ===============================================
// PASSWORD RESET ROUTES
// ===============================================
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// ===============================================
// LOGIN & LOGOUT PRODI (GUARD KHUSUS)
// ===============================================
Route::get('/prodi/login', [ProdiLoginController::class, 'showLoginForm'])->name('prodi.login');
Route::post('/prodi/login', [ProdiLoginController::class, 'login'])->name('prodi.login.submit');
Route::post('/prodi/logout', [ProdiLoginController::class, 'logout'])->name('prodi.logout');

// ===============================================
// LOGIN & LOGOUT FAKULTAS (GUARD KHUSUS)
// ===============================================
Route::get('/login/fakultas', [FakultasLoginController::class, 'showLoginForm'])->name('fakultas.login');
Route::post('/login/fakultas', [FakultasLoginController::class, 'login'])->name('fakultas.login.submit');
Route::post('/logout/fakultas', [FakultasLoginController::class, 'logout'])->name('fakultas.logout');

// ===============================================
// LOGIN & LOGOUT PUSAT BAHASA (GUARD KHUSUS)
// ===============================================
Route::get('/login/pusat-bahasa', [PusatBahasaLoginController::class, 'showLoginForm'])->name('pusat.login');
Route::post('/login/pusat-bahasa', [PusatBahasaLoginController::class, 'login'])->name('pusat.login.submit');
Route::post('/logout/pusat-bahasa', [PusatBahasaLoginController::class, 'logout'])->name('pusat.logout');

// ===============================================
// REGISTRASI EMAIL MULTI-ROLE (Publik)
// ===============================================
Route::get('/register-email', [EmailRegistrationController::class, 'showForm'])->name('email.registration.form');
Route::post('/register-email', [EmailRegistrationController::class, 'register'])->name('email.registration.submit');

// ===============================================
// AKTIVASI AKUN (Publik, via email link)
// ===============================================
Route::get('/activate/{token}', [ActivationController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate/{token}', [ActivationController::class, 'activate'])->name('activation.activate');

// ===============================================
// ROUTES SETELAH LOGIN (Protected dengan Auth WEB)
// ===============================================
// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', function () {
//         return match (auth()->user()->role) {
//             'mahasiswa'     => redirect()->route('mahasiswa.dashboard'),
//             'prodi'         => redirect()->route('prodi.dashboard'),
//             // 'fakultas'      => redirect()->route('fakultas.dashboard'),
//             'pusat_bahasa'  => redirect()->route('pusat.dashboard'),
//             'biro_akademik' => redirect()->route('biro.dashboard'),
//             'bpm'           => redirect()->route('bpm.dashboard'),
//             'rektor'        => redirect()->route('rektor.dashboard'),
//             default         => abort(403, 'Role tidak dikenali'),
//         };
//     })->name('home');

//     // Dashboard untuk role yang pakai guard web
//     // Route::middleware(['role:fakultas'])->get('/fakultas/dashboard', fn() => view('dashboard.fakultas'))->name('fakultas.dashboard');
//     Route::middleware(['role:pusat_bahasa'])->get('/pusat/dashboard', fn() => view('dashboard.pusat'))->name('pusat.dashboard');
//     Route::middleware(['role:biro_akademik'])->get('/biro/dashboard', fn() => view('dashboard.biro'))->name('biro.dashboard');
//     Route::middleware(['role:bpm'])->get('/bpm/dashboard', fn() => view('dashboard.bpm'))->name('bpm.dashboard');
//     Route::middleware(['role:rektor'])->get('/rektor/dashboard', fn() => view('dashboard.rektor'))->name('rektor.dashboard');
// });

// Route::get('fakultas/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('fakultas.laporan.export.pdf');
// Route::get('fakultas/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('fakultas.laporan.export.excel');


// ===============================================
// ROUTES TAMBAHAN (file khusus Prodi & Mahasiswa)
// ===============================================
require __DIR__ . '/prodi.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/fakultas.php';
require __DIR__ . '/pusat.php';
require __DIR__ . '/mahasiswa.php';
