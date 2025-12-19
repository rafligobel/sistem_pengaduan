<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SystemController extends Controller
{
    public function index()
    {
        // 1. Informasi Sistem (Architecture & Deploy Info)
        $systemInfo = [
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
            'server_ip' => request()->server('SERVER_ADDR', '127.0.0.1'),
            'database_connection' => config('database.default'),
            'app_environment' => config('app.env'),
            'debug_mode' => config('app.debug') ? 'Enabled' : 'Disabled',
        ];

        // 2. Simulasi Log (QA & Testing)
        $logs = []; 
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            // Ambil 50 baris terakhir
            $lines = file($logFile);
            $logs = array_slice($lines, -20); 
        }

        return view('admin.system.index', compact('systemInfo', 'logs'));
    }

    public function optimize()
    {
        // Fitur Maintenance: Clear Cache
        Artisan::call('optimize:clear');
        return back()->with('success', 'Sistem berhasil dioptimasi (Cache Cleared).');
    }

    public function backup()
    {
        // Fitur Backup (Simulasi)
        // Di real production, ini akan menjalankan `spatie/laravel-backup`
        Log::info('Backup system requested by Admin.');
        sleep(2); // Simulasi process
        return back()->with('success', 'Backup database dan file berhasil dijalankan! File tersimpan di storage/app/backup.');
    }
}
