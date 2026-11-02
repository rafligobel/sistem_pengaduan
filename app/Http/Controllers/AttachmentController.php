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
            // Admin, Verifikator, Pimpinan boleh melihat semua lampiran
            if ($user->hasAnyRole(['admin', 'verifikator', 'pimpinan'])) {
                $isAuthorized = true;
            }
            // Pemilik tiket boleh melihat
            else if ($user->id === $complaint->user_id) {
                $isAuthorized = true;
            }
        } 
        
        // B. Jika Publik (Login atau Tidak), cek Token Tiket via URL parameter (untuk alur Cek Tiket)
        if (request()->has('token') && request()->token === $complaint->token) {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            abort(403, 'Anda tidak memiliki hak akses untuk melihat lampiran ini.');
        }

        // 3. Return File
        $path = Storage::disk('local')->path($complaint->attachment);
        return response()->file($path);
    }
}
