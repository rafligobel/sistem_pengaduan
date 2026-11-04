<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('landing_galleries');
        });
        static::deleted(function () {
            Cache::forget('landing_galleries');
        });
    }
}
