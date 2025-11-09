<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Simpan tanggapan baru ke database.
     */
    public function store(Request $request, Complaint $complaint)
    {
        $request->validate([
            'body' => 'required|string',
            'status' => 'required|in:pending,processed,finished',
        ]);

        // Buat tanggapan baru
        $complaint->responses()->create([
            'user_id' => Auth::id(), // ID admin/petugas yang sedang login
            'body' => $request->body,
        ]);

        // Update status pengaduan
        $complaint->update(['status' => $request->status]);

        // Kembali ke halaman detail dengan pesan sukses
        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Tanggapan berhasil dikirim!');
    }
}
