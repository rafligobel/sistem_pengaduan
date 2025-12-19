<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class PublicStatusController extends Controller
{
    // Tampilkan Halaman Cari
    public function index()
    {
        return view('public.status.index');
    }

    // Proses Cari Data
    public function check(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|string'
        ]);

        // Buat semua huruf kapital karena token formatnya TIKET-...
        $ticket = strtoupper(trim($request->ticket_id));

        // Cari berdasarkan token
        $complaint = Complaint::where('token', $ticket)->first();

        if ($complaint) {
            // Jika ketemu, tampilkan
            return redirect()->route('status.show', $complaint->token);
        } else {
            // Jika tidak ketemu, kembali dengan pesan error (Flash Session)
            return redirect()->route('status.index')
                ->with('error', 'Tiket dengan ID <strong>' . $ticket . '</strong> tidak ditemukan. Silakan periksa kembali.');
        }
    }

    // Tampilkan Hasil
    public function show($token)
    {
        $complaint = Complaint::with(['category', 'responses', 'user'])
            ->where('token', $token)
            ->firstOrFail();

        return view('public.status.show', compact('complaint'));
    }
}
