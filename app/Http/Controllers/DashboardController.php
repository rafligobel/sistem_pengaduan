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
        // 1. DASHBOARD ADMIN (Pusat Kontrol Sistem)
        // -----------------------------------------------------------
        if ($user->hasRole('admin')) {
            $stats = [
                'complaints_total'         => Complaint::count(),
                'complaints_menunggu'      => Complaint::where('status', 'menunggu')->count(),
                'complaints_diproses'      => Complaint::where('status', 'diproses')->count(),
                'complaints_terverifikasi' => Complaint::where('status', 'terverifikasi')->count(),
                'complaints_ditolak'       => Complaint::where('status', 'ditolak')->count(),
                'users_count'              => User::whereDoesntHave('roles', function($q) {
                                                $q->whereIn('name', ['admin', 'tim khusus', 'pimpinan', 'petugas', 'walikota']);
                                            })->count(),
                'categories_count'         => Category::count(),
            ];

            $latestComplaints = Complaint::with(['user', 'category'])
                ->latest()
                ->take(6)
                ->get();

            return view('admin.dashboard', compact('stats', 'latestComplaints'));
        }

        // -----------------------------------------------------------
        // 2. DASHBOARD TIM KHUSUS (Verifikasi Laporan Diteruskan)
        // -----------------------------------------------------------
        elseif ($user->hasAnyRole(['tim khusus', 'petugas'])) {
            $stats = [
                'diproses'      => Complaint::where('status', 'diproses')->count(), // Perlu verifikasi
                'terverifikasi' => Complaint::where('status', 'terverifikasi')->count(),
                'ditolak'       => Complaint::where('status', 'ditolak')->count(),
                'menunggu'      => Complaint::where('status', 'menunggu')->count(),
                'total'         => Complaint::count(),
            ];

            // Laporan berstatus 'diproses' yang diteruskan oleh admin untuk diverifikasi
            $needVerification = Complaint::where('status', 'diproses')
                ->with(['user', 'category'])
                ->orderBy('created_at', 'asc') // Prioritaskan yang paling lama menunggu
                ->take(10)
                ->get();

            return view('petugas.dashboard', compact('stats', 'needVerification'));
        }

        // -----------------------------------------------------------
        // 3. DASHBOARD PIMPINAN (Pengawasan Eksekutif - Read Only)
        // -----------------------------------------------------------
        elseif ($user->hasAnyRole(['pimpinan', 'walikota'])) {
            $stats = [
                'total'         => Complaint::count(),
                'menunggu'      => Complaint::where('status', 'menunggu')->count(),
                'diproses'      => Complaint::where('status', 'diproses')->count(),
                'terverifikasi' => Complaint::where('status', 'terverifikasi')->count(),
                'ditolak'       => Complaint::where('status', 'ditolak')->count(),
            ];

            $recentComplaints = Complaint::with(['user', 'category'])
                ->latest()
                ->take(10)
                ->get();

            return view('pimpinan.dashboard', compact('stats', 'recentComplaints'));
        }

        // -----------------------------------------------------------
        // 4. DASHBOARD PENGGUNA (Masyarakat / Pelapor)
        // -----------------------------------------------------------
        else {
            $complaints = Auth::user()->complaints()->with('category')->latest()->get();

            $stats = [
                'total'         => $complaints->count(),
                'menunggu'      => $complaints->where('status', 'menunggu')->count(),
                'diproses'      => $complaints->where('status', 'diproses')->count(),
                'terverifikasi' => $complaints->where('status', 'terverifikasi')->count(),
                'ditolak'       => $complaints->where('status', 'ditolak')->count(),
            ];

            return view('dashboard', compact('complaints', 'stats'));
        }
    }
}
