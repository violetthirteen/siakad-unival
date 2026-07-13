<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIAKAD - Universitas Al-Khairiyah')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <img src="/images/logo.jpg" alt="Unival" height="38" class="rounded">
                <div>
                    <div class="fw-bold lh-1">Universitas Al-Khairiyah</div>
                    <small class="fw-normal opacity-75 d-block" style="font-size: 0.6rem; letter-spacing: 0.3px;">Sistem Informasi Akademik</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profil-kampus') ? 'active' : '' }}" href="{{ route('profil-kampus') }}">Profil Kampus</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('akademik.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                            Akademik
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('akademik.program-studi') }}">Program Studi</a></li>
                            <li><a class="dropdown-item" href="{{ route('akademik.kalender') }}">Kalender Akademik</a></li>
                            <li><a class="dropdown-item" href="{{ route('akademik.jadwal-kuliah') }}">Jadwal Kuliah</a></li>
                            <li><a class="dropdown-item" href="{{ route('akademik.informasi') }}">Informasi Akademik</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pengumuman*') ? 'active' : '' }}" href="{{ route('pengumuman') }}">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            @if(auth()->user()->isAdminFakultas()) Dashboard Fakultas @else Dashboard @endif
                        </a>
                    </li>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-decoration-none" style="color: rgba(255,255,255,0.75);">Logout</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-md-5">
                    <div class="d-flex align-items-center gap-2 mb-2">
                <img src="/images/logo.jpg" alt="Unival" height="38" class="rounded">
                        <div>
                            <div class="fw-bold lh-1 text-white">Universitas Al-Khairiyah</div>
                            <small class="text-white-50" style="font-size: 0.7rem;">Sistem Informasi Akademik</small>
                        </div>
                    </div>
                    <p class="small text-white-50 mb-0">Portal akademik terintegrasi untuk mendukung kegiatan perkuliahan, administrasi akademik, dan layanan kemahasiswaan secara digital.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold small text-white">Tautan</h6>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-1"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none hover-gold">Beranda</a></li>
                        <li class="mb-1"><a href="{{ route('profil-kampus') }}" class="text-white-50 text-decoration-none hover-gold">Profil Kampus</a></li>
                        <li class="mb-1"><a href="{{ route('pengumuman') }}" class="text-white-50 text-decoration-none hover-gold">Pengumuman</a></li>
                        <li class="mb-1"><a href="{{ route('kontak') }}" class="text-white-50 text-decoration-none hover-gold">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold small text-white">Kontak</h6>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-1">Jl. Raya Cilegon, Banten</li>
                        <li class="mb-1">(0254) 123456</li>
                        <li class="mb-1">info@unival.ac.id</li>
                    </ul>
                </div>
            </div>
            <hr class="my-3" style="border-color: var(--glass-border);">
            <p class="text-center text-white-50 small mb-0">&copy; {{ date('Y') }} Universitas Al-Khairiyah. All rights reserved.</p>
        </div>
    </footer>

    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
