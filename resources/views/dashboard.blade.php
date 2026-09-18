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

    <!-- This Month Summary, Pie Chart & Top Categories -->
    @php $netThisMonth = $incomeThisMonth - $expenseThisMonth; @endphp
    <div class="row g-4 mb-5">
        <!-- Pemasukan vs Pengeluaran (Pie Chart) -->
        <div class="col-lg-7 col-xl-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <div class="mb-2">
                    <h5 class="card-title-custom mb-1">Pemasukan vs Pengeluaran</h5>
                    <small class="text-muted">Perbandingan arus uang</small>
                </div>

                <div class="chart-toggle-group">
                    <input type="radio" class="btn-check" name="chartRange" id="chartMonth" value="month" checked>
                    <label class="btn btn-chart-toggle" for="chartMonth">Bulan Ini</label>
                    <input type="radio" class="btn-check" name="chartRange" id="chartTotal" value="total">
                    <label class="btn btn-chart-toggle" for="chartTotal">Total Keseluruhan</label>
                </div>

                <div class="chart-wrap position-relative">
                    <canvas id="incomeExpenseChart" role="img" aria-label="Diagram Pemasukan vs Pengeluaran"></canvas>
                    <div class="chart-center text-center" id="chartCenterValue">
                        <small class="text-muted d-block">Rp</small>
                        <strong class="fw-extrabold">0</strong>
                    </div>
                </div>

                <div class="chart-legend mt-3">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="legend-item">
                            <span class="legend-dot legend-dot-income"></span> Pemasukan
                        </span>
                        <span class="fw-bold text-success" id="legendIncome">Rp 0</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="legend-item">
                            <span class="legend-dot legend-dot-expense"></span> Pengeluaran
                        </span>
                        <span class="fw-bold text-danger" id="legendExpense">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Month Summary -->
        <div class="col-lg-5 col-xl-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <div class="mb-4">
                    <h5 class="card-title-custom mb-1">Ringkasan Bulan Ini</h5>
                    <small class="text-muted">Performa keuangan bulan {{ now()->translatedFormat('F Y') }}</small>
                </div>

                <div class="row g-3">
                    <!-- Income -->
                    <div class="col-12">
                        <div class="summary-card p-3 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="summary-icon icon-income me-2" style="width:36px;height:36px;font-size:1rem;border-radius:10px;">
                                    <i class="bi bi-arrow-down-left"></i>
                                </div>
                                <span class="text-muted small">Income</span>
                            </div>
                            <div class="fw-bold text-dark fs-5">Rp {{ number_format($incomeThisMonth) }}</div>
                            <small class="text-success fw-semibold">
                                <i class="bi bi-graph-up"></i> +{{ number_format($incomeChange, 1, ',', '.') }}%
                            </small>
                        </div>
                    </div>

                    <!-- Expense -->
                    <div class="col-12">
                        <div class="summary-card p-3 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="summary-icon icon-expense me-2" style="width:36px;height:36px;font-size:1rem;border-radius:10px;">
                                    <i class="bi bi-arrow-up-right"></i>
                                </div>
                                <span class="text-muted small">Expense</span>
                            </div>
                            <div class="fw-bold text-dark fs-5">Rp {{ number_format($expenseThisMonth) }}</div>
                            <small class="{{ $expenseChange <= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                                <i class="bi {{ $expenseChange <= 0 ? 'bi-graph-down' : 'bi-graph-up' }}"></i>
                                {{ $expenseChange <= 0 ? '' : '+' }}{{ number_format($expenseChange, 1, ',', '.') }}%
                            </small>
                        </div>
                    </div>

                    <!-- Net / Cash Flow -->
                    <div class="col-12">
                        <div class="summary-card p-3 h-100">
                            <div class="d-flex align-items-center mb-2">
                                <div class="summary-icon me-2" style="width:36px;height:36px;font-size:1rem;border-radius:10px;background:#eef2ff;color:var(--primary);">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                                <span class="text-muted small">Net / Cash Flow</span>
                            </div>
                            <div class="fw-bold text-dark fs-5">
                                <span class="{{ $netThisMonth >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $netThisMonth >= 0 ? '+' : '-' }} Rp {{ number_format(abs($netThisMonth)) }}
                                </span>
                            </div>
                            <small class="text-muted">sisa bulan ini</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Spending Categories (compact) -->
        <div class="col-lg-12 col-xl-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <h5 class="card-title-custom mb-1">Top Kategori Pengeluaran</h5>
                <small class="text-muted">Pengeluaran terbesar bulan ini</small>

                <div class="mt-4">
                    @forelse ($spendingByCategory as $index => $cat)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-medium text-dark">{{ $cat->name }}</span>
                                <span class="fw-bold small">Rp {{ number_format($cat->total) }}</span>
                            </div>
                            <div class="progress" style="height:8px;">
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

    <script>
        const formatRupiah = (value) =>
            new Intl.NumberFormat('id-ID').format(Math.round(value || 0));

        const chartData = {
            month: {
                labels: ['Pemasukan', 'Pengeluaran'],
                data: [{{ $incomeThisMonth }}, {{ $expenseThisMonth }}],
                center: '{{ $incomeThisMonth - $expenseThisMonth }}',
            },
            total: {
                labels: ['Pemasukan', 'Pengeluaran'],
                data: [{{ $totalIncome }}, {{ $totalExpense }}],
                center: '{{ $totalBalance }}',
            },
        };

        const colors = {
            income: 'rgba(22, 163, 74, 0.9)',
            incomeBorder: '#ffffff',
            expense: 'rgba(239, 68, 68, 0.9)',
            expenseBorder: '#ffffff',
        };

        const ctx = document.getElementById('incomeExpenseChart');
        const centerValue = document.getElementById('chartCenterValue');
        const legendIncome = document.getElementById('legendIncome');
        const legendExpense = document.getElementById('legendExpense');

        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartData.month.labels,
                datasets: [{
                    data: chartData.month.data,
                    backgroundColor: [colors.income, colors.expense],
                    borderColor: [colors.incomeBorder, colors.expenseBorder],
                    borderWidth: 3,
                    hoverOffset: 6,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 10,
                        cornerRadius: 10,
                        titleFont: { family: 'Plus Jakarta Sans', weight: '700' },
                        bodyFont: { family: 'Plus Jakarta Sans' },
                        callbacks: {
                            label: (item) =>
                                ` ${item.label}: Rp ${formatRupiah(item.raw)}`,
                        },
                    },
                },
            },
        });

        function applyChart(key) {
            const d = chartData[key];
            const [income, expense] = d.data;
            const radix = Math.abs(Number(d.center));

            chart.data.datasets[0].data = d.data;
            chart.update();

            legendIncome.textContent = `Rp ${formatRupiah(income)}`;
            legendExpense.textContent = `Rp ${formatRupiah(expense)}`;
            centerValue.innerHTML =
                `<small class="text-muted d-block">Saldo</small>` +
                `<strong class="fw-extrabold ${radix === 0 ? 'text-muted' : (Number(d.center) >= 0 ? 'text-success' : 'text-danger')}">Rp ${formatRupiah(radix)}</strong>`;

            centerValue.classList.toggle('d-none', income === 0 && expense === 0);
        }

        document.querySelectorAll('input[name="chartRange"]').forEach((input) => {
            input.addEventListener('change', () => applyChart(input.value));
        });

        applyChart('month');
    </script>

@endsection
