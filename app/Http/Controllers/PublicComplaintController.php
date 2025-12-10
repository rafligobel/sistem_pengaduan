<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicComplaintController extends Controller
{
    /**
     * TAHAP 1: Form Input Data
     */
    public function createStep1()
    {
        // Mengambil semua kategori untuk dropdown
        $categories = Category::all();
        return view('public.step1', compact('categories'));
    }

    /**
     * PROSES TAHAP 1: Validasi & Simpan ke Sesi Sementara
     */
    public function storeStep1(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Simpan Gambar Sementara (jika ada)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('temp-complaints', 'public');
            session(['complaint_image' => $path]);
        }

        // 3. Simpan Data Teks ke Sesi
        session([
            'complaint_data' => [
                'title' => $validated['title'],
                'category_id' => $validated['category_id'],
                'content' => $validated['content'],
            ]
        ]);

        // 4. Lanjut ke Tahap 2
        return redirect()->route('complaint.public.step2.create');
    }

    /**
     * TAHAP 2: Review & Konfirmasi
     */
    public function createStep2()
    {
        // Ambil data dari sesi
        $data = session('complaint_data');
        $image = session('complaint_image');

        if (!$data) {
            return redirect()->route('complaint.public.step1.create');
        }

        // Ambil nama kategori untuk ditampilkan
        $category = Category::find($data['category_id']);

        return view('public.step2', compact('data', 'category', 'image'));
    }

    /**
     * PROSES FINAL: Simpan ke Database
     */
    public function store()
    {
        $data = session('complaint_data');
        $tempImage = session('complaint_image');

        if (!$data) {
            return redirect()->route('complaint.public.step1.create');
        }

        // Generate ID Tiket Unik (Contoh: TIKET-20241010-XYZ)
        $ticketId = 'TIKET-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        // Pindahkan gambar dari temp ke folder asli (jika ada)
        $finalImagePath = null;
        if ($tempImage) {
            $finalImagePath = 'complaints/' . basename($tempImage);
            Storage::disk('public')->move($tempImage, $finalImagePath);
        }

        // Simpan ke Database
        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'ticket_id' => $ticketId,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $finalImagePath,
            'status' => 'pending', // Status awal
        ]);

        // Hapus sesi
        session()->forget(['complaint_data', 'complaint_image']);

        // Redirect ke halaman Sukses
        return redirect()->route('complaint.public.finish', $complaint->ticket_id);
    }

    /**
     * TAHAP 3: Selesai / Tampilkan Tiket
     */
    public function finish($token)
    {
        $complaint = Complaint::where('ticket_id', $token)->firstOrFail();
        return view('public.finish', compact('complaint'));
    }
}
