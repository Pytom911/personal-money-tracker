@extends('layouts.app')

@section('title', 'Analytics')

@section('content')

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div>
            <p class="text-muted-custom mb-2">Insights & Reports</p>
            <h1 class="dashboard-title mb-1">Analytics</h1>
            <p class="text-muted mb-0">Analisis tren pemasukan dan pengeluaran keuanganmu.</p>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-5">
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
            </div>
        </div>

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
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card card-balance-highlight p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2">Net Balance</p>
                        <div class="summary-value">{{ $totalBalance >= 0 ? '+' : '-' }} Rp {{ number_format(abs($totalBalance)) }}</div>
                    </div>
                    <div class="summary-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2">Saving Rate</p>
                        <div class="summary-value text-dark">{{ $savingRate }}%</div>
                    </div>
                    <div class="summary-icon icon-saving">
                        <i class="bi bi-piggy-bank"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <small class="text-muted">dari total pemasukan</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Trend + Category Breakdown -->
    <div class="row g-4 mb-5">
        <!-- Monthly Trend -->
        <div class="col-lg-8">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <div class="mb-4">
                    <h5 class="card-title-custom mb-1">Tren 6 Bulan Terakhir</h5>
                    <small class="text-muted">Perbandingan pemasukan dan pengeluaran bulanan</small>
                </div>

                <div class="chart-area">
                    <canvas id="trendChart" role="img" aria-label="Tren pemasukan vs pengeluaran"></canvas>
                </div>
            </div>
        </div>

        <!-- Spending by Category -->
        <div class="col-lg-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <div class="mb-2">
                    <h5 class="card-title-custom mb-1">Pengeluaran per Kategori</h5>
                    <small class="text-muted">Bulan {{ now()->translatedFormat('F Y') }}</small>
                </div>

                @if ($spendingByCategory->isNotEmpty())
                    <div class="chart-wrap position-relative">
                        <canvas id="categoryChart" role="img" aria-label="Pengeluaran per kategori"></canvas>
                    </div>

                    <div class="mt-3 d-flex flex-column gap-2">
                        @php
                            $palette = ['#4f46e5', '#f59e0b', '#06b6d4', '#16a34a', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6'];
                        @endphp
                        @foreach ($spendingByCategory as $cat)
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="legend-item">
                                    <span class="legend-dot" style="background: {{ $palette[$loop->index % count($palette)] }};"></span>
                                    {{ $cat->name }}
                                </span>
                                <span class="fw-bold small text-dark">Rp {{ number_format($cat->total) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon mx-auto">
                            <i class="bi bi-pie-chart"></i>
                        </div>
                        <p class="text-muted mb-0">Belum ada data pengeluaran bulan ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Top Expenses -->
    <div class="row g-4">
        <div class="col-12">
            <div class="dashboard-card p-4 p-md-5">
                <div class="mb-4">
                    <h5 class="card-title-custom mb-1">Pengeluaran Terbesar</h5>
                    <small class="text-muted">5 transaksi pengeluaran terbesar sepanjang waktu</small>
                </div>

                @if ($topExpenses->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-custom table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topExpenses as $trx)
                                    <tr>
                                        <td class="text-muted fw-semibold">
                                            #{{ str_pad($trx->id, 3, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark">{{ $trx->category?->name ?? 'Tanpa Kategori' }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ \Illuminate\Support\Str::limit($trx->description, 40) }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-medium text-dark">{{ $trx->transaction_date->format('d M Y') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold text-danger">- Rp {{ number_format($trx->amount) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon mx-auto">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <p class="text-muted mb-0">Belum ada data pengeluaran.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

    <script>
        const formatRupiah = (value) =>
            new Intl.NumberFormat('id-ID').format(Math.round(value || 0));

        const months = @json($monthly->pluck('label'));

        const trendChart = new Chart(document.getElementById('trendChart'), {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Pemasukan',
                    data: @json($monthly->pluck('income')),
                    backgroundColor: 'rgba(22, 163, 74, 0.85)',
                    borderRadius: 8,
                    barPercentage: 0.7,
                }, {
                    label: 'Pengeluaran',
                    data: @json($monthly->pluck('expense')),
                    backgroundColor: 'rgba(239, 68, 68, 0.85)',
                    borderRadius: 8,
                    barPercentage: 0.7,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 8,
                            font: { family: 'Plus Jakarta Sans', weight: '600' },
                        },
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 10,
                        cornerRadius: 10,
                        titleFont: { family: 'Plus Jakarta Sans', weight: '700' },
                        bodyFont: { family: 'Plus Jakarta Sans' },
                        callbacks: {
                            label: (item) => ` ${item.dataset.label}: Rp ${formatRupiah(item.raw)}`,
                        },
                    },
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Plus Jakarta Sans', weight: '600' } },
                    },
                    y: {
                        grid: { color: 'rgba(226, 232, 240, 0.6)' },
                        border: { display: false },
                        ticks: {
                            font: { family: 'Plus Jakarta Sans' },
                            callback: (value) => 'Rp ' + formatRupiah(value),
                        },
                    },
                },
            },
        });

        @if ($spendingByCategory->isNotEmpty())
            const palette = ['#4f46e5', '#f59e0b', '#06b6d4', '#16a34a', '#ef4444', '#8b5cf6', '#ec4899', '#14b8a6'];

            const categories = @json($spendingByCategory->pluck('name'));

            const categoryChart = new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: categories,
                    datasets: [{
                        data: @json($spendingByCategory->pluck('total')),
                        backgroundColor: categories.map((_, i) => palette[i % palette.length]),
                        borderColor: '#ffffff',
                        borderWidth: 3,
                        hoverOffset: 6,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 10,
                            cornerRadius: 10,
                            titleFont: { family: 'Plus Jakarta Sans', weight: '700' },
                            bodyFont: { family: 'Plus Jakarta Sans' },
                            callbacks: {
                                label: (item) => {
                                    const total = item.dataset.data.reduce((a, b) => a + b, 0);
                                    const pct = total > 0 ? ((item.raw / total) * 100).toFixed(1) : 0;
                                    return ` ${item.label}: Rp ${formatRupiah(item.raw)} (${pct}%)`;
                                },
                            },
                        },
                    },
                },
            });
        @endif
    </script>

@endsection