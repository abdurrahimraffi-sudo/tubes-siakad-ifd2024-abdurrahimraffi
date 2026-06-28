<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIAKAD') - Sistem Informasi Akademik</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563EB;
            --primary-dark: #1E40AF;
            --primary-light: #DBEAFE;
            --secondary: #1E40AF;
            --bg: #F8FAFC;
            --card-radius: 20px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 30px rgba(0,0,0,0.10);
            --sidebar-width: 260px;
        }

        [data-bs-theme="dark"] {
            --bg: #0F172A;
            --primary-light: #1E3A8A;
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background-color: var(--bg);
            color: #1E293B;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        [data-bs-theme="dark"] body { color: #E2E8F0; }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        .sidebar-header small {
            opacity: 0.8;
            font-size: 0.75rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-menu .menu-section {
            padding: 0.75rem 1.25rem 0.25rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
            font-weight: 600;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.25rem;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: rgba(255,255,255,0.5);
        }

        .sidebar-menu a.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: white;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin 0.3s ease;
        }

        .navbar-top {
            background: white;
            box-shadow: var(--shadow-sm);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid #E2E8F0;
        }

        [data-bs-theme="dark"] .navbar-top {
            background: #1E293B;
            border-bottom-color: #334155;
        }

        .content-wrapper {
            padding: 1.5rem;
        }

        .card {
            border: none;
            border-radius: var(--card-radius);
            box-shadow: var(--shadow-md);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card {
            border-radius: var(--card-radius);
            overflow: hidden;
            position: relative;
        }

        .stat-card .stat-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 5rem;
            opacity: 0.1;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            opacity: 0.8;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .text-primary { color: var(--primary) !important; }
        .bg-primary { background-color: var(--primary) !important; }

        .table thead th {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        [data-bs-theme="dark"] .table thead th {
            background-color: #1E3A8A;
            color: #DBEAFE;
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table-hover tbody tr:hover {
            background-color: var(--primary-light);
        }

        [data-bs-theme="dark"] .table-hover tbody tr:hover {
            background-color: #1E3A8A;
        }

        .page-link {
            color: var(--primary);
            border-radius: 8px;
            margin: 0 2px;
            border: none;
        }

        .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }

        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        [data-bs-theme="dark"] .loading-overlay { background: rgba(15,23,42,0.7); }

        .loading-overlay.show { display: flex; }

        .spinner-border-lg {
            width: 3rem;
            height: 3rem;
        }

        .theme-toggle {
            border: none;
            background: transparent;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .theme-toggle:hover { background: rgba(0,0,0,0.05); }

        [data-bs-theme="dark"] .theme-toggle:hover { background: rgba(255,255,255,0.1); }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.4rem 0.75rem;
            border-radius: 50px;
            transition: background 0.2s;
        }

        .user-dropdown:hover { background: rgba(0,0,0,0.05); }
        [data-bs-theme="dark"] .user-dropdown:hover { background: rgba(255,255,255,0.1); }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.3rem;
            color: var(--primary);
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-toggle { display: block; }
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .sidebar-backdrop.show { display: block; }

        @media (max-width: 991.98px) {
            .sidebar-backdrop.show { display: block; }
        }

        .fade-in {
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="text-center">
            <div class="spinner-border spinner-border-lg text-primary" role="status"></div>
            <p class="mt-3 text-muted">Memuat data...</p>
        </div>
    </div>

    @if(!str_starts_with(request()->path(), 'login'))
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-graduation-cap me-2"></i> SIAKAD</h4>
            <small>Sistem Informasi Akademik</small>
        </div>
        <nav class="sidebar-menu">
            @if(auth()->user()->role === 'admin')
                <div class="menu-section">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <div class="menu-section">Data Master</div>
                <a href="{{ route('admin.dosen.index') }}" class="{{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher"></i> Data Dosen
                </a>
                <a href="{{ route('admin.mahasiswa.index') }}" class="{{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i> Data Mahasiswa
                </a>
                <a href="{{ route('admin.mata-kuliah.index') }}" class="{{ request()->routeIs('admin.mata-kuliah.*') ? 'active' : '' }}">
                    <i class="fas fa-book"></i> Mata Kuliah
                </a>
                <a href="{{ route('admin.jadwal.index') }}" class="{{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Jadwal
                </a>
                <div class="menu-section">Akademik</div>
                <a href="{{ route('admin.krs.index') }}" class="{{ request()->routeIs('admin.krs.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> Data KRS
                </a>
            @else
                <div class="menu-section">Menu Utama</div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="{{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <div class="menu-section">Akademik</div>
                <a href="{{ route('mahasiswa.jadwal.index') }}" class="{{ request()->routeIs('mahasiswa.jadwal.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Jadwal Kuliah
                </a>
                <a href="{{ route('mahasiswa.krs.index') }}" class="{{ request()->routeIs('mahasiswa.krs.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> KRS Saya
                </a>
            @endif
        </nav>
    </aside>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar Top -->
        <nav class="navbar-top d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <button class="mobile-toggle" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 fw-bold text-primary d-none d-md-block">@yield('title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                    <i class="fas fa-moon"></i>
                </button>
                <div class="dropdown">
                    <div class="user-dropdown" data-bs-toggle="dropdown">
                        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div class="d-none d-md-block">
                            <div class="fw-semibold" style="font-size: 0.85rem; line-height: 1.2;">{{ auth()->user()->name }}</div>
                            <small class="text-muted text-capitalize">{{ auth()->user()->role }}</small>
                        </div>
                        <i class="fas fa-chevron-down text-muted small"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="px-3 py-2 border-bottom">
                            <small class="text-muted">Login sebagai</small>
                            <div class="fw-semibold text-capitalize">{{ auth()->user()->role }}</div>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="content-wrapper fade-in">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    @else
        @yield('content')
    @endif

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        // Dark Mode Toggle
        const html = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-bs-theme', savedTheme);
        if (themeToggle) {
            themeToggle.innerHTML = savedTheme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            themeToggle.addEventListener('click', () => {
                const current = html.getAttribute('data-bs-theme');
                const next = current === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-bs-theme', next);
                localStorage.setItem('theme', next);
                themeToggle.innerHTML = next === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            });
        }

        // Mobile Sidebar
        const mobileToggle = document.getElementById('mobileToggle');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('show');
            });
            backdrop.addEventListener('click', () => {
                sidebar.classList.remove('show');
                backdrop.classList.remove('show');
            });
        }

        // Loading overlay
        window.showLoading = () => document.getElementById('loadingOverlay').classList.add('show');
        window.hideLoading = () => document.getElementById('loadingOverlay').classList.remove('show');

        // Confirm delete with SweetAlert
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form[data-confirm]').forEach(form => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin?',
                        text: form.dataset.confirm || 'Data yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            showLoading();
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
