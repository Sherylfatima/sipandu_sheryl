<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="APM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{Request::is('dashboard*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/masyarakat" class="nav-link {{Request::is('masyarakat*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Masyarakat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pegawai" class="nav-link {{Request::is('pegawai*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kategori" class="nav-link {{Request::is('kategori*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kategori Pengaduan
                        </p>
                    </a>
                </li>
                <li class="nav-header">LAPORAN</li>
                <li class="nav-item">
                    <a href="/laporanmasuk" class="nav-link {{Request::is('laporanmasuk*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Laporan Masuk
                        </p>
                    </a>
                </li>
                <li class="nav-header">Report</li>
                <li class="nav-item">
                    <a href="/generatereport" class="nav-link {{Request::is('generatereport*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Generate Report
                        </p>
                    </a>
                </li>
                <li class="nav-header">Account</li>
                <li class="nav-item">
                    <a href="{{ route('admin.profile.index') }}" class="nav-link {{Request::is('admin/profile*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <form action="{{ route('logoutadmin') }}" method="POST" style="display: flex; justify-content: center;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-md" style="padding: 8px 83px;">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
