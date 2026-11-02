<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintPdfController extends Controller
{
    /**
     * Unduh berkas PDF untuk pengaduan yang sudah terverifikasi.
     * Dapat diakses oleh semua role: Admin, Verifikator, Pimpinan, dan Masyarakat.
     */
    public function download(Request $request, Complaint $complaint)
    {
        // 1. Validasi status: hanya pengaduan yang berstatus 'terverifikasi' (atau 'selesai') yang bisa diunduh
        if (!in_array($complaint->status, ['terverifikasi', 'selesai'])) {
            abort(403, 'Dokumen PDF resmi hanya dapat diunduh untuk pengaduan yang telah berstatus Terverifikasi.');
        }

        // 2. Otorisasi Akses:
        // - Semua role yang terautentikasi (admin, verifikator, pimpinan, masyarakat) diizinkan
        // - Guest / publik dengan token tiket valid juga diizinkan
        $isAuthorized = false;
        $user = Auth::user();

        if ($user) {
            if ($user->hasAnyRole(['admin', 'verifikator', 'pimpinan', 'masyarakat'])) {
                $isAuthorized = true;
            }
        }

        if ($request->query('token') === $complaint->token) {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengunduh dokumen pengaduan ini.');
        }

        // 3. Eager load relasi data lengkap
        $complaint->load(['user', 'category', 'responses.user.roles']);

        // 4. Siapkan logo dalam format Base64 untuk kompatibilitas DomPDF
        $logoBase64 = null;
        $logoPath = public_path('images/logo-kota.png');
        if (file_exists($logoPath)) {
            $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
        }

        // 5. Proses lampiran jika ada (Pisahkan antara gambar dan dokumen)
        $imageAttachments = [];
        $otherAttachments = [];

        if (!empty($complaint->attachment)) {
            $paths = explode('|', $complaint->attachment);
            $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            foreach ($paths as $path) {
                $path = trim($path);
                if (empty($path)) continue;

                if (Storage::disk('local')->exists($path)) {
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    $filename = basename($path);

                    if (in_array($ext, $imageExtensions)) {
                        $fileData = Storage::disk('local')->get($path);
                        $mimeType = match($ext) {
                            'png'  => 'image/png',
                            'webp' => 'image/webp',
                            'gif'  => 'image/gif',
                            default => 'image/jpeg',
                        };
                        $imageAttachments[] = [
                            'name' => $filename,
                            'src'  => 'data:' . $mimeType . ';base64,' . base64_encode($fileData),
                        ];
                    } else {
                        $otherAttachments[] = [
                            'name' => $filename,
                            'ext'  => strtoupper($ext),
                        ];
                    }
                }
            }
        }

        // 6. Generate PDF dengan konfigurasi DomPDF
        $pdf = Pdf::loadView('complaints.pdf', [
            'complaint'        => $complaint,
            'logoBase64'       => $logoBase64,
            'printedAt'        => now(),
            'imageAttachments' => $imageAttachments,
            'otherAttachments' => $otherAttachments,
        ])->setPaper('a4', 'portrait');

        $filename = 'SI-ADUAN-Pengaduan-Terverifikasi-' . $complaint->token . '.pdf';

        if ($request->has('stream')) {
            return $pdf->stream($filename);
        }

        return $pdf->download($filename);
    }

    /**
     * Unduh berkas PDF menggunakan nomor tiket (akses praktis pelacak status).
     */
    public function downloadByToken(Request $request, string $token)
    {
        $complaint = Complaint::where('token', $token)->firstOrFail();
        $request->merge(['token' => $token]);
        return $this->download($request, $complaint);
    }
}

