<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Http\Requests\UpdateComplaintStatusRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan
     */
    public function index(Request $request)
    {
        $statusFilter = $request->query('status');

        $query = Complaint::with(['user', 'category'])->latest();

        if ($statusFilter && in_array($statusFilter, ['menunggu', 'diproses', 'terverifikasi', 'ditolak'])) {
            $query->where('status', $statusFilter);
        }

        $complaints = $query->paginate(10)->withQueryString();

        // Hitung statistik untuk tab filter
        $counts = [
            'semua'         => Complaint::count(),
            'menunggu'      => Complaint::where('status', 'menunggu')->count(),
            'diproses'      => Complaint::where('status', 'diproses')->count(),
            'terverifikasi' => Complaint::where('status', 'terverifikasi')->count(),
            'ditolak'       => Complaint::where('status', 'ditolak')->count(),
        ];

        return view('admin.complaints.index', compact('complaints', 'counts', 'statusFilter'));
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
     * Update status pengaduan:
     * - Admin: Menelaah laporan 'menunggu' -> 'diproses' (diteruskan ke Verifikator) atau 'ditolak'
     * - Verifikator: Memverifikasi laporan 'diproses' -> 'terverifikasi' atau 'ditolak'
     * - Pimpinan: Hanya melihat (dilarang mengubah status)
     */
    public function update(UpdateComplaintStatusRequest $request, Complaint $complaint)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $targetStatus = $validated['status'];
        $note = $validated['note'] ?? null;

        // Pimpinan dilarang mengubah status
        if ($user->hasRole('pimpinan') && !$user->hasRole('admin')) {
            abort(403, 'Pimpinan hanya memiliki hak akses untuk memantau laporan.');
        }

        // Logic Hak Akses: Verifikator
        if ($user->hasRole('verifikator') && !$user->hasRole('admin')) {
            if ($complaint->status !== 'diproses') {
                return back()->with('error', 'Verifikator hanya dapat memverifikasi laporan yang telah diteruskan oleh Admin (berstatus Diproses).');
            }
            if (!in_array($targetStatus, ['terverifikasi', 'ditolak'])) {
                return back()->with('error', 'Verifikator hanya dapat mengubah status menjadi Terverifikasi atau Ditolak.');
            }
        }

        // Logic Hak Akses: Admin
        if ($user->hasRole('admin')) {
            // Admin bebas mengubah status atau meneruskan ke Verifikator
            if ($complaint->status === 'menunggu' && !in_array($targetStatus, ['diproses', 'ditolak'])) {
                return back()->with('error', 'Laporan yang baru masuk dapat diubah menjadi Diproses (diteruskan) atau Ditolak.');
            }
        }

        // Update status pengaduan
        $complaint->update(['status' => $targetStatus]);

        // Simpan catatan jika ada
        if (!empty($note)) {
            $complaint->responses()->create([
                'user_id' => $user->id,
                'content' => $note,
            ]);
        }

        // Tentukan pesan sukses berdasarkan peran dan tindakan
        $successMessage = 'Status pengaduan berhasil diperbarui.';
        if ($user->hasRole('verifikator') && !$user->hasRole('admin')) {
            if ($targetStatus === 'terverifikasi') {
                $successMessage = 'Laporan berhasil diverifikasi oleh Verifikator.';
            } elseif ($targetStatus === 'ditolak') {
                $successMessage = 'Laporan telah ditolak oleh Verifikator.';
            }
        } else {
            if ($targetStatus === 'diproses') {
                $successMessage = 'Laporan berhasil diproses dan diteruskan ke Verifikator.';
            } elseif ($targetStatus === 'ditolak') {
                $successMessage = 'Laporan telah ditolak.';
            } elseif ($targetStatus === 'terverifikasi') {
                $successMessage = 'Laporan telah diverifikasi.';
            }
        }

        return back()->with('success', $successMessage);
    }

    /**
     * Hapus SEMUA pengaduan (Hanya Admin)
     */
    public function destroyAll()
    {
        $user = Auth::user();
        if (!$user->hasRole('admin') && !$user->can('delete_complaints')) {
            abort(403, 'Hanya Admin yang dapat menghapus data pengaduan.');
        }

        $complaints = Complaint::all();
        foreach ($complaints as $complaint) {
            $complaint->delete();
        }

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Semua data pengaduan berhasil dihapus.');
    }

    /**
     * Hapus pengaduan (Hanya Admin)
     */
    public function destroy(Complaint $complaint)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin') && !$user->can('delete_complaints')) {
            abort(403, 'Hanya Admin yang dapat menghapus data pengaduan.');
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
