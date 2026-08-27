<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\WishlistDeposit;
use Illuminate\Http\Request;

class WishlistDepositController extends Controller
{
    // Menampilkan semua category
    public function index()
    {
        $wishlistDeposit = WishlistDeposit::latest()->get();

        return view('wishlistDeposit.index', compact('wishlistDeposit'));
    }

    // Menampilkan form tambah wishlists
    public function create()
    {
        $wishlists = Wishlist::all();
        return view('wishlistDeposit.create', compact('wishlists'));
    }

    // Menyimpan wishlists baru
    public function store(Request $request)
    {
        $request->validate([
            'wishlist_id' => 'required|exists:wishlists,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'deposit_date' => 'required|date',
        ]);

        WishlistDeposit::create([
            'wishlist_id' => $request->wishlist_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'deposit_date' => $request->deposit_date,
        ]);

        return redirect()
            ->route('wishlistDeposit.index')
            ->with('success', 'Deposit berhasil ditambahkan.');
    }

    // // // Menampilkan detail category wishlist
    public function show(WishlistDeposit $wishlistDeposit)
    {
        return view('wishlistDeposit.show', compact('wishlistDeposit'));
    }

    // // // Menampilkan form edit
    public function edit(WishlistDeposit $wishlistDeposit)
    {
        return view('wishlistDeposit.edit', compact('wishlistDeposit'));
    }

    // // Mengupdate category
    // public function update(Request $request, Wishlist $wishlist)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    //         'target_amount' => 'required|numeric|min:0',
    //         'description' => 'required|string|max:255',
    //         'deadline' => 'required|date',
    //         'status' => 'required|in:active,completed,cancelled',
    //     ]);

    //     $imagePath = $wishlist->image;

    //     if ($request->hasFile('image')) {
    //         if ($wishlist->image) {
    //             Storage::disk('public')->delete($wishlist->image);
    //         }

    //         $imagePath = $request->file('image')->store('wishlists', 'public');
    //     }

    //     $wishlist->update([
    //         'name' => $request->name,
    //         'image' => $imagePath,
    //         'target_amount' => $request->target_amount,
    //         'description' => $request->description,
    //         'deadline' => $request->deadline,
    //         'status' => $request->status,
    //     ]);

    //     return redirect()
    //         ->route('wishlist.index')
    //         ->with('success', 'Wishlist berhasil diupdate.');
    // }
    // // // Menghapus Wishlist
    public function destroy(WishlistDeposit $wishlistDeposit)
    {

        $wishlistDeposit->delete();

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Wishlist berhasil dihapus.');
    }
}
