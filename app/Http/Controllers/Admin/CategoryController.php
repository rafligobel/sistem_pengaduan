<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Simpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ], [
            'name.unique' => 'Nama kategori ini sudah ada.'
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit kategori.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update kategori di database.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            // Pastikan 'name' unik, KECUALI untuk ID kategori ini sendiri
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.unique' => 'Nama kategori ini sudah ada.'
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy(Category $category)
    {
        // PENYEMPURNAAN PENTING:
        // Cek apakah kategori ini masih digunakan oleh pengaduan.
        if ($category->complaints()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori ini tidak dapat dihapus karena masih digunakan oleh pengaduan.');
        }

        // Jika aman, baru hapus
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
