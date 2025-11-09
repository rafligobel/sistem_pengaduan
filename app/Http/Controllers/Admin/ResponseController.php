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
            'content' => 'required|string', // UBAH INI
            'status' => 'required|in:pending,processed,finished,rejected', // Sesuaikan dengan Poin 5
        ]);

        // Buat tanggapan baru
        $complaint->responses()->create([
            'user_id' => Auth::id(),
            'content' => $request->content, // UBAH INI
        ]);

        // Update status pengaduan
        $complaint->update(['status' => $request->status]);

        // Kembali ke halaman detail dengan pesan sukses
        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Tanggapan berhasil dikirim!');
    }
}
