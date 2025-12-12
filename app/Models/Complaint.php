<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'token',
        'attachment', // Pastikan ini ada!
        'status',
        'nama_pelapor',
        'email_pelapor',
        'telepon_pelapor',
    ];  

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}