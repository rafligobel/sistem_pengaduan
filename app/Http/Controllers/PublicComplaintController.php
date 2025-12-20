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
        $categories = Category::all();
        return view('public.step1', compact('categories'));
    }

    /**
     * PROSES TAHAP 1: Validasi & Simpan ke Sesi Sementara
     */
    public function storeStep1(\App\Http\Requests\StoreComplaintStep1Request $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // SECURITY UPDATE: Simpan di disk 'local' (storage/app/temp-complaints) agar tidak bisa diakses publik
            $path = $request->file('image')->store('temp-complaints', 'local');
            session(['complaint_image' => $path]);
        }

        session([
            'complaint_data' => [
                'title' => $validated['title'],
                'category_id' => $validated['category_id'],
                'content' => $validated['content'],
            ]
        ]);

        return redirect()->route('complaint.public.step2.create');
    }

    /**
     * TAHAP 2: Review & Konfirmasi
     */
    public function createStep2()
    {
        $data = session('complaint_data');
        $image = session('complaint_image');

        if (!$data) {
            return redirect()->route('complaint.public.step1.create');
        }

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

        $ticketCode = 'TIKET-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $finalImagePath = null;
        if ($tempImage) {
            $finalImagePath = 'complaints/' . basename($tempImage);
            // SECURITY UPDATE: Pindahkan file dalam disk 'local'
            if (Storage::disk('local')->exists($tempImage)) {
                 Storage::disk('local')->move($tempImage, $finalImagePath);
            }
        }

        // Simpan ke Database
        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'token' => $ticketCode,
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            
            // PERBAIKAN DISINI: Gunakan 'attachment' sesuai nama kolom di database
            'attachment' => $finalImagePath, 
            
            'status' => 'pending',
        ]);

        session()->forget(['complaint_data', 'complaint_image']);

        return redirect()->route('complaint.public.finish', $complaint->token);
    }

    /**
     * TAHAP 3: Selesai / Tampilkan Tiket
     */
    public function finish($token)
    {
        $complaint = Complaint::where('token', $token)->firstOrFail();
        return view('public.finish', compact('complaint'));
    }
}