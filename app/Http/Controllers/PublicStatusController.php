<?php

namespace App\Http\Controllers;

use Illuminate\Http;
use App\Models\Complaint;
use Illuminate\Http\Request;

class PublicStatusController extends Controller
{
    /**
     * Tampilkan form untuk cek status.
     */
    public function index()
    {
        return view('public.status.index');
    }

    /**
     * Validasi token dan redirect ke halaman status.
     */
    public function check(Request $request)
    {
        // 1. Validasi input token
        $request->validate([
            'token' => 'required|string|exists:complaints,token',
        ], [
            'token.required' => 'Token harus diisi.',
            'token.exists' => 'Token pengaduan tidak ditemukan.'
        ]);

        $token = $request->input('token');

        // (Sudah Benar) Redirect ke halaman show dengan token
        return redirect()->route('status.show', ['token' => $token]);
    }

    /**
     * Tampilkan detail status pengaduan.
     * Kita menggunakan Route Model Binding di sini (otomatis).
     */
    public function show($token)
    {
        // Cari complaint berdasarkan token
        $complaint = Complaint::where('token', $token)->firstOrFail();

        // 2. Lakukan Eager Loading di Controller
        $complaint->load([
            'category',
            'responses' => function ($query) {
                // Urutkan tanggapan dari yang terbaru (opsional tapi bagus)
                $query->latest();
            },
            'responses.user' // Eager load user (petugas) dari tanggapan
        ]);

        return view('public.status.show', compact('complaint'));
    }
}
