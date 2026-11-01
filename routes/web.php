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
// Halaman dashboard untuk masyarakat/pengguna yang sudah login
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. FITUR PENGADUAN (HANYA USER LOGIN SEBAGAI PENGGUNA)
// Middleware 'auth' memastikan hanya pengguna terautentikasi yang bisa akses
Route::middleware(['auth', 'role:pengguna|masyarakat'])->prefix('lapor')->name('complaint.public.')->group(function () {

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
// Masyarakat bisa cek status tiket tanpa login
Route::get('/cek-status', [PublicStatusController::class, 'index'])->name('status.index');
Route::post('/cek-status', [PublicStatusController::class, 'check'])->name('status.check'); // Form submit pencarian
Route::get('/status/{token}', [PublicStatusController::class, 'show'])->name('status.show'); // Menampilkan hasil

// Route untuk Lampiran Aman (Secure Attachment)
// Akses: Admin/Tim Khusus/Pimpinan (Session Auth) ATAU Pelapor / Publik (via Token Tiket di URL)
Route::get('/attachments/{complaint}', [\App\Http\Controllers\AttachmentController::class, 'show'])->name('attachments.show');

// 5. MANAJEMEN PROFIL (Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 6. AREA INTERNAL (ADMIN, TIM KHUSUS, PIMPINAN)
Route::middleware(['auth', 'role:admin|tim khusus|pimpinan|petugas|walikota'])->prefix('admin')->name('admin.')->group(function () {

    // A. Dashboard Internal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // B. Manajemen Pengaduan (Daftar & Detail)
    Route::delete('/complaints/destroy-all', [ComplaintController::class, 'destroyAll'])
        ->middleware('permission:delete_complaints')
        ->name('complaints.destroyAll');
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');

    // C. Action Pengaduan (Admin: Proses/Tolak, Tim Khusus: Verifikasi/Tolak)
    Route::middleware('permission:process_complaints|verify_complaints')->group(function () {
        Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
    });

    // D. Tanggapi Pengaduan (Admin)
    Route::middleware('permission:respond_complaints')->group(function () {
        Route::post('/complaints/{complaint}/respond', [ResponseController::class, 'store'])->name('complaints.respond');
    });

    // E. Hapus Pengaduan (Admin Only)
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])
        ->middleware('permission:delete_complaints')
        ->name('complaints.destroy');

    // F. Manajemen Master Data (User, Category) - Admin Only
    Route::middleware('permission:manage_master')->group(function () {
        Route::delete('/users/destroy-all', [UserController::class, 'destroyAll'])->name('users.destroyAll');
        Route::resource('/users', UserController::class);

        Route::delete('/categories/destroy-all', [CategoryController::class, 'destroyAll'])->name('categories.destroyAll');
        Route::resource('/categories', CategoryController::class)->except(['show']);
    });

    // G. Manajemen Dokumentasi (Gallery) & Berita - Admin Only
    Route::delete('/galleries/destroy-all', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyAll'])->name('galleries.destroyAll')
        ->middleware('permission:manage_documentation');
    Route::resource('/galleries', \App\Http\Controllers\Admin\GalleryController::class)
        ->middleware('permission:manage_documentation');

    Route::delete('/news/destroy-all', [\App\Http\Controllers\Admin\NewsController::class, 'destroyAll'])->name('news.destroyAll')
        ->middleware('permission:manage_documentation');
    Route::resource('/news', \App\Http\Controllers\Admin\NewsController::class)
        ->middleware('permission:manage_documentation');

    // H. Manajemen Sistem (Admin Only)
    Route::prefix('system')->name('system.')->middleware('permission:manage_system')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SystemController::class, 'index'])->name('index');
        Route::post('/optimize', [\App\Http\Controllers\Admin\SystemController::class, 'optimize'])->name('optimize');
        Route::post('/backup', [\App\Http\Controllers\Admin\SystemController::class, 'backup'])->name('backup');
    });
});

require __DIR__ . '/auth.php';
