@extends('layouts.admin')

@section('title', 'Dashboard Admin - SIAKAD Unival')

@section('content')
<div class="admin-dashboard">
    <div class="admin-dash-header">
        <div>
            <h1 class="admin-dash-title">Dashboard</h1>
            <p class="admin-dash-subtitle">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong></p>
        </div>
        <div class="admin-dash-date">
            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
        </div>
    </div>

    <div class="stat-grid">
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

    <div class="dash-grid-2col">
        <div class="dash-section">
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
                <a href="#" class="quick-action-btn">
                    <span class="quick-action-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                        <i class="bi bi-megaphone-fill"></i>
                    </span>
                    <span class="quick-action-label">Buat Pengumuman</span>
                </a>
            </div>
        </div>

        <div class="dash-section">
            <div class="dash-section-header">
                <h2 class="dash-section-title"><i class="bi bi-activity me-2" style="color: #D4AF37;"></i>Aktivitas Terbaru</h2>
            </div>
            <div class="activity-card">
                <div class="activity-section">
                    <h6 class="activity-section-title"><i class="bi bi-person-up me-1"></i> Mahasiswa Baru</h6>
                    @if($recentMahasiswa->isEmpty())
                        <p class="activity-empty">Belum ada mahasiswa baru.</p>
                    @else
                        @foreach($recentMahasiswa as $m)
                        <div class="activity-item">
                            <div class="activity-item-avatar">{{ substr($m->nama_lengkap, 0, 1) }}</div>
                            <div class="activity-item-info">
                                <span class="activity-item-name">{{ $m->nama_lengkap }}</span>
                                <span class="activity-item-meta">{{ $m->nim }} &middot; {{ $m->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="activity-divider"></div>
                <div class="activity-section">
                    <h6 class="activity-section-title"><i class="bi bi-table me-1"></i> Jadwal Terbaru</h6>
                    @if($recentJadwal->isEmpty())
                        <p class="activity-empty">Belum ada jadwal.</p>
                    @else
                        @foreach($recentJadwal as $j)
                        <div class="activity-item">
                            <div class="activity-item-avatar" style="background: linear-gradient(135deg, #D4AF37, #C9A84C); color: #0a1628;">{{ substr($j->mataKuliah->nama_mk ?? 'J', 0, 1) }}</div>
                            <div class="activity-item-info">
                                <span class="activity-item-name">{{ $j->mataKuliah->nama_mk ?? '-' }}</span>
                                <span class="activity-item-meta">{{ $j->hari }} &middot; {{ $j->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="dash-grid-2col">
        <div class="dash-section">
            <div class="dash-section-header">
                <h2 class="dash-section-title"><i class="bi bi-bar-chart-fill me-2" style="color: #D4AF37;"></i>Mahasiswa per Program Studi</h2>
            </div>
            <div class="chart-card">
                <canvas id="chartMahasiswaPerProdi"></canvas>
            </div>
        </div>
        <div class="dash-section">
            <div class="dash-section-header">
                <h2 class="dash-section-title"><i class="bi bi-pie-chart-fill me-2" style="color: #D4AF37;"></i>Statistik Akademik</h2>
            </div>
            <div class="chart-card">
                <div style="display: flex; justify-content: center; gap: 2rem; padding: 1rem 0;">
                    <div class="mini-stat">
                        <span class="mini-stat-value">{{ $totalFakultas }}</span>
                        <span class="mini-stat-label">Fakultas</span>
                    </div>
                    <div class="mini-stat">
                        <span class="mini-stat-value">{{ $totalSemester }}</span>
                        <span class="mini-stat-label">Semester</span>
                    </div>
                    <div class="mini-stat">
                        <span class="mini-stat-value">{{ $totalRuangan }}</span>
                        <span class="mini-stat-label">Ruangan</span>
                    </div>
                    <div class="mini-stat">
                        <span class="mini-stat-value">{{ $totalKrs }}</span>
                        <span class="mini-stat-label">KRS Aktif</span>
                    </div>
                </div>
                <canvas id="chartRingkasan" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var prodiLabels = @json($mahasiswaPerProdi->pluck('nama_prodi'));
    var prodiData = @json($mahasiswaPerProdi->pluck('mahasiswa_count'));

    if (document.getElementById('chartMahasiswaPerProdi')) {
        new Chart(document.getElementById('chartMahasiswaPerProdi'), {
            type: 'bar',
            data: {
                labels: prodiLabels,
                datasets: [{
                    label: 'Mahasiswa',
                    data: prodiData,
                    backgroundColor: 'rgba(11, 42, 111, 0.75)',
                    borderColor: '#0B2A6F',
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    if (document.getElementById('chartRingkasan')) {
        new Chart(document.getElementById('chartRingkasan'), {
            type: 'doughnut',
            data: {
                labels: ['Fakultas', 'Prodi', 'Dosen', 'Mata Kuliah', 'Jadwal'],
                datasets: [{
                    data: [{{ $totalFakultas }}, {{ $totalProdi }}, {{ $totalDosen }}, {{ $totalMatakuliah }}, {{ $totalJadwal }}],
                    backgroundColor: ['#0B2A6F', '#123C96', '#D4AF37', '#1a4fa0', '#2a5fbf'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 16, usePointStyle: true, font: { size: 11, family: 'Poppins' } }
                    }
                }
            }
        });
    }
});
</script>
@endpush
