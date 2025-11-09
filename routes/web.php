<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PublicComplaintController;
use App\Http\Controllers\PublicStatusController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\Admin\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| BIARKAN INI. INI ADALAH ROUTE YANG BENAR UNTUK LANDING PAGE ANDA
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::prefix('lapor')->name('complaint.public.')->group(function () {
    // Step 1: Biodata
    Route::get('/step-1', [PublicComplaintController::class, 'createStep1'])->name('step1.create');
    Route::post('/step-1', [PublicComplaintController::class, 'postStep1'])->name('step1.post');

    // Step 2: Data Pengaduan
    Route::get('/step-2', [PublicComplaintController::class, 'createStep2'])->name('step2.create');
    Route::post('/step-2', [PublicComplaintController::class, 'store'])->name('step2.store');

    // Step 3: Halaman Selesai (Menampilkan Token)
    Route::get('/selesai/{token}', [PublicComplaintController::class, 'finish'])->name('finish');
});



Route::middleware(['auth', 'role:admin|petugas|kepala_instansi'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::post('/complaints/{complaint}/respond', [ResponseController::class, 'store'])->name('complaints.respond');
    // Manajemen User & Role (hanya untuk admin)
    Route::resource('/users', UserController::class)->middleware('role:admin');
});



Route::get('/cek-status', [PublicStatusController::class, 'index'])->name('status.index');
Route::post('/cek-status', [PublicStatusController::class, 'check'])->name('status.check');
Route::get('/status/{token}', [PublicStatusController::class, 'show'])->name('status.show');
require __DIR__ . '/auth.php';
