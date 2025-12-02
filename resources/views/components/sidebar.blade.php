<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Self Auto</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <!-- Dashboard -->
            <li class="nav-item dropdown">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-dashboard"></i><span>Dashboard</span>
                </a>
            </li>

            <!-- Customers -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Pelanggan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            <i class="fas fa-user"></i><span>Data Pelanggan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Vehicle -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-car-side"></i><span>Kendaraan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-car-rear"></i><span>Data Master</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Spareparts -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-gears"></i><span>Spareparts</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-tags"></i><span>Kategori</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-gears"></i><span>Data Spareparts</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-boxes-stacked"></i><span>Stok Spareparts</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Layanan -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-wrench"></i><span>Servis</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-screwdriver-wrench"></i><span>Data Servis</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-truck-medical"></i><span>Darurat</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Teknisi -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-user-gear"></i><span>Teknisi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-list"></i><span>Data Teknisi</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-line"></i><span>Laporan Kinerja</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Users -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link"><i class="fas fa-users-gear"></i><span>Pengguna</span></a>
            </li>

            <!-- Penjualan -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link"><i class="fas fa-cart-shopping"></i><span>Penjualan</span></a>
            </li>

            <!-- Laporan -->
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-chart-bar"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-file-invoice-dollar"></i><span>Penjualan</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-file-lines"></i><span>Servis</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-boxes-stacked"></i><span>Stok</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>