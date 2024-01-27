@php
    $routeActive = Route::currentRouteName();
@endphp

<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
    </a>
</li>
@if(auth()->user()->role == 'admin')
<li class="nav-item">
    <a class="nav-link {{ $routeActive == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i class="fas fa-user-check"></i>
        <span class="nav-link-text">Users</span>
    </a>
</li>
@endif

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('pelanggan.index') ? 'active' : '' }}" href="{{ route('pelanggan.index') }}">
        <i class="fas fa-users text-primary"></i>
        <span class="nav-link-text">Pelanggan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('produk.index') ? 'active' : '' }}" href="{{ route('produk.index') }}">
        <i class="fas fa-box text-success"></i>
        <span class="nav-link-text">Produk</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('penjualan.penjualan') ? 'active' : '' }}" href="{{ route('penjualan.penjualan') }}">
        <i class="fas fa-archive text-success"></i>
        <span class="nav-link-text">Penjualan</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('detail_penjualan.index') ? 'active' : '' }}" href="{{ route('detail_penjualan.index') }}">
    <i class="fas fa-file"></i>
        <span class="nav-link-text">Detail Penjualan</span>
    </a>
</li>
<!-- 
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('detail_penjualan.index') ? 'active' : '' }}" href="{{ route('detail_penjualan.index') }}">
        <i class="fas fa-file-text"></i>
        <span class="nav-link-text">Detail Penjualan</span>
    </a>
</li> -->
@if(auth()->user()->role == 'petugas')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('penjualan.index') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">
        <i class="fas fa-shopping-cart text-success"></i>
        <span class="nav-link-text">Transaksi</span>
    </a>
</li>
@endif
