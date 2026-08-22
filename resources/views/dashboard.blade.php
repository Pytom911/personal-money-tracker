<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Finance Tracker</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f6f7fb;
            color: #212529;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .dashboard-title {
            font-weight: 700;
            letter-spacing: -0.7px;
        }

        .text-muted-custom {
            color: #8a9199;
        }

        .summary-card {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            transition: 0.2s ease;
        }

        .summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        .summary-icon {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 20px;
        }

        .icon-balance {
            background: #eef2ff;
            color: #4f46e5;
        }

        .icon-income {
            background: #ecfdf3;
            color: #16a34a;
        }

        .icon-expense {
            background: #fef2f2;
            color: #dc2626;
        }

        .icon-saving {
            background: #fff7ed;
            color: #ea580c;
        }

        .summary-value {
            font-size: 1.45rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .dashboard-card {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
        }

        .card-title-custom {
            font-weight: 650;
        }

        .transaction-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f1f3;
        }

        .transaction-item:last-child {
            border-bottom: 0;
        }

        .transaction-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
        }

        .transaction-income {
            background: #ecfdf3;
            color: #16a34a;
        }

        .transaction-expense {
            background: #fef2f2;
            color: #dc2626;
        }

        .quick-action {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
            text-decoration: none;
            color: inherit;
            display: block;
            transition: 0.2s ease;
        }

        .quick-action:hover {
            background: #f8f9fa;
            color: inherit;
        }

        .quick-action-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f3f5;
        }

        .progress {
            height: 8px;
            border-radius: 20px;
        }

        @media (max-width: 576px) {

            .summary-value {
                font-size: 1.25rem;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }

        }
    </style>

</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <a class="navbar-brand" href="#">
                <i class="bi bi-wallet2 me-2"></i>
                Finance Tracker
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transaction.index') }}">
                            Transactions
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            Categories
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- Main -->

    <main class="container py-4 py-lg-5">

        <!-- Header -->

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">

            <div>

                <p class="text-muted-custom mb-1">
                    Personal Finance
                </p>

                <h1 class="dashboard-title mb-1">
                    Dashboard
                </h1>

                <p class="text-muted mb-0">
                    Pantau kondisi keuangan lu hari ini.
                </p>

            </div>

            <div class="mt-3 mt-md-0">

                <a href="{{ route('transaction.create') }}" class="btn btn-dark">
                    <i class="bi bi-plus-lg me-1"></i>
                    Add Transaction
                </a>

            </div>

        </div>


        <!-- Summary Cards -->

        <div class="row g-3 mb-4">

            <!-- Balance -->

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4 h-100">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted mb-2">
                                Total Balance
                            </p>

                            <div class="summary-value">
                                Rp 8.250.000
                            </div>

                        </div>

                        <div class="summary-icon icon-balance">

                            <i class="bi bi-wallet2"></i>

                        </div>

                    </div>

                    <small class="text-success mt-3 d-block">

                        <i class="bi bi-arrow-up"></i>

                        8.2% dari bulan lalu

                    </small>

                </div>

            </div>


            <!-- Income -->

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4 h-100">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted mb-2">
                                Income
                            </p>

                            <div class="summary-value">
                                Rp 12.500.000
                            </div>

                        </div>

                        <div class="summary-icon icon-income">

                            <i class="bi bi-arrow-down-left"></i>

                        </div>

                    </div>

                    <small class="text-success mt-3 d-block">

                        <i class="bi bi-arrow-up"></i>

                        12.5% bulan ini

                    </small>

                </div>

            </div>


            <!-- Expense -->

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4 h-100">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted mb-2">
                                Expense
                            </p>

                            <div class="summary-value">
                                Rp 4.250.000
                            </div>

                        </div>

                        <div class="summary-icon icon-expense">

                            <i class="bi bi-arrow-up-right"></i>

                        </div>

                    </div>

                    <small class="text-danger mt-3 d-block">

                        <i class="bi bi-arrow-up"></i>

                        4.8% bulan ini

                    </small>

                </div>

            </div>


            <!-- Savings -->

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="summary-card p-4 h-100">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <p class="text-muted mb-2">
                                Savings
                            </p>

                            <div class="summary-value">
                                Rp 8.250.000
                            </div>

                        </div>

                        <div class="summary-icon icon-saving">

                            <i class="bi bi-piggy-bank"></i>

                        </div>

                    </div>

                    <small class="text-muted mt-3 d-block">

                        66% dari income

                    </small>

                </div>

            </div>

        </div>


        <!-- Charts -->

        <div class="row g-4 mb-4">

            <!-- Income Expense Chart -->

            <div class="col-lg-8">

                <div class="dashboard-card p-4 h-100">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h5 class="card-title-custom mb-1">
                                Income vs Expense
                            </h5>

                            <small class="text-muted">
                                Performa keuangan 6 bulan terakhir
                            </small>

                        </div>

                        <select class="form-select form-select-sm w-auto">

                            <option>
                                6 Months
                            </option>

                            <option>
                                12 Months
                            </option>

                        </select>

                    </div>

                    <div style="height: 280px;" class="d-flex align-items-center justify-content-center">

                        <div class="text-center text-muted">

                            <i class="bi bi-bar-chart fs-1"></i>

                            <p class="mt-2 mb-0">
                                Chart akan dihubungkan ke data Laravel.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Spending -->

            <div class="col-lg-4">

                <div class="dashboard-card p-4 h-100">

                    <h5 class="card-title-custom mb-1">
                        Spending by Category
                    </h5>

                    <small class="text-muted">
                        Pengeluaran bulan ini
                    </small>

                    <div class="mt-4">

                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Food
                                </span>

                                <span class="fw-semibold">
                                    Rp 1.250.000
                                </span>

                            </div>

                            <div class="progress">

                                <div class="progress-bar" style="width: 65%"></div>

                            </div>

                        </div>


                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Transport
                                </span>

                                <span class="fw-semibold">
                                    Rp 750.000
                                </span>

                            </div>

                            <div class="progress">

                                <div class="progress-bar" style="width: 40%"></div>

                            </div>

                        </div>


                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Shopping
                                </span>

                                <span class="fw-semibold">
                                    Rp 500.000
                                </span>

                            </div>

                            <div class="progress">

                                <div class="progress-bar" style="width: 27%"></div>

                            </div>

                        </div>


                        <div>

                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Others
                                </span>

                                <span class="fw-semibold">
                                    Rp 250.000
                                </span>

                            </div>

                            <div class="progress">

                                <div class="progress-bar" style="width: 15%"></div>

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

                <div class="dashboard-card p-4">

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <div>

                            <h5 class="card-title-custom mb-1">
                                Recent Transactions
                            </h5>

                            <small class="text-muted">
                                Aktivitas keuangan terbaru
                            </small>

                        </div>

                        <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-light border">
                            View All
                        </a>

                    </div>


                    <!-- Transaction 1 -->

                    <div class="transaction-item">

                        <div class="d-flex align-items-center">

                            <div class="transaction-icon transaction-expense me-3">

                                <i class="bi bi-cart3"></i>

                            </div>

                            <div class="flex-grow-1">

                                <div class="fw-semibold">
                                    Groceries
                                </div>

                                <small class="text-muted">
                                    Food · Today
                                </small>

                            </div>

                            <div class="text-end">

                                <div class="fw-semibold text-danger">
                                    - Rp 250.000
                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Transaction 2 -->

                    <div class="transaction-item">

                        <div class="d-flex align-items-center">

                            <div class="transaction-icon transaction-income me-3">

                                <i class="bi bi-cash-stack"></i>

                            </div>

                            <div class="flex-grow-1">

                                <div class="fw-semibold">
                                    Salary
                                </div>

                                <small class="text-muted">
                                    Income · Yesterday
                                </small>

                            </div>

                            <div class="text-end">

                                <div class="fw-semibold text-success">
                                    + Rp 5.000.000
                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Transaction 3 -->

                    <div class="transaction-item">

                        <div class="d-flex align-items-center">

                            <div class="transaction-icon transaction-expense me-3">

                                <i class="bi bi-bus-front"></i>

                            </div>

                            <div class="flex-grow-1">

                                <div class="fw-semibold">
                                    Transport
                                </div>

                                <small class="text-muted">
                                    Transport · 2 days ago
                                </small>

                            </div>

                            <div class="text-end">

                                <div class="fw-semibold text-danger">
                                    - Rp 50.000
                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Transaction 4 -->

                    <div class="transaction-item">

                        <div class="d-flex align-items-center">

                            <div class="transaction-icon transaction-expense me-3">

                                <i class="bi bi-cup-hot"></i>

                            </div>

                            <div class="flex-grow-1">

                                <div class="fw-semibold">
                                    Coffee
                                </div>

                                <small class="text-muted">
                                    Food · 3 days ago
                                </small>

                            </div>

                            <div class="text-end">

                                <div class="fw-semibold text-danger">
                                    - Rp 35.000
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Quick Actions -->

            <div class="col-lg-4">

                <div class="dashboard-card p-4">

                    <h5 class="card-title-custom mb-1">
                        Quick Actions
                    </h5>

                    <small class="text-muted">
                        Akses cepat
                    </small>

                    <div class="mt-4">

                        <a href="{{ route('transaction.create') }}" class="quick-action mb-3">

                            <div class="d-flex align-items-center">

                                <div class="quick-action-icon me-3">

                                    <i class="bi bi-plus-lg"></i>

                                </div>

                                <div>

                                    <div class="fw-semibold">
                                        Add Transaction
                                    </div>

                                    <small class="text-muted">
                                        Catat transaksi baru
                                    </small>

                                </div>

                            </div>

                        </a>


                        <a href="{{ route('categories.create') }}" class="quick-action mb-3">

                            <div class="d-flex align-items-center">

                                <div class="quick-action-icon me-3">

                                    <i class="bi bi-tags"></i>

                                </div>

                                <div>

                                    <div class="fw-semibold">
                                        Add Category
                                    </div>

                                    <small class="text-muted">
                                        Buat category baru
                                    </small>

                                </div>

                            </div>

                        </a>


                        <a href="{{ route('transaction.index') }}" class="quick-action">

                            <div class="d-flex align-items-center">

                                <div class="quick-action-icon me-3">

                                    <i class="bi bi-list-ul"></i>

                                </div>

                                <div>

                                    <div class="fw-semibold">
                                        Transactions
                                    </div>

                                    <small class="text-muted">
                                        Lihat semua transaksi
                                    </small>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
