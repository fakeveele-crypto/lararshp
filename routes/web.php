<?php

use Illuminate\Support\Facades\Route;

// Import Controller yang diperlukan
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Resepsionis;
use App\Http\Controllers\Dokter;
use App\Http\Controllers\Pemilik as PemilikRole;
use App\Http\Controllers\Perawat;
use Illuminate\Support\Facades\Auth;


// ==============================================================================
// 1. SITE ROUTES (Public Access)
// ==============================================================================

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');
Route::get('/layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/visimisi', [SiteController::class, 'visimisi'])->name('visimisi');

// ==============================================================================
// 2. AUTHENTICATION ROUTES (Wajib di atas)
// ==============================================================================

Auth::routes();

// ==============================================================================
// 3. ROLE-BASED ACCESS ROUTES (Wajib menggunakan Middleware)
// ==============================================================================


// A. ROUTE ADMINISTRATOR (ID Role = 1)
// Protected by isAdministrator middleware
Route::middleware(['isAdministrator'])->prefix('admin')->name('admin.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada karena dicari oleh LoginController)
    Route::get('/dashboard', [Admin\DashboardAdminController::class, 'index'])->name('dashboard');

    // Master Data Routes using Resource
    Route::resource('/jenis-hewan', Admin\JenisHewanController::class)->names('jenis-hewan');
    Route::resource('/pemilik', Admin\PemilikController::class)->names('pemilik');
    Route::resource('/kategori', Admin\KategoriController::class)->names('kategori');
    Route::resource('/kategori-klinis', Admin\KategoriKlinisController::class)->names('kategori-klinis');
    Route::resource('/kode-tindakan-terapi', Admin\KodeTindakanTerapiController::class)->names('kode-tindakan-terapi');
    Route::resource('/detail-rekam-medis', Admin\DetailRekamMedisController::class)->only(['create','store'])->names('detail-rekam-medis');
    Route::resource('/pet', Admin\PetController::class)->names('pet');
    Route::resource('/ras-hewan', Admin\RasHewanController::class)->names('ras-hewan');
    Route::resource('/dokter', Admin\DokterController::class)->names('datadokter');
    Route::resource('/perawat', Admin\PerawatController::class)->names('dataperawat');
    Route::resource('/rekam-medis', Admin\RekamMedisController::class)->names('rekam-medis');
    Route::resource('/role', Admin\RoleController::class)->names('role');
    Route::resource('/temu-dokter', Admin\TemuDokterController::class)->names('temu-dokter');
    Route::resource('/user', Admin\UserController::class)->names('user');
});


// B. ROUTE RESEPSIONIS (ID Role = 4)
// Protected by isResepsionis middleware
Route::middleware(['isResepsionis'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada)
    Route::get('/dashboard', [Resepsionis\DashboardResepsionisController::class, 'index'])->name('dashboard');

    // Pemilik, pet and temu dokter resources for resepsionis
    Route::resource('pemilik', App\Http\Controllers\resepsionis\PemilikController::class)->names('datapemilik');
    Route::resource('pet', App\Http\Controllers\resepsionis\PetController::class)->names('datapet');
    Route::resource('temudokter', App\Http\Controllers\resepsionis\TemuDokterController::class)->names('temu-dokter');
    // Rekam Medis access for resepsionis (lihat menu Dokter)
    Route::resource('/rekam-medis', App\Http\Controllers\resepsionis\RekamMedisController::class)->names('rekam-medis');
});


// C. ROUTE DOKTER (ID Role = 2)
// Protected by isDokter middleware
Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada)
    Route::get('/dashboard', [Dokter\DashboardDokterController::class, 'index'])->name('dashboard');
    
    Route::resource('/rekam-medis', Dokter\RekamMedisController::class)->names('rekam-medis');

    // Profile routes for Dokter
    Route::get('/profile/edit', [Dokter\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Dokter\ProfileController::class, 'update'])->name('profile.update');

    // Detail Rekam Medis routes for Dokter (add/edit/delete + complete)
    Route::get('/detail-rekam-medis/create/{idrekam}', [Dokter\DetailRekamMedisController::class, 'create'])->name('detail-rekam-medis.create');
    Route::post('/detail-rekam-medis', [Dokter\DetailRekamMedisController::class, 'store'])->name('detail-rekam-medis.store');
    Route::get('/detail-rekam-medis/{iddetail}/edit', [Dokter\DetailRekamMedisController::class, 'edit'])->name('detail-rekam-medis.edit');
    Route::put('/detail-rekam-medis/{iddetail}', [Dokter\DetailRekamMedisController::class, 'update'])->name('detail-rekam-medis.update');
    Route::delete('/detail-rekam-medis/{iddetail}', [Dokter\DetailRekamMedisController::class, 'destroy'])->name('detail-rekam-medis.destroy');
    Route::post('/rekam-medis/{idrekam}/complete', [Dokter\DetailRekamMedisController::class, 'complete'])->name('rekam-medis.complete');
});


// D. ROUTE PERAWAT (ID Role = 3)
// Protected by isPerawat middleware
Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada)
    Route::get('/dashboard', [Perawat\DashboardPerawatController::class, 'index'])->name('dashboard');
    
    Route::resource('/rekam-medis', Perawat\RekamMedisController::class)->names('rekam-medis');
    // Profile routes for Perawat
    Route::get('/profile/edit', [Perawat\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Perawat\ProfileController::class, 'update'])->name('profile.update');
});


// E. ROUTE PEMILIK (ID Role = Default)
// Protected by isPemilik middleware
Route::middleware(['isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada)
    Route::get('/dashboard', [PemilikRole\DashboardPemilikController::class, 'index'])->name('dashboard');

    Route::resource('/rekam-medis', PemilikRole\RekamMedisController::class)->names('rekam-medis');
});