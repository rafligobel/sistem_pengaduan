<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicStatusController extends Controller
{
    /**
     * Tampilkan Halaman Cek Status Pengaduan
     */
    public function index()
    {
        // Jika pengguna sedang login, tampilkan riwayat pengaduan miliknya
        $complaints = Auth::check()
            ? Auth::user()->complaints()->with('category')->latest()->paginate(5)
            : collect();

        return view('public.status.index', compact('complaints'));
    }

    /**
     * Proses Pencarian Tiket Pengaduan
     */
    public function check(Request $request)
    {
        // Menerima input 'token' (dari form) atau 'ticket_id'
        $request->validate([
            'token'     => 'required_without:ticket_id|nullable|string',
            'ticket_id' => 'required_without:token|nullable|string',
        ], [
            'token.required_without'     => 'Silakan masukkan ID Tiket pengaduan Anda.',
            'ticket_id.required_without' => 'Silakan masukkan ID Tiket pengaduan Anda.',
        ]);

        $rawToken = $request->input('token') ?? $request->input('ticket_id');
        $ticket = strtoupper(trim($rawToken));

        // Cari berdasarkan token
        $complaint = Complaint::where('token', $ticket)->first();

        if ($complaint) {
            // Jika ketemu, arahkan ke halaman detail status
            return redirect()->route('status.show', $complaint->token);
        } else {
            // Jika tidak ketemu, kembali dengan pesan error
            return redirect()->route('status.index')
                ->withInput()
                ->with('error', 'Tiket dengan ID ' . e($ticket) . ' tidak ditemukan. Silakan periksa kembali nomor tiket Anda.');
        }
    }

    /**
     * Tampilkan Detail Status Tiket Pengaduan
     */
    public function show($token)
    {
        $complaint = Complaint::with(['category', 'responses.user', 'user'])
            ->where('token', $token)
            ->firstOrFail();

        return view('public.status.show', compact('complaint'));
    }
}
