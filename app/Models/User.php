<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tanggapan yang dibuat oleh User ini.
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    // --- TAMBAHKAN KODE INI ---
    /**
     * Relasi ke pengaduan yang dibuat oleh User ini.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    // --------------------------
}
