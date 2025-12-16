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
    
    // Registrasi Pemilik (Untuk Membuat User dan Pemilik Baru)
    Route::get('/registrasi/pemilik', [Resepsionis\RegistrasiPemilikController::class, 'index'])->name('registrasi-pemilik.index');
    Route::post('/registrasi/pemilik', [Resepsionis\RegistrasiPemilikController::class, 'store'])->name('registrasi-pemilik.store');
    
    // Registrasi Pet
    Route::get('/registrasi/pet', [Resepsionis\RegistrasiPetController::class, 'index'])->name('registrasi-pet.index');
    Route::post('/registrasi/pet', [Resepsionis\RegistrasiPetController::class, 'store'])->name('registrasi-pet.store');
    
    // Janji Temu (Temu Dokter) using Resource
    Route::resource('/janji-temu', Resepsionis\TemuDokterController::class)->names('temu-dokter');
});


// C. ROUTE DOKTER (ID Role = 2)
// Protected by isDokter middleware
Route::middleware(['isDokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada)
    Route::get('/dashboard', [Dokter\DashboardDokterController::class, 'index'])->name('dashboard');
    
    Route::resource('/rekam-medis', Dokter\RekamMedisController::class)->names('rekam-medis');
});


// D. ROUTE PERAWAT (ID Role = 3)
// Protected by isPerawat middleware
Route::middleware(['isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada)
    Route::get('/dashboard', [Perawat\DashboardPerawatController::class, 'index'])->name('dashboard');
    
    Route::get('/rekam-medis', [Perawat\RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/{idrekam_medis}', [Perawat\RekamMedisController::class, 'show'])->name('rekam-medis.show');
});


// E. ROUTE PEMILIK (ID Role = Default)
// Protected by isPemilik middleware
Route::middleware(['isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    // DASHBOARD ROUTE (Wajib ada)
    Route::get('/dashboard', [PemilikRole\DashboardPemilikController::class, 'index'])->name('dashboard');

    Route::resource('/rekam-medis', PemilikRole\RekamMedisController::class)->names('rekam-medis');
});