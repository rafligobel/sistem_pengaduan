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

        // Hapus spasi jika user tidak sengaja copy-paste dengan spasi
        $ticket = trim($request->ticket_id);

        // Cari berdasarkan ticket_id
        $complaint = Complaint::where('ticket_id', $ticket)->first();

        if ($complaint) {
            // Jika ketemu, tampilkan
            return redirect()->route('status.show', $complaint->ticket_id);
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
            ->where('ticket_id', $token)
            ->firstOrFail();

        return view('public.status.show', compact('complaint'));
    }
}
