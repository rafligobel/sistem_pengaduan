<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PublicComplaintController;
use App\Http\Controllers\PublicStatusController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini mengatur seluruh alur URL aplikasi Anda.
|
*/

// 1. LANDING PAGE (Publik)
// Route ini mengarah ke halaman depan (Home)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// 2. DASHBOARD USER
// Halaman dashboard untuk masyarakat yang sudah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// 3. FITUR PENGADUAN (HANYA USER LOGIN)
// Middleware 'auth' memastikan hanya pengguna terautentikasi yang bisa akses
Route::middleware('auth')->prefix('lapor')->name('complaint.public.')->group(function () {

    // Step 1: Input Data Laporan
    Route::get('/step-1', [PublicComplaintController::class, 'createStep1'])->name('step1.create');
    Route::post('/step-1', [PublicComplaintController::class, 'storeStep1'])->name('step1.store');

    // Step 2: Review & Konfirmasi
    Route::get('/step-2', [PublicComplaintController::class, 'createStep2'])->name('step2.create');
    Route::post('/step-2', [PublicComplaintController::class, 'store'])->name('step2.store');

    // Step 3: Selesai (Menampilkan Tiket)
    Route::get('/selesai/{token}', [PublicComplaintController::class, 'finish'])->name('finish');
});

// 4. FITUR CEK STATUS (Publik)
// Masyarakat bisa cek status tiket tanpa login (opsional, bisa diubah ke auth jika mau)
Route::get('/cek-status', [PublicStatusController::class, 'index'])->name('status.index');
Route::post('/cek-status', [PublicStatusController::class, 'check'])->name('status.check'); // Form submit pencarian
Route::get('/status/{token}', [PublicStatusController::class, 'show'])->name('status.show'); // Menampilkan hasil

// 5. MANAJEMEN PROFIL (Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 6. HALAMAN ADMIN & PETUGAS
// Menggunakan middleware 'role' dari Spatie Permission untuk membatasi akses
// 6. AREA ADMIN & PETUGAS (Protected)
Route::middleware(['auth', 'role:admin|petugas|walikota'])->prefix('admin')->name('admin.')->group(function () {

    // A. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // B. Manajemen Pengaduan
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

    // C. Action Pengaduan (Verify & Resolve)
    // Gunakan middleware yang mengizinkan verify ATAU resolve
    // Karena route update/respond disini dipakai bergantian
    Route::middleware('permission:verify_complaints|resolve_complaints')->group(function () {
        Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
        Route::post('/complaints/{complaint}/respond', [ResponseController::class, 'store'])->name('complaints.respond');
    });

    // D. Hapus Pengaduan
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])
        ->middleware('permission:delete_complaints')
        ->name('complaints.destroy');

    // E. Manajemen Master Data (User, Category)
    Route::middleware('permission:manage_master')->group(function () {
        Route::resource('/users', UserController::class);
        Route::resource('/categories', CategoryController::class)->except(['show']);
    });

    // F. Manajemen Dokumentasi (Gallery)
    Route::resource('/galleries', \App\Http\Controllers\Admin\GalleryController::class)
        ->middleware('permission:manage_documentation');

    // G. Manajemen Sistem (Simulasi saja - Testing/Backup/Restore)
    Route::prefix('system')->name('system.')->middleware('permission:manage_system')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SystemController::class, 'index'])->name('index');
        Route::post('/optimize', [\App\Http\Controllers\Admin\SystemController::class, 'optimize'])->name('optimize');
        Route::post('/backup', [\App\Http\Controllers\Admin\SystemController::class, 'backup'])->name('backup');
    });
});

require __DIR__ . '/auth.php';
