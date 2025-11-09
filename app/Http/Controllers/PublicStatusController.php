<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class PublicStatusController extends Controller
{
    // Tampilkan form input token
    public function index()
    {
        return view('public.status.index');
    }

    // Validasi token dan redirect
    public function check(Request $request)
    {
        $request->validate(['token' => 'required|string']);
        // Cukup redirect ke URL yang bersih
        return redirect()->route('status.show', ['token' => $request->token]);
    }

    // Tampilkan halaman status dan jawaban
    public function show($token)
    {
        // Ambil pengaduan, relasi kategori, dan relasi tanggapan (termasuk user yg menanggapi)
        $complaint = Complaint::where('token', $token)
            ->with(['category', 'responses.user'])
            ->firstOrFail(); // Otomatis 404 jika token salah

        return view('public.status.show', compact('complaint'));
    }
}
