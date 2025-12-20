<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CleanupTempComplaints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-temp-complaints';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus file sementara pengaduan yang berusia lebih dari 24 jam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = 'temp-complaints';
        $disk = 'local';
        
        // Pastikan direktori ada
        if (!Storage::disk($disk)->exists($directory)) {
            $this->info("Direktori $directory tidak ditemukan.");
            return;
        }

        $files = Storage::disk($disk)->files($directory);
        $count = 0;
        $now = now();

        foreach ($files as $file) {
            $lastModified = Storage::disk($disk)->lastModified($file);
            $fileTime = \Carbon\Carbon::createFromTimestamp($lastModified);

            // Jika file lebih tua dari 24 jam
            if ($fileTime->diffInHours($now) >= 24) {
                Storage::disk($disk)->delete($file);
                $this->info("Dihapus: $file");
                $count++;
            }
        }

        if ($count > 0) {
            Log::info("CleanupTempComplaints: Berhasil menghapus $count file sampah.");
            $this->info("Selesai. Total file dihapus: $count");
        } else {
            $this->info("Tidak ada file sampah yang perlu dihapus.");
        }
    }
}
