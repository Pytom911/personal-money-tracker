<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIncome = Transaction::where('type', 'income')
        ->sum('amount');

        $totalExpense = Transaction::where('type', 'expense')
        ->sum('amount');

        $totalBalance = $totalIncome - $totalExpense;

        return view('dashboard', compact('totalIncome', 'totalExpense', 'totalBalance'));
    }
}
