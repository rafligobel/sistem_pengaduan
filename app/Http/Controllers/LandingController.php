<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        // Cache galeri & berita selama 10 menit untuk mempercepat response beranda
        $galleries = Cache::remember('landing_galleries', 600, function () {
            return Gallery::select('id', 'title', 'description', 'image_path')
                ->latest()
                ->take(8)
                ->get();
        });

        $news = Cache::remember('landing_news', 600, function () {
            return News::select('id', 'title', 'content', 'image_path', 'created_at')
                ->latest()
                ->take(12)
                ->get();
        });
        
        return view('welcome', compact('galleries', 'news'));
    }
}
