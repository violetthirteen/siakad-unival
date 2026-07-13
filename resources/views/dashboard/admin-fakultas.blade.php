@extends('layouts.admin')

@section('title', 'Dashboard ' . ($fakultas->nama_fakultas ?? 'Fakultas') . ' - SIAKAD Unival')

@section('content')
<div class="admin-dashboard">
    <div class="admin-dash-header">
        <div>
            <h1 class="admin-dash-title">Dashboard {{ $fakultas->nama_fakultas ?? 'Fakultas' }}</h1>
            <p class="admin-dash-subtitle">Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>
        </div>
        <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
            <span class="admin-badge-fakultas">
                <i class="bi bi-building me-1"></i> {{ $fakultas->nama_fakultas ?? '-' }}
            </span>
            <span class="admin-dash-date">
                <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
            </span>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #0B2A6F, #123C96);">
                    <i class="bi bi-book"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">Program Studi</span>
                    <span class="stat-card-premium-value">{{ $totalProdi }}</span>
                </div>
            </div>
            <div class="stat-card-premium-footer">
                <a href="{{ route('admin.program-studi.index') }}">Lihat Data <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">Dosen</span>
                    <span class="stat-card-premium-value">{{ $totalDosen }}</span>
                </div>
            </div>
            <div class="stat-card-premium-footer">
                <a href="{{ route('admin.dosen.index') }}">Lihat Data <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #0B2A6F, #123C96);">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">Mahasiswa</span>
                    <span class="stat-card-premium-value">{{ $totalMahasiswa }}</span>
                </div>
            </div>
            <div class="stat-card-premium-footer">
                <a href="{{ route('admin.mahasiswa.index') }}">Lihat Data <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">Mata Kuliah</span>
                    <span class="stat-card-premium-value">{{ $totalMatakuliah }}</span>
                </div>
            </div>
            <div class="stat-card-premium-footer">
                <a href="{{ route('admin.mata-kuliah.index') }}">Lihat Data <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #0B2A6F, #123C96);">
                    <i class="bi bi-table"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">Jadwal</span>
                    <span class="stat-card-premium-value">{{ $totalJadwal }}</span>
                </div>
            </div>
            <div class="stat-card-premium-footer">
                <a href="{{ route('admin.jadwal.index') }}">Lihat Data <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                    <i class="bi bi-card-checklist"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">KRS</span>
                    <span class="stat-card-premium-value">{{ $totalKrs }}</span>
                </div>
            </div>
            <div class="stat-card-premium-footer">
                @if(Route::has('admin.krs.index'))
                <a href="{{ route('admin.krs.index') }}">Lihat Data <i class="bi bi-arrow-right"></i></a>
                @else
                <span style="opacity: 0.5;">Modul belum tersedia</span>
                @endif
            </div>
        </div>
    </div>

    <div class="dash-section" style="margin-bottom: 1.25rem;">
        <div class="dash-section-header">
            <h2 class="dash-section-title"><i class="bi bi-lightning-charge-fill me-2" style="color: #D4AF37;"></i>Aksi Cepat</h2>
        </div>
        <div class="quick-action-grid">
            <a href="{{ route('admin.mahasiswa.create') }}" class="quick-action-btn">
                <span class="quick-action-icon" style="background: linear-gradient(135deg, #0B2A6F, #123C96);">
                    <i class="bi bi-person-plus-fill"></i>
                </span>
                <span class="quick-action-label">Tambah Mahasiswa</span>
            </a>
            <a href="{{ route('admin.dosen.create') }}" class="quick-action-btn">
                <span class="quick-action-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                    <i class="bi bi-person-plus-fill"></i>
                </span>
                <span class="quick-action-label">Tambah Dosen</span>
            </a>
            <a href="{{ route('admin.mata-kuliah.create') }}" class="quick-action-btn">
                <span class="quick-action-icon" style="background: linear-gradient(135deg, #0B2A6F, #123C96);">
                    <i class="bi bi-journal-plus"></i>
                </span>
                <span class="quick-action-label">Tambah Mata Kuliah</span>
            </a>
            <a href="{{ route('admin.jadwal.create') }}" class="quick-action-btn">
                <span class="quick-action-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                    <i class="bi bi-calendar-plus"></i>
                </span>
                <span class="quick-action-label">Tambah Jadwal</span>
            </a>
        </div>
    </div>
</div>
@endsection
