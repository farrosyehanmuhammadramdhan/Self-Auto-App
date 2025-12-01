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
            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('costumers.index') }}">
                    <i class="fas fa-user"></i>
                    <span>Customer Data</span>
                </a>
            </li>
            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('master-vehicles.index') }}">
                    <i class="fas fa-car"></i>
                    <span>Vehicle Data</span>
                </a>
            </li>


            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Spareparts</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Company</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-wrench"></i>
                    <span>Services</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-car-battery"></i>
                            <span>Master Service</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-screwdriver-wrench"></i>
                            <span>Service Data</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-cart-shopping"></i>
                    <span>Sales</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-user-gear"></i>
                    <span>Mechanics</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-list"></i>
                            <span>Mechanic Data</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-line"></i>
                            <span>Mechanic Report</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-users-gear"></i>
                    <span>Employees</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span>Sales</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-boxes-stacked"></i>
                            <span>Stock</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file-export"></i>
                            <span>Export Sales</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>