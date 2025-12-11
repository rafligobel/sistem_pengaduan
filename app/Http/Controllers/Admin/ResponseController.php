<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    /**
     * Simpan Tanggapan Baru
     */
    public function store(Request $request, Complaint $complaint)
    {
        $request->validate([
            'content' => 'required|string',
            'status' => 'required|in:pending,proses,selesai,ditolak' // Opsional: sekalian update status
        ]);

        // 1. Buat Tanggapan
        Response::create([
            'complaint_id' => $complaint->id,
            'user_id' => Auth::id(), // ID Petugas yang login
            'content' => $request->content,
        ]);

        // 2. Update Status Pengaduan (Otomatis saat menanggapi)
        $complaint->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim dan status diperbarui.');
    }
}
