<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wishlist;
use App\Models\WishlistDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $totalBalance = $totalIncome - $totalExpense;
        $totalSavings = WishlistDeposit::sum('amount');

        $now = now();

        $incomeThisMonth = Transaction::where('type', 'income')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->sum('amount');

        $expenseThisMonth = Transaction::where('type', 'expense')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->sum('amount');

        $lastMonth = $now->copy()->subMonth();
        $incomeLastMonth = Transaction::where('type', 'income')
            ->whereYear('transaction_date', $lastMonth->year)
            ->whereMonth('transaction_date', $lastMonth->month)
            ->sum('amount');
        $expenseLastMonth = Transaction::where('type', 'expense')
            ->whereYear('transaction_date', $lastMonth->year)
            ->whereMonth('transaction_date', $lastMonth->month)
            ->sum('amount');

        $incomeChange = $this->percentageChange($incomeLastMonth, $incomeThisMonth);
        $expenseChange = $this->percentageChange($expenseLastMonth, $expenseThisMonth);

        $recentTransactions = Transaction::with('category')
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $spendingByCategory = Transaction::query()
            ->select('categories.name', DB::raw('SUM(transactions.amount) as total'))
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.type', 'expense')
            ->whereYear('transactions.transaction_date', $now->year)
            ->whereMonth('transactions.transaction_date', $now->month)
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $maxSpending = $spendingByCategory->max('total') ?: 1;

        $wishlists = Wishlist::withSum('deposits as saved', 'amount')
            ->where('status', 'active')
            ->orderByDesc('saved')
            ->limit(5)
            ->get()
            ->each(function ($w) {
                $target = $w->target_amount ?: 0;
                $w->progress = $target > 0 ? min(100, round(($w->saved / $target) * 100)) : 0;
            });

        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'totalBalance',
            'totalSavings',
            'incomeThisMonth',
            'expenseThisMonth',
            'incomeChange',
            'expenseChange',
            'recentTransactions',
            'spendingByCategory',
            'maxSpending',
            'wishlists'
        ));
    }

    protected function percentageChange($previous, $current)
    {
        if ($previous <= 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }
}
