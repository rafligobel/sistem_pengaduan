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
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,ditolak',
        ]);

        $complaint->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    /**
     * Hapus pengaduan (Hanya Admin)
     */
    public function destroy(Complaint $complaint)
    {
        // Hapus file gambar jika ada
        if ($complaint->image && file_exists(storage_path('app/public/' . $complaint->image))) {
            unlink(storage_path('app/public/' . $complaint->image));
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
