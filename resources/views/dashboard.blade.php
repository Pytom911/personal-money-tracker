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
                        <i class="bi bi-arrow-up-short"></i> 8.2%
                    </span>
                    <small class="text-white-50">vs last month</small>
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
                    <span class="text-success fw-semibold me-2">
                        <i class="bi bi-graph-up"></i> +12.5%
                    </span>
                    <small class="text-muted">this month</small>
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
                    <span class="text-danger fw-semibold me-2">
                        <i class="bi bi-graph-down"></i> -4.8%
                    </span>
                    <small class="text-muted">this month</small>
                </div>
            </div>
        </div>

        <!-- Savings -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="summary-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-2">Total Savings</p>
                        <div class="summary-value text-dark">Rp 8.25M</div>
                    </div>
                    <div class="summary-icon icon-saving">
                        <i class="bi bi-piggy-bank"></i>
                    </div>
                </div>
                <div class="progress mt-4 mb-2" style="height: 6px;">
                    <div class="progress-bar bg-warning" style="width: 66%"></div>
                </div>
                <small class="text-muted fw-medium">66% dari target bulanan</small>
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
                    <select
                        class="form-select form-select-sm w-auto rounded-3 shadow-none border-light bg-light fw-medium">
                        <option>Last 6 Months</option>
                        <option>Last 12 Months</option>
                    </select>
                </div>
                <!-- Area kosong untuk Chart.js / ApexCharts -->
                <div class="chart-area d-flex flex-column align-items-center justify-content-center">
                    <div class="text-center">
                        <div class="p-3 bg-white rounded-circle shadow-sm d-inline-block mb-3">
                            <i class="bi bi-bar-chart-line fs-2 text-primary"></i>
                        </div>
                        <p class="text-muted fw-medium mb-0">Ruang untuk Laravel Chart / ApexCharts</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spending by Category -->
        <div class="col-lg-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <h5 class="card-title-custom mb-1">Spending Categories</h5>
                <small class="text-muted">Distribusi pengeluaran bulan ini</small>

                <div class="mt-4 pt-2">
                    <!-- Food -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium text-dark"><i class="bi bi-egg-fried text-primary me-2"></i>
                                Food & Dining</span>
                            <span class="fw-bold">Rp 1.25M</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-gradient-primary shadow-sm" style="width: 65%"></div>
                        </div>
                    </div>

                    <!-- Transport -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium text-dark"><i class="bi bi-car-front text-warning me-2"></i>
                                Transport</span>
                            <span class="fw-bold">Rp 750k</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-gradient-warning shadow-sm" style="width: 40%"></div>
                        </div>
                    </div>

                    <!-- Shopping -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium text-dark"><i class="bi bi-bag text-danger me-2"></i>
                                Shopping</span>
                            <span class="fw-bold">Rp 500k</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-gradient-danger shadow-sm" style="width: 27%"></div>
                        </div>
                    </div>

                    <!-- Others -->
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium text-dark"><i class="bi bi-three-dots text-info me-2"></i>
                                Others</span>
                            <span class="fw-bold">Rp 250k</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-gradient-info shadow-sm" style="width: 15%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="row g-4">
        <!-- Recent Transactions -->
        <div class="col-lg-8">
            <div class="dashboard-card p-4 p-md-5">
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
                    <!-- Transaction 1 -->
                    <div class="transaction-item d-flex align-items-center">
                        <div class="transaction-icon transaction-expense me-3 shadow-sm">
                            <i class="bi bi-cart3"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark">Monthly Groceries</div>
                            <small class="text-muted">Food & Drinks • Today, 14:30</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-dark">- Rp 250.000</div>
                        </div>
                    </div>

                    <!-- Transaction 2 -->
                    <div class="transaction-item d-flex align-items-center">
                        <div class="transaction-icon transaction-income me-3 shadow-sm">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark">Freelance UI Design</div>
                            <small class="text-muted">Income • Yesterday, 09:15</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-success">+ Rp 5.000.000</div>
                        </div>
                    </div>

                    <!-- Transaction 3 -->
                    <div class="transaction-item d-flex align-items-center">
                        <div class="transaction-icon transaction-expense me-3 shadow-sm">
                            <i class="bi bi-train-front"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark">Commuter Line Topup</div>
                            <small class="text-muted">Transport • 2 days ago</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-dark">- Rp 50.000</div>
                        </div>
                    </div>

                    <!-- Transaction 4 -->
                    <div class="transaction-item d-flex align-items-center">
                        <div class="transaction-icon transaction-expense me-3 shadow-sm">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold text-dark">Starbucks Coffee</div>
                            <small class="text-muted">Food & Drinks • 3 days ago</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-dark">- Rp 35.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="dashboard-card p-4 p-md-5 h-100">
                <h5 class="card-title-custom mb-1">Quick Actions</h5>
                <small class="text-muted">Jalan pintas ke menu utama</small>

                <div class="mt-4 pt-2 d-flex flex-column gap-3">
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

@endsection
