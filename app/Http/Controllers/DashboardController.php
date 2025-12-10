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

        // 1. DASHBOARD ADMIN
        if ($user->hasRole('admin')) {
            // Siapkan data statistik untuk admin
            $stats = [
                'complaints_total' => Complaint::count(),
                'complaints_pending' => Complaint::where('status', 'pending')->count(),
                'complaints_process' => Complaint::where('status', 'proses')->count(),
                'users_count' => User::role('masyarakat')->count(),
                'categories_count' => Category::count(),
            ];
            return view('admin.dashboard', compact('stats'));
        }

        // 2. DASHBOARD INSPEKTUR / PETUGAS
        elseif ($user->hasRole('petugas')) {
            // Petugas hanya fokus ke pengaduan
            $stats = [
                'pending' => Complaint::where('status', 'pending')->count(),
                'process' => Complaint::where('status', 'proses')->count(),
                'finished' => Complaint::where('status', 'selesai')->count(),
            ];
            return view('petugas.dashboard', compact('stats'));
        }

        // 3. DASHBOARD PENGGUNA (MASYARAKAT)
        else {
            // View ini adalah file dashboard.blade.php yang sudah kita perbaiki sebelumnya
            return view('dashboard');
        }
    }
}
