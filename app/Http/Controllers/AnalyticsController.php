<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $totalBalance = $totalIncome - $totalExpense;
        $savingRate = $totalIncome > 0 ? round((($totalIncome - $totalExpense) / $totalIncome) * 100, 1) : 0;

        $now = now();

        $monthly = collect(range(5, 0))->map(function ($i) use ($now) {
            $month = $now->copy()->subMonths($i);

            return (object) [
                'label' => $month->translatedFormat('M y'),
                'income' => (int) Transaction::where('type', 'income')
                    ->whereYear('transaction_date', $month->year)
                    ->whereMonth('transaction_date', $month->month)
                    ->sum('amount'),
                'expense' => (int) Transaction::where('type', 'expense')
                    ->whereYear('transaction_date', $month->year)
                    ->whereMonth('transaction_date', $month->month)
                    ->sum('amount'),
            ];
        });

        $spendingByCategory = Transaction::query()
            ->select('categories.name as name', 'categories.id as id', DB::raw('SUM(transactions.amount) as total'))
            ->join('categories', 'categories.id', '=', 'transactions.category_id')
            ->where('transactions.type', 'expense')
            ->whereYear('transactions.transaction_date', $now->year)
            ->whereMonth('transactions.transaction_date', $now->month)
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total')
            ->get();

        $topExpenses = Transaction::with('category')
            ->where('type', 'expense')
            ->orderByDesc('amount')
            ->limit(5)
            ->get();

        return view('analytics.index', compact(
            'totalIncome',
            'totalExpense',
            'totalBalance',
            'savingRate',
            'monthly',
            'spendingByCategory',
            'topExpenses'
        ));
    }
}