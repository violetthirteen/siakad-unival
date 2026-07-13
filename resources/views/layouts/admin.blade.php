<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - SIAKAD Unival')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="admin-page">
    <div class="admin-layout">
        <header class="admin-topbar">
            <div class="admin-topbar-inner">
                <button class="admin-sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <a class="admin-topbar-brand" href="{{ route('dashboard') }}">
                    <img src="/images/logo.jpg" alt="Unival" height="32" class="rounded">
                    <div class="admin-brand-text">
                        <span class="admin-brand-name">Universitas Al-Khairiyah</span>
                        <span class="admin-brand-sub">Sistem Informasi Akademik</span>
                    </div>
                </a>
                <div class="admin-topbar-right">
                    <div class="admin-profile-dropdown dropdown">
                        <button class="admin-profile-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="admin-profile-info">
                                <span class="admin-profile-name">{{ auth()->user()->name }}</span>
                                <span class="admin-profile-role">
                                    @php
                                        $roleLabels = [
                                            'super_admin' => 'Super Admin',
                                            'admin_fakultas' => 'Admin ' . (auth()->user()->fakultas->nama_fakultas ?? 'Fakultas'),
                                            'admin_prodi' => 'Kaprodi ' . (auth()->user()->fakultas->nama_fakultas ?? ''),
                                            'dosen' => 'Dosen',
                                            'mahasiswa' => 'Mahasiswa',
                                        ];
                                    @endphp
                                    {{ $roleLabels[auth()->user()->role] ?? auth()->user()->role }}
                                </span>
                            </div>
                            <div class="admin-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span class="dropdown-item-text small text-white-50">{{ auth()->user()->email }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ url('/') }}"><i class="bi bi-house-door me-2"></i>Website</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="admin-body">
            <aside class="admin-sidebar" id="adminSidebar">
                <nav class="admin-sidebar-nav">
                    @include('partials.sidebar')
                </nav>
                <div class="admin-sidebar-footer">
                    <span class="sidebar-version">v1.0 &mdash; SIAKAD Unival</span>
                </div>
            </aside>
            <div class="admin-sidebar-overlay" id="sidebarOverlay"></div>

            <main class="admin-content">
                @if(session('success'))
                    <div class="alert-modern alert-success" id="adminAlert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert-modern alert-danger" id="adminAlert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');

        if (toggle && sidebar && overlay) {
            toggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
                document.body.classList.toggle('sidebar-open');
            });
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.classList.remove('sidebar-open');
            });
        }

        setTimeout(function() {
            document.querySelectorAll('.alert-modern').forEach(function(el) {
                el.style.opacity = '0';
                setTimeout(function() { el.remove(); }, 400);
            });
        }, 5000);
    });
    </script>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
