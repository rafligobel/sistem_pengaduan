<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBiodataRequest;
use App\Http\Requests\StoreComplaintDataRequest;
use App\Models\Complaint;
use App\Models\Category;
use Illuminate\Support\Str;

class PublicComplaintController extends Controller
{
    // Tampilkan Form Step 1 (Biodata)
    public function createStep1(Request $request)
    {
        $biodata = $request->session()->get('biodata', []);
        return view('public.step1', compact('biodata'));
    }

    // Simpan Step 1 ke Session
    public function postStep1(StoreBiodataRequest $request)
    {
        $request->session()->put('biodata', $request->validated());
        return redirect()->route('complaint.public.step2.create');
    }

    // Tampilkan Form Step 2 (Pengaduan)
    public function createStep2(Request $request)
    {
        if (!$request->session()->has('biodata')) {
            return redirect()->route('complaint.public.step1.create');
        }
        $categories = Category::all();
        return view('public.step2', compact('categories'));
    }

    // Simpan Semua (Step 2) ke Database
    public function store(StoreComplaintDataRequest $request)
    {
        $biodata = $request->session()->get('biodata');
        $complaintData = $request->validated();

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $complaintData['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        // Gabungkan data
        $fullData = array_merge($biodata, $complaintData);

        // Buat Token Unik
        $fullData['token'] = Str::upper(Str::random(10));

        $complaint = Complaint::create($fullData);

        // Hapus session
        $request->session()->forget('biodata');

        return redirect()->route('complaint.public.finish', ['token' => $complaint->token]);
    }

    // Tampilkan Halaman Selesai (Step 3)
    public function finish($token)
    {
        return view('public.finish', compact('token'));
    }
}
