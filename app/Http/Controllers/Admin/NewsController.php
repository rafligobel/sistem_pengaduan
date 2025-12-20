<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\StoreNewsRequest $request)
    {
        // Validation handled by FormRequest

        $path = $request->file('image')->store('news', 'public');
        $slug = Str::slug($request->title) . '-' . time();

        News::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'image_path' => $path,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diterbitkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete(); // File deletion handled by Model Observer

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
