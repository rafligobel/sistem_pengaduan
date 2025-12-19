<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan
     */
    public function index()
    {
        // Ambil data pengaduan, urutkan dari terbaru
        // Eager load 'user' dan 'category' agar query ringan
        $complaints = Complaint::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * Menampilkan detail pengaduan spesifik
     */
    public function show(Complaint $complaint)
    {
        // Load relasi tanggapan dan user yang menanggapi
        $complaint->load(['responses.user', 'user', 'category']);

        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Update status pengaduan (Misal: dari Pending -> Proses -> Selesai)
     * Method ini dipanggil saat Admin menekan tombol ganti status
     */
    public function update(Request $request, Complaint $complaint)
    {
        $user = Auth::user();
        $status = $request->status;

        // Validasi umum
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,ditolak',
        ]);

        // 1. Role Petugas (Verify)
        if ($user->hasRole('petugas')) {
            // Petugas hanya boleh ubah dari 'pending' ke 'proses' (valid) atau 'ditolak' (invalid)
            // Petugas TIDAK boleh mengubah status jika sudah 'proses' atau 'selesai'
            if ($complaint->status !== 'pending') {
                return back()->with('error', 'Petugas hanya dapat memverifikasi laporan yang masih Pending.');
            }

            if (!in_array($status, ['proses', 'ditolak'])) {
                 return back()->with('error', 'Petugas hanya dapat mengubah status menjadi Proses atau Ditolak.');
            }
        }

        // 2. Role Admin (Resolve)
        if ($user->hasRole('admin')) {
             // Admin bebas, tapi idealnya melanjutkan dari Proses -> Selesai
             // Tidak ada batasan ketat untuk Admin level tertinggi, 
             // tapi biar rapi kita bisa imbau lewat flash message jika loncat (opsional).
        }
        
        // 3. Preventif jika ada role lain coba-coba
        if (!$user->can('verify_complaints') && !$user->can('resolve_complaints')) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengubah status laporan ini.');
        }

        $complaint->update([
            'status' => $status,
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    /**
     * Hapus pengaduan (Hanya Admin)
     */
    public function destroy(Complaint $complaint)
    {
        // Hapus file gambar jika ada
        if ($complaint->attachment && file_exists(storage_path('app/public/' . $complaint->attachment))) {
            unlink(storage_path('app/public/' . $complaint->attachment));
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
