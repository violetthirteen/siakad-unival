@php
    $route = request()->route()->getName();
    $user = auth()->user();
    $isSA = $user && $user->isSuperAdmin();
    $isAF = $user && $user->isAdminFakultas();
    $isAP = $user && $user->isAdminProdi();
    $isMhs = $user && $user->isMahasiswa();
@endphp
<div class="sidebar-menu">
    <div class="sidebar-section-label">Menu Utama</div>

    <a href="{{ route('dashboard') }}" class="sidebar-item {{ $route == 'dashboard' ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-grid-1x2-fill"></i></span>
        <span class="sidebar-text">Dashboard</span>
    </a>

    @if($isSA)
    <div class="sidebar-section-label">Master Data</div>

    <a href="{{ route('admin.fakultas.index') }}" class="sidebar-item {{ str_contains($route, 'fakultas') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-building"></i></span>
        <span class="sidebar-text">Fakultas</span>
    </a>
    @endif

    @if(!$isMhs)
    <a href="{{ route('admin.program-studi.index') }}" class="sidebar-item {{ str_contains($route, 'program-studi') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-book"></i></span>
        <span class="sidebar-text">Program Studi</span>
    </a>
    @endif

    @if($isSA)
    <a href="{{ route('admin.tahun-ajaran.index') }}" class="sidebar-item {{ str_contains($route, 'tahun-ajaran') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-calendar-event"></i></span>
        <span class="sidebar-text">Tahun Ajaran</span>
    </a>

    <a href="{{ route('admin.semester.index') }}" class="sidebar-item {{ str_contains($route, 'semester') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-layers"></i></span>
        <span class="sidebar-text">Semester</span>
    </a>
    @endif

    @if($isMhs)
    <div class="sidebar-section-label">Akademik</div>

    <a href="{{ route('mahasiswa.jadwal') }}" class="sidebar-item {{ str_contains($route, 'mahasiswa.jadwal') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-table"></i></span>
        <span class="sidebar-text">Jadwal</span>
    </a>

    <a href="{{ route('mahasiswa.krs.index') }}" class="sidebar-item {{ str_contains($route, 'mahasiswa.krs') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-card-checklist"></i></span>
        <span class="sidebar-text">KRS</span>
    </a>

    <a href="{{ route('mahasiswa.nilai') }}" class="sidebar-item {{ str_contains($route, 'mahasiswa.nilai') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-award"></i></span>
        <span class="sidebar-text">Nilai</span>
    </a>
    @endif

    @if(!$isMhs)
    <div class="sidebar-section-label">Akademik</div>

    <a href="{{ route('admin.mahasiswa.index') }}" class="sidebar-item {{ str_contains($route, 'admin.mahasiswa') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-people-fill"></i></span>
        <span class="sidebar-text">Mahasiswa</span>
    </a>

    <a href="{{ route('admin.dosen.index') }}" class="sidebar-item {{ str_contains($route, 'admin.dosen') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-person-badge"></i></span>
        <span class="sidebar-text">Dosen</span>
    </a>

    <a href="{{ route('admin.mata-kuliah.index') }}" class="sidebar-item {{ str_contains($route, 'mata-kuliah') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-journal-text"></i></span>
        <span class="sidebar-text">Mata Kuliah</span>
    </a>

    @if($isSA || $isAF || $isAP)
    <a href="{{ route('admin.ruangan.index') }}" class="sidebar-item {{ str_contains($route, 'ruangan') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-door-open"></i></span>
        <span class="sidebar-text">Ruangan</span>
    </a>
    @endif

    <a href="{{ route('admin.jadwal.index') }}" class="sidebar-item {{ str_contains($route, 'admin.jadwal') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-table"></i></span>
        <span class="sidebar-text">Jadwal</span>
    </a>

    <a href="{{ route('admin.krs.index') }}" class="sidebar-item {{ str_contains($route, 'admin.krs') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-card-checklist"></i></span>
        <span class="sidebar-text">KRS</span>
    </a>

    <a href="{{ route('admin.nilai.index') }}" class="sidebar-item {{ str_contains($route, 'nilai') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-award"></i></span>
        <span class="sidebar-text">Nilai</span>
    </a>
    @endif

    @if($isSA)
    <div class="sidebar-section-label">Konten</div>

    <a href="{{ route('admin.galeri.index') }}" class="sidebar-item {{ str_contains($route, 'galeri') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-images"></i></span>
        <span class="sidebar-text">Galeri</span>
    </a>

    <a href="{{ route('admin.buku-tamu.index') }}" class="sidebar-item {{ str_contains($route, 'buku-tamu') ? 'active' : '' }}">
        <span class="sidebar-icon"><i class="bi bi-journal-bookmark-fill"></i></span>
        <span class="sidebar-text">Buku Tamu</span>
    </a>
    @endif
</div>
