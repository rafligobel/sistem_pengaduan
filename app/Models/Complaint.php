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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleting(function ($complaint) {
            if ($complaint->attachment && \Illuminate\Support\Facades\Storage::disk('local')->exists($complaint->attachment)) {
                \Illuminate\Support\Facades\Storage::disk('local')->delete($complaint->attachment);
            }
        });
    }
}