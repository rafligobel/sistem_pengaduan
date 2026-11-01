<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung Statistik 4 Status Resmi
        $total = Complaint::count();
        $menunggu = Complaint::where('status', 'menunggu')->count();
        $diproses = Complaint::where('status', 'diproses')->count();
        $terverifikasi = Complaint::where('status', 'terverifikasi')->count();
        $ditolak = Complaint::where('status', 'ditolak')->count();

        return view('admin.dashboard', compact('total', 'menunggu', 'diproses', 'terverifikasi', 'ditolak'));
    }
}
