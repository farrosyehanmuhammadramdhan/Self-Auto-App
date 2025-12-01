<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-gauge-high"></i><span>Dashboard</span></a></li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Pelanggan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('costumers.index') }}"><i class="fas fa-user"></i><span>Data Pelanggan</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-car-side"></i><span>Kendaraan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-car"></i><span>Data Kendaraan</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-gears"></i><span>Sparepart</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-tags"></i><span>Kategori</span></a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-gear"></i><span>Data Sparepart</span></a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-boxes-stacked"></i><span>Stok Spareparts</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-wrench"></i><span>Layanan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-car-battery"></i><span>Master Service</span></a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-screwdriver-wrench"></i><span>Data Service</span></a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-cart-shopping"></i><span>Penjualan</span></a></li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-user-gear"></i><span>Mekanik</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-list"></i><span>Data Mekanik</span></a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-chart-line"></i><span>Laporan Mekanik</span></a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}"><a class="nav-link" href="#"><i class="fas fa-users-gear"></i><span>Karyawan</span></a></li>

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-chart-bar"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar"></i><span>Penjualan</span></a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Servis</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-boxes-stacked"></i><span>Stok</span></a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#"><i class="fas fa-file-export"></i><span>Export Penjualan</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>