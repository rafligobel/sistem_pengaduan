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
     */
    public function update(\App\Http\Requests\UpdateComplaintStatusRequest $request, Complaint $complaint)
    {
        $status = $request->validated()['status'];
        $user = Auth::user();

        // Role Specific Logic: Petugas
        if ($user->hasRole('petugas')) {
            if ($complaint->status !== 'pending') {
                return back()->with('error', 'Petugas hanya dapat memverifikasi laporan yang masih Pending.');
            }
            if (!in_array($status, ['proses', 'ditolak'])) {
                 return back()->with('error', 'Petugas hanya dapat mengubah status menjadi Proses atau Ditolak.');
            }
        }

        $complaint->update(['status' => $status]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    /**
     * Hapus pengaduan (Hanya Admin)
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete(); // File deletion handled by Model Observer

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
