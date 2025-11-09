<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom mana saja yang boleh diisi secara massal (mass assignable).
     */
    protected $fillable = [
        // Kolom dari Step 1 (Biodata)
        'nama_pelapor',
        'email_pelapor',
        'telepon_pelapor',
        // Kolom dari Step 2 (Pengaduan)
        'title',
        'content', // Sesuaikan dengan migrasi
        'category_id',
        'attachment',
        'token',
        'status',
        // 'user_id' juga bisa ditambahkan jika Anda ingin mengaitkannya
    ];  

    /**
     * Relasi ke Category
     * (Dibutuhkan oleh PublicStatusController)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Responses
     * (Dibutuhkan oleh PublicStatusController)
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
