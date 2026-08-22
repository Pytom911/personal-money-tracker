<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua category
    public function index()
    {
        $categories = Category::latest()->get();

        return view('categories.index', compact('categories'));
    }

    // Menampilkan form tambah category
    public function create()
    {
        return view('categories.create');
    }

    // Menyimpan category baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category berhasil ditambahkan.');
    }

    // Menampilkan detail category
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Menampilkan form edit
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Mengupdate category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category berhasil diupdate.');
    }

    // Menghapus category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category berhasil dihapus.');
    }
}
