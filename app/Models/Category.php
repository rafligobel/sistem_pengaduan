<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Relasi ke Model Complaint.
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
