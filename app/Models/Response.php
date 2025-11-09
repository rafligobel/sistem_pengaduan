<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'user_id', // Admin/Petugas yang menjawab
        'body',    // Isi tanggapan
    ];

    /**
     * Relasi ke Model User (Petugas/Admin).
     * Ini dibutuhkan oleh PublicStatusController
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Model Complaint (Pengaduan).
     */
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
