<header class="header">
    <div class="header-content">
        <h1>NajaTrip</h1>
        <p>Open Trip Banyuwangi - Bali</p>
    </div>
</header>

<nav class="navbar">
    <div class="nav-logo">
        <img src="{{ asset('logo.png') }}" alt="Logo NajaTrip" class="nav-logo-img">
        NajaTrip
    </div>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('detail') }}" class="{{ request()->routeIs('detail') ? 'active' : '' }}">
            <i class="fas fa-info-circle"></i> Detail
        </a>
        <a href="{{ route('transaksi') }}" class="{{ request()->routeIs('transaksi') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i> Transaksi
        </a>
        <a href="{{ route('daftar') }}" class="{{ request()->routeIs('daftar') ? 'active' : '' }}">
            <i class="fas fa-list"></i> Daftar
        </a>
    </div>
</nav>
