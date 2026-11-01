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
     * TAHAP 1: Form Input Data Pengaduan (5W+1H)
     * Sesuai Perwako 2025
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

        // Handle multiple file uploads (bukti pendukung)
        $uploadedFiles = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // SECURITY UPDATE: Simpan di disk 'local' agar tidak bisa diakses publik
                $path = $file->store('temp-complaints', 'local');
                $uploadedFiles[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType(),
                ];
            }
        }

        session(['complaint_attachments' => $uploadedFiles]);

        session([
            'complaint_data' => [
                'what'           => $validated['what'],
                'who'            => $validated['who'],
                'where_location' => $validated['where_location'],
                'when_time'      => $validated['when_time'],
                'why'            => $validated['why'] ?? null,
                'how'            => $validated['how'],
                'category_id'    => $validated['category_id'],
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
        $attachments = session('complaint_attachments', []);

        if (!$data) {
            return redirect()->route('complaint.public.step1.create');
        }

        $category = Category::find($data['category_id']);

        // Generate previews for image attachments
        $attachmentPreviews = [];
        foreach ($attachments as $att) {
            $preview = null;
            if (str_starts_with($att['mime'], 'image/') && Storage::disk('local')->exists($att['path'])) {
                $content = Storage::disk('local')->get($att['path']);
                $preview = 'data:' . $att['mime'] . ';base64,' . base64_encode($content);
            }
            $attachmentPreviews[] = array_merge($att, ['preview' => $preview]);
        }

        return view('public.step2', compact('data', 'category', 'attachmentPreviews'));
    }

    /**
     * PROSES FINAL: Simpan ke Database
     */
    public function store()
    {
        $data = session('complaint_data');
        $tempAttachments = session('complaint_attachments', []);

        if (!$data) {
            return redirect()->route('complaint.public.step1.create');
        }

        $ticketCode = 'TIKET-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        // Pindahkan file dari temp ke final directory
        $finalAttachmentPath = null;
        if (!empty($tempAttachments)) {
            $firstFile = $tempAttachments[0];
            $finalAttachmentPath = 'complaints/' . basename($firstFile['path']);
            if (Storage::disk('local')->exists($firstFile['path'])) {
                Storage::disk('local')->move($firstFile['path'], $finalAttachmentPath);
            }

            // Pindahkan file tambahan (simpan referensi di nama file dengan separator)
            $additionalPaths = [];
            for ($i = 1; $i < count($tempAttachments); $i++) {
                $addPath = 'complaints/' . basename($tempAttachments[$i]['path']);
                if (Storage::disk('local')->exists($tempAttachments[$i]['path'])) {
                    Storage::disk('local')->move($tempAttachments[$i]['path'], $addPath);
                }
                $additionalPaths[] = $addPath;
            }

            // Gabungkan semua path dengan separator |
            if (!empty($additionalPaths)) {
                $finalAttachmentPath = $finalAttachmentPath . '|' . implode('|', $additionalPaths);
            }
        }

        // Simpan ke Database
        $complaint = Complaint::create([
            'user_id'        => Auth::id(),
            'token'          => $ticketCode,
            'category_id'    => $data['category_id'],
            // 5W+1H
            'what'           => $data['what'],
            'who'            => $data['who'],
            'where_location' => $data['where_location'],
            'when_time'      => $data['when_time'],
            'why'            => $data['why'],
            'how'            => $data['how'],
            // Lampiran & Status
            'attachment'     => $finalAttachmentPath, 
            'status'         => 'menunggu',
        ]);

        session()->forget(['complaint_data', 'complaint_attachments']);

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