<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_path',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleting(function ($news) {
            if ($news->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($news->image_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($news->image_path);
            }
        });
    }
}
