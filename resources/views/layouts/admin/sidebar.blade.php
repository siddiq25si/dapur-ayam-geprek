<aside class="sidebar-admin p-3 d-flex flex-column justify-content-between" id="adminSidebar">
    <div>
        <!-- Brand Header -->
        <div class="d-flex align-items-center justify-content-between px-2 py-3 mb-3 border-bottom border-secondary border-opacity-25">
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none d-flex align-items-center gap-2">
                <span class="fs-3">🍗</span>
                <div>
                    <div class="fw-bold lh-1">Dapur Geprek</div>
                    <small class="text-warning" style="font-size: 0.72rem;">Admin Panel</small>
                </div>
            </a>
            <button class="btn btn-sm btn-outline-light d-lg-none" id="closeSidebar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Menu Navigasi dengan Logika Active Menu -->
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route::has('admin.menu.index') ? route('admin.menu.index') : '#' }}"
                   class="nav-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> Manajemen Menu
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route::has('admin.pesanan.index') ? route('admin.pesanan.index') : '#' }}"
                   class="nav-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                    <i class="bi bi-bag-check"></i> Kelola Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route::has('admin.pelanggan.index') ? route('admin.pelanggan.index') : '#' }}"
                   class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Pelanggan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ Route::has('admin.pengaturan.index') ? route('admin.pengaturan.index') : '#' }}"
                   class="nav-link {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> Pengaturan Toko
                </a>
            </li>
        </ul>
    </div>

    <!-- Bagian Bawah Sidebar -->
    <div class="pt-3 border-top border-secondary border-opacity-25">
        <a href="{{ route('home') }}" class="nav-link text-info mb-2">
            <i class="bi bi-globe"></i> Lihat Halaman Depan
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 btn-sm py-2">
                <i class="bi bi-box-arrow-left me-1"></i> Keluar (Logout)
            </button>
        </form>
    </div>
</aside>