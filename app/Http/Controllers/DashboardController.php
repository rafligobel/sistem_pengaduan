<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Category;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // -----------------------------------------------------------
        // 1. DASHBOARD ADMIN (Pusat Kontrol)
        // -----------------------------------------------------------
        if ($user->hasRole('admin')) {
            // Data Statistik Lengkap
            $stats = [
                'complaints_total'   => Complaint::count(),
                'complaints_pending' => Complaint::where('status', 'pending')->count(),
                'users_count'        => User::role('masyarakat')->count(),
                'categories_count'   => Category::count(),
            ];

            // Mengambil 5 pengaduan terbaru untuk tabel aktivitas
            // Pastikan model Complaint memiliki relasi 'user' dan 'category'
            $latestComplaints = Complaint::with(['user', 'category'])
                ->latest()
                ->take(5)
                ->get();

            // Return ke view khusus Admin
            return view('admin.dashboard', compact('stats', 'latestComplaints'));
        }

        // -----------------------------------------------------------
        // 2. DASHBOARD INSPEKTUR / PETUGAS (Fokus Kerja)
        // -----------------------------------------------------------
        elseif ($user->hasRole('petugas')) {
            // Statistik Status Laporan
            $stats = [
                'pending'  => Complaint::where('status', 'pending')->count(),
                'process'  => Complaint::where('status', 'proses')->count(),
                'finished' => Complaint::where('status', 'selesai')->count(),
            ];

            // Petugas butuh melihat laporan 'pending' atau 'proses' untuk ditindaklanjuti
            $needResponse = Complaint::whereIn('status', ['pending', 'proses'])
                ->with('user') // Eager load user pelapor
                ->orderBy('created_at', 'asc') // Prioritaskan yang paling lama menunggu
                ->take(5)
                ->get();

            // Return ke view khusus Petugas
            return view('petugas.dashboard', compact('stats', 'needResponse'));
        }

        // -----------------------------------------------------------
        // 3. DASHBOARD PENGGUNA / MASYARAKAT
        // -----------------------------------------------------------
        else {
            // Masyarakat langsung melihat dashboard default
            return view('dashboard');
        }
    }
}
