<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WishlistController extends Controller
{
    // Menampilkan semua category
    public function index()
    {
        $wishlists = Wishlist::latest()->get();

        return view('wishlist.index', compact('wishlists'));
    }

    // Menampilkan form tambah wishlists
    public function create()
    {
        return view('wishlist.create');
    }

    // Menyimpan wishlists baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'target_amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('wishlists', 'public');

        Wishlist::create([
            'name' => $request->name,
            'image' => $imagePath,
            'target_amount' => $request->target_amount,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Wishlist berhasil ditambahkan.');
    }

    // // Menampilkan detail category
    public function show(Wishlist $wishlist)
    {
        return view('wishlist.show', compact('wishlist'));
    }

    // // Menampilkan form edit
    public function edit(Wishlist $wishlist)
    {
        return view('wishlist.edit', compact('wishlist'));
    }

    // Mengupdate category
    public function update(Request $request, Wishlist $wishlist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'target_amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $imagePath = $wishlist->image;

        if ($request->hasFile('image')) {
            if ($wishlist->image) {
                Storage::disk('public')->delete($wishlist->image);
            }

            $imagePath = $request->file('image')->store('wishlists', 'public');
        }

        $wishlist->update([
            'name' => $request->name,
            'image' => $imagePath,
            'target_amount' => $request->target_amount,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Wishlist berhasil diupdate.');
    }
    // // Menghapus Wishlist
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->image) {
            Storage::disk('public')->delete($wishlist->image);
        }

        $wishlist->delete();

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Wishlist berhasil dihapus.');
    }
}
