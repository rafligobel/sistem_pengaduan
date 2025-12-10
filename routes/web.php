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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
Route::middleware(['auth', 'role:admin|petugas|kepala_instansi'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin (Untuk sementara diarahkan ke view dashboard, bisa diganti controller)
    Route::get('/dashboard', function () {
        return view('dashboard'); // Sesuaikan jika Anda punya view khusus admin
    })->name('dashboard');

    // Manajemen Pengaduan (CRUD Laporan Masuk)
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::post('/complaints/{complaint}/respond', [ResponseController::class, 'store'])->name('complaints.respond');

    // Manajemen Master Data (Hanya Admin)
    Route::middleware('role:admin')->group(function () {
        Route::resource('/users', UserController::class);
        Route::resource('/categories', CategoryController::class)->except(['show']);
    });
});

require __DIR__ . '/auth.php';
