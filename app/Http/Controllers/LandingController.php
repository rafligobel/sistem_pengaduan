<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil 8 galeri terbaru untuk ditampilkan di landing page
        $galleries = Gallery::latest()->take(8)->get();
        // Ambil 12 berita terbaru (untuk mendukung scroll horizontal 2 baris)
        $news = News::latest()->take(12)->get();
        
        return view('welcome', compact('galleries', 'news'));
    }
}
