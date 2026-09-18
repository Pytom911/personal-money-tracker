<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Finance Tracker</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Sidebar (Desktop) -->
    <aside class="sidebar d-none d-lg-flex flex-column">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <span class="sidebar-brand-icon"><i class="bi bi-layers-fill"></i></span>
            <span class="sidebar-brand-text">
                Finance Tracker
                <small>Personal Finance</small>
            </span>
        </a>

        <div class="sidebar-body">
            @include('layouts.partials.sidebar-nav')
        </div>

        <div class="sidebar-footer">
            {{-- <div class="sidebar-mini-card">
                <div class="d-flex align-items-center gap-2">
                    <div class="sidebar-avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="flex-grow-1">
                        <div class="sidebar-user-name">My Budget</div>
                        <small class="text-secondary">Personal Finance Tracker</small>
                    </div>
                </div>
            </div> --}}
        </div>
    </aside>

    <!-- Mobile Offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-offcanvas" tabindex="-1" id="mobileSidebar"
        aria-labelledby="mobileSidebarLabel">
        <div class="offcanvas-header border-bottom border-light-subtle">
            <a class="sidebar-brand mb-0" href="{{ route('dashboard') }}">
                <span class="sidebar-brand-icon"><i class="bi bi-layers-fill"></i></span>
                <span class="sidebar-brand-text">
                    Finance Tracker
                    <small>Personal Finance</small>
                </span>
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="sidebar-body">
                @include('layouts.partials.sidebar-nav')
            </div>
        </div>
    </div>

    <!-- Topbar -->
    <header class="topbar d-flex align-items-center">
        <button class="topbar-toggle d-lg-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
            <i class="bi bi-list"></i>
        </button>

        <div class="topbar-title d-none d-sm-block">
            @yield('title', 'Dashboard')
        </div>

        {{-- <div class="ms-auto d-flex align-items-center gap-2">
            <button class="topbar-icon-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar"
                aria-controls="mobileSidebar" title="Menu">
                <i class="bi bi-person-circle"></i>
            </button>
        </div> --}}
    </header>

    <!-- Main -->
    <main class="main-content">
        @yield('content')
    </main>

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
