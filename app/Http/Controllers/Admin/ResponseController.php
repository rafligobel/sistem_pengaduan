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
     * Simpan Tanggapan Baru (Hanya Admin / user berhak respond_complaints)
     */
    public function store(Request $request, Complaint $complaint)
    {
        $user = Auth::user();
        
        // Pimpinan dilarang menanggapi
        if ($user->hasRole('pimpinan') && !$user->hasRole('admin')) {
            abort(403, 'Pimpinan hanya memiliki hak akses untuk memantau laporan.');
        }

        if (!$user->can('respond_complaints') && !$user->hasRole('admin')) {
            abort(403, 'Hanya Admin yang berwenang menanggapi laporan pengaduan.');
        }

        $request->validate([
            'content' => 'required|string',
            'status'  => 'nullable|in:menunggu,diproses,terverifikasi,ditolak'
        ]);

        // 1. Buat Tanggapan
        Response::create([
            'complaint_id' => $complaint->id,
            'user_id'      => $user->id,
            'content'      => $request->content,
        ]);

        // 2. Update Status Pengaduan (Opsional saat menanggapi)
        if ($request->filled('status')) {
            $complaint->update([
                'status' => $request->status
            ]);
        }

        return back()->with('success', 'Tanggapan berhasil dikirim dan status diperbarui.');
    }
}
