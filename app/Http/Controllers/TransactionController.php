<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::with('category')
            ->latest()
            ->get();

        return view('transaction.index', compact('transactions'));
    }

    // Menampilkan form tambah transaksi
    public function create()
    {
        $categories = Category::all();

        return view('transaction.create', compact('categories'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create([
            'category_id' => $request->category_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()
            ->route('transaction.index')
            ->with('success', 'Transaction berhasil ditambahkan.');
    }

    // Menampilkan detail transaksi
    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    // Menampilkan form edit
    public function edit(Transaction $transaction)
    {
        $categories = Category::all();

        return view(
            'transaction.edit',
            compact('transaction', 'categories')
        );
    }

    // Mengupdate transaksi
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update([
            'category_id' => $request->category_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()
            ->route('transaction.index')
            ->with('success', 'Transaction berhasil diupdate.');
    }

    // Menghapus transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()
            ->route('transaction.index')
            ->with('success', 'Transaction berhasil dihapus.');
    }
}
