<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreResponseRequest; // 1. Import Request baru

class ResponseController extends Controller
{
    /**
     * Simpan tanggapan baru ke database.
     */
    // 2. Ganti 'Request $request' menjadi 'StoreResponseRequest $request'
    public function store(StoreResponseRequest $request, Complaint $complaint)
    {
        // 3. Tidak perlu $request->validate() lagi!

        // Data sudah 100% tervalidasi di sini
        $validatedData = $request->validated();

        // Buat tanggapan baru
        $complaint->responses()->create([
            'user_id' => Auth::id(),
            'content' => $validatedData['content'], // 4. Ambil dari data valid
        ]);

        // Update status pengaduan
        $complaint->update(['status' => $validatedData['status']]);

        // Kembali ke halaman detail dengan pesan sukses
        return redirect()->route('admin.complaints.show', $complaint)
            ->with('success', 'Tanggapan berhasil dikirim!');
    }
}
