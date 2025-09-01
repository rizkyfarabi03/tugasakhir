<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DamkarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\AnggotaImportController;
use App\Http\Controllers\AnggotaController;
use App\Models\Damkar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ========================
// 📦 Export Data Damkar
// ========================
Route::get('/damkar/export/excel', [DamkarController::class, 'exportExcel'])
    ->name('damkar.export.excel');

Route::get('/damkar/export-pdf', [DamkarController::class, 'exportPdf'])
    ->name('damkar.export.pdf');


// ========================
// 👥 Export Data Anggota
// ========================
Route::get('/anggota/export/excel', [AnggotaController::class, 'exportExcel'])
    ->name('anggota.export.excel');

Route::get('/anggota/export/pdf', [AnggotaController::class, 'exportPdf'])
    ->name('anggota.export.pdf');

// ========================
// 📊 Statistik
// ========================
Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
Route::get('/statistik/filter', [StatistikController::class, 'filter'])->name('statistik.filter');

// ========================
// 🚒 Data Damkar (Pos & API)
// ========================
Route::resource('pos-damkar', DamkarController::class);
Route::get('/api/pos-damkar/by-kecamatan/{kecamatan}', [DamkarController::class, 'getByKecamatan']);
Route::get('/get-damkar-by-kecamatan/{kecamatan}', function ($kecamatan) {
    return \App\Models\Damkar::where('kecamatan', $kecamatan)->get(['id', 'nama_pos']);
});
Route::get('/damkar', [DamkarController::class, 'index'])->name('damkar.index');

// ========================
// 👥 Anggota
// ========================
Route::resource('anggota', AnggotaController::class);
Route::get('/public/anggota/{pos_damkar_id}', [PublicAnggotaController::class, 'index'])->name('public.anggota.index');

// Import anggota
Route::get('/import-anggota', [AnggotaImportController::class, 'form']);
Route::post('/import-anggota', [AnggotaImportController::class, 'import']);

// ========================
// 🏠 Halaman Publik
// ========================

// Halaman beranda (landing page → default)
Route::get('/', function () {
    return view('beranda'); 
})->name('beranda');

// Halaman utama (peta full dengan data damkar)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ========================
// 🔐 Dashboard & Admin
// ========================
Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

// Buat pos damkar manual
Route::get('/pos-damkar/create', function () {
    return view('pages.create-damkar');
})->name('pos-damkar.create');

// ========================
// 🔗 Link Eksternal
// ========================
Route::get('/instagram', function () {
    return redirect()->away('https://www.instagram.com/damkarpemko.bjm?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==');
});

// ========================
// 🚪 Auth
// ========================
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';