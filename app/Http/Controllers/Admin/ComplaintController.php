<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan.
     */
    public function index()
    {
        // Ambil semua pengaduan, urutkan dari yang terbaru,
        // dan lakukan eager loading relasi 'category'
        $complaints = Complaint::with('category')
            ->latest()
            ->paginate(10); // Paginate 10 data per halaman

        return view('admin.complaints.index', compact('complaints'));
    }

    /**
     * Menampilkan detail satu pengaduan.
     */
    public function show(Complaint $complaint)
    {
        // Eager load relasi yang dibutuhkan (category dan responses)
        $complaint->load(['category', 'responses.user']);

        return view('admin.complaints.show', compact('complaint'));
    }
}
