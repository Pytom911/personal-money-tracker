@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div>
            <p class="text-muted-custom mb-2">Personal Overview</p>
            <h1 class="dashboard-title mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Lacak dan kelola keuanganmu dengan mudah hari ini.</p>
        </div>
        <div class="mt-4 mt-md-0">
            <a href="{{ route('transaction.create') }}" class="btn btn-dark">
                <i class="bi bi-plus-circle-fill me-2"></i> Add Transaction
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">

        <!-- Balance (Highlight Card) -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card card-balance-highlight p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2">Total Balance</p>
                        <div class="summary-value">Rp {{ number_format($totalBalance) }}</div>
                    </div>
                    <div class="summary-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <span class="badge bg-success bg-opacity-25 text-white rounded-pill px-2 py-1 me-2">
                        <i class="bi bi-arrow-up-short"></i> {{ number_format($incomeChange, 1, ',', '.') }}%
                    </span>
                    <small class="text-white-50">pertumbuhan income</small>
                </div>
            </div>
        </div>

        <!-- Income -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2">Total Income</p>
                        <div class="summary-value text-dark">Rp {{ number_format($totalIncome) }}</div>
                    </div>
                    <div class="summary-icon icon-income">
                        <i class="bi bi-arrow-down-left"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    @if ($incomeChange >= 0)
                        <span class="text-success fw-semibold me-2">
                            <i class="bi bi-graph-up"></i> +{{ number_format($incomeChange, 1, ',', '.') }}%
                        </span>
                    @else
                        <span class="text-danger fw-semibold me-2">
                            <i class="bi bi-graph-down"></i> {{ number_format($incomeChange, 1, ',', '.') }}%
                        </span>
                    @endif
                    <small class="text-muted">vs bulan lalu</small>
                </div>
            </div>
        </div>

        <!-- Expense -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2">Total Expense</p>
                        <div class="summary-value text-dark">Rp {{ number_format($totalExpense) }}</div>
                    </div>
                    <div class="summary-icon icon-expense">
                        <i class="bi bi-arrow-up-right"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    @if ($expenseChange <= 0)
                        <span class="text-success fw-semibold me-2">
                            <i class="bi bi-graph-down"></i> {{ number_format($expenseChange, 1, ',', '.') }}%
                        </span>
                    @else
                        <span class="text-danger fw-semibold me-2">
                            <i class="bi bi-graph-up"></i> +{{ number_format($expenseChange, 1, ',', '.') }}%
                        </span>
                    @endif
                    <small class="text-muted">vs bulan lalu</small>
                </div>
            </div>
        </div>

        <!-- Savings -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2">Total Savings</p>
                        <div class="summary-value text-dark">Rp {{ number_format($totalSavings) }}</div>
                    </div>
                    <div class="summary-icon icon-saving">
                        <i class="bi bi-piggy-bank"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <span class="text-warning fw-semibold me-2">
                        <i class="bi bi-piggy-bank-fill"></i> {{ $wishlists->count() }}
                    </span>
                    <small class="text-muted">wishlist sedang aktif</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Spending Section -->
    <div class="row g-4 mb-5">
        <!-- Income vs Expense Chart -->
        <div class="col-lg-8">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="card-title-custom mb-1">Cash Flow Analytics</h5>
                        <small class="text-muted">Performa keuangan 6 bulan terakhir</small>
                    </div>
                </div>
                <div class="chart-area p-3" style="border-style: none;">
                    <canvas id="cashflowChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Spending by Category -->
        <div class="col-lg-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <h5 class="card-title-custom mb-1">Spending Categories</h5>
                <small class="text-muted">Distribusi pengeluaran bulan ini</small>

                <div class="mt-4 pt-2">
                    @forelse ($spendingByCategory as $index => $cat)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-medium text-dark">{{ $cat->name }}</span>
                                <span class="fw-bold">Rp {{ number_format($cat->total) }}</span>
                            </div>
                            <div class="progress">
                                @php
                                    $gradients = ['bg-gradient-primary', 'bg-gradient-warning', 'bg-gradient-danger', 'bg-gradient-info'];
                                    $width = $maxSpending > 0 ? round(($cat->total / $maxSpending) * 100) : 0;
                                @endphp
                                <div class="progress-bar {{ $gradients[$index % 4] }} shadow-sm" style="width: {{ $width }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon mx-auto">
                                <i class="bi bi-bar-chart"></i>
                            </div>
                            <p class="text-muted mb-0">Belum ada data pengeluaran bulan ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="row g-4 mb-5">
        <!-- Recent Transactions -->
        <div class="col-lg-8">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="card-title-custom mb-1">Recent Transactions</h5>
                        <small class="text-muted">Aktivitas keluar masuk uang terbaru</small>
                    </div>
                    <a href="{{ route('transaction.index') }}"
                        class="btn btn-sm btn-light border-0 bg-secondary bg-opacity-10 fw-medium px-3 rounded-pill">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="d-flex flex-column gap-1">
                    @forelse ($recentTransactions as $trx)
                        <div class="transaction-item d-flex align-items-center">
                            <div class="transaction-icon {{ $trx->type === 'income' ? 'transaction-income' : 'transaction-expense' }} me-3 shadow-sm">
                                <i class="bi {{ $trx->type === 'income' ? 'bi-cash-stack' : 'bi-cart3' }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold text-dark">{{ $trx->description }}</div>
                                <small class="text-muted">{{ $trx->category?->name ?? 'Tanpa Kategori' }} • {{ $trx->transaction_date->format('d M Y') }}</small>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold {{ $trx->type === 'income' ? 'text-success' : 'text-dark' }}">
                                    {{ $trx->type === 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount) }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon mx-auto">
                                <i class="bi bi-receipt"></i>
                            </div>
                            <p class="fw-bold text-dark mb-1">Belum ada transaksi</p>
                            <p class="text-muted mb-0">Mulai catat transaksi pertama kamu.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Wishlist Progress -->
        <div class="col-lg-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="card-title-custom mb-0">Wishlist Progress</h5>
                    <a href="{{ route('wishlist.index') }}" class="btn btn-sm btn-light border-0 bg-secondary bg-opacity-10 fw-medium px-3 rounded-pill">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <small class="text-muted">Tabungan impianmu yang sedang aktif</small>

                <div class="mt-4 pt-2 d-flex flex-column gap-4">
                    @forelse ($wishlists as $w)
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-medium text-dark">
                                    <i class="bi bi-gift text-primary me-2"></i>{{ $w->name }}
                                </span>
                                <span class="fw-bold small">{{ $w->progress }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-gradient-primary shadow-sm" style="width: {{ $w->progress }}%"></div>
                            </div>
                            <small class="text-muted mt-1 d-block">
                                Rp {{ number_format($w->saved) }} dari Rp {{ number_format($w->target_amount) }}
                            </small>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon mx-auto">
                                <i class="bi bi-gift"></i>
                            </div>
                            <p class="text-muted mb-0">Belum ada wishlist aktif.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4">
        <div class="col-12">
            <div class="dashboard-card p-4 p-md-5">
                <h5 class="card-title-custom mb-1">Quick Actions</h5>
                <small class="text-muted">Jalan pintas ke menu utama</small>

                <div class="mt-4 pt-2 row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('transaction.create') }}" class="quick-action">
                            <div class="d-flex align-items-center">
                                <div class="quick-action-icon me-3">
                                    <i class="bi bi-plus-lg"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark mb-1">Add Transaction</div>
                                    <small class="text-muted">Catat pengeluaran / pemasukan</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('categories.create') }}" class="quick-action">
                            <div class="d-flex align-items-center">
                                <div class="quick-action-icon me-3">
                                    <i class="bi bi-tags"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark mb-1">New Category</div>
                                    <small class="text-muted">Buat tag kategori baru</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('transaction.index') }}" class="quick-action">
                            <div class="d-flex align-items-center">
                                <div class="quick-action-icon me-3">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark mb-1">View Reports</div>
                                    <small class="text-muted">Lihat semua riwayat mutasi</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('cashflowChart');

        const labels = @json($chart['labels']);
        const incomeData = @json($chart['income']);
        const expenseData = @json($chart['expense']);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Income',
                        data: incomeData,
                        backgroundColor: 'rgba(22, 163, 74, 0.7)',
                        borderColor: '#16a34a',
                        borderWidth: 1,
                        borderRadius: 8,
                        barPercentage: 0.6,
                    },
                    {
                        label: 'Expense',
                        data: expenseData,
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: '#ef4444',
                        borderWidth: 1,
                        borderRadius: 8,
                        barPercentage: 0.6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            font: { weight: 600 },
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': Rp ' +
                                    new Intl.NumberFormat('id-ID').format(context.parsed.y);
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                if (value >= 1000000) return (value / 1000000) + 'jt';
                                if (value >= 1000) return (value / 1000) + 'rb';
                                return value;
                            },
                        },
                        grid: { color: 'rgba(226, 232, 240, 0.5)' },
                    },
                    x: {
                        grid: { display: false },
                    },
                },
            },
        });
    </script>
@endsection
