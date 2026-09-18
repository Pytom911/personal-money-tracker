<ul class="sidebar-nav list-unstyled mb-0">
    <li class="sidebar-group-label">Menu</li>

    <li>
        <a class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a class="sidebar-link {{ request()->routeIs('analytics') ? 'active' : '' }}" href="{{ route('analytics') }}">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Analytics</span>
        </a>
    </li>

    <li>
        <a class="sidebar-link {{ request()->routeIs('transaction.*') ? 'active' : '' }}" href="{{ route('transaction.index') }}">
            <i class="bi bi-arrow-left-right"></i>
            <span>Transactions</span>
        </a>
    </li>

    <li>
        <a class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
            <i class="bi bi-tags-fill"></i>
            <span>Categories</span>
        </a>
    </li>

    <li class="sidebar-group-label mt-4">Goals</li>

    <li>
        <a class="sidebar-link {{ request()->routeIs('wishlist.*') ? 'active' : '' }}" href="{{ route('wishlist.index') }}">
            <i class="bi bi-gift-fill"></i>
            <span>Wishlist</span>
        </a>
    </li>

    <li>
        <a class="sidebar-link {{ request()->routeIs('wishlistDeposit.*') ? 'active' : '' }}" href="{{ route('wishlistDeposit.index') }}">
            <i class="bi bi-piggy-bank-fill"></i>
            <span>Wishlist Deposit</span>
        </a>
    </li>
</ul>