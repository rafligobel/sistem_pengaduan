<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    /**
     * Menampilkan lampiran sensitif dengan pengecekan hak akses.
     */
    public function show(Complaint $complaint)
    {
        // 1. Cek apakah ada file lampiran
        if (!$complaint->attachment || !Storage::disk('local')->exists($complaint->attachment)) {
            abort(404, 'File lampiran tidak ditemukan.');
        }

        // 2. LOGIKA OTORISASI
        $isAuthorized = false;
        $user = Auth::user();

        // A. Jika user login
        if ($user) {
            // Admin, Petugas, Walikota boleh melihat semua
            if ($user->hasAnyRole(['admin', 'petugas', 'walikota'])) {
                $isAuthorized = true;
            }
            // Pemilik tiket boleh melihat
            else if ($user->id === $complaint->user_id) {
                $isAuthorized = true;
            }
        } 
        
        // B. Jika Publik (Login atau Tidak), cek Token Tiket via Session (untuk alur Cek Tiket)
        // Kita asumsikan jika seseorang bisa mengakses halaman detail tiket (yang sudah dilindungi controller), mereka berhak lihat gambar.
        // Tapi untuk amannya, kita cek referer atau session, ATAU kita biarkan controller ini diakses
        // oleh siapa saja yang tahu URL-nya NAMUN URL-nya menggunakan ID pengaduan yang tidak bisa ditebak?
        // TIDAK. URL menggunakan ID bisa ditebak (incremental).
        
        // Pendekatan lebih aman: Cek apakah user sedang membuka halaman detail tiket yang valid
        // Tapi HTTP itu stateless.
        
        // SOLUSI: Jika pengguna adalah 'guest' (masyarakat tidak login) yang melihat status tiket via TOKEN,
        // mereka biasanya sudah melewati proses input TOKEN di halaman 'Cek Status'.
        // Namun, rute gambar ini terpisah.
        
        // Kita bisa tambahkan parameter ?token=TIKET-XXX di URL gambar untuk verifikasi guest.
        if (request()->has('token') && request()->token === $complaint->token) {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            abort(403, 'Anda tidak memiliki hak akses untuk melihat lampiran ini.');
        }

        // 3. Return File
        $path = storage_path('app/' . $complaint->attachment);
        return response()->file($path);
        
        // Pilihan lain: response()->download($path) jika ingin download
    }
}
