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
        'name',     // Sesuaikan nama kolom
        'nik',      // Sesuaikan nama kolom
        'email',
        'phone',
        // Kolom dari Step 2 (Pengaduan)
        'title',
        'description',
        'category_id',
        'attachment',
        'token',
        'status', // Tambahkan ini jika perlu (misal: 'pending', 'processed', 'finished')
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
