@extends('layouts.admin')
@section('title', 'Dashboard Mahasiswa - SIAKAD Unival')

@section('content')
<div class="admin-dashboard">
    <div class="admin-dash-header">
        <div>
            <h1 class="admin-dash-title">Dashboard Mahasiswa</h1>
            <p class="admin-dash-subtitle">Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>
        </div>
        <div class="admin-dash-date">
            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="stat-grid">
        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #0B2A6F, #123C96);">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">NIM</span>
                    <span class="stat-card-premium-value" style="font-size:1rem;">{{ $mahasiswa->nim ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #0B2A6F, #123C96);">
                    <i class="bi bi-layers"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">Semester Saat Ini</span>
                    <span class="stat-card-premium-value" style="font-size:1rem;">
                        @php
                            $semesterAngka = $semesterAktif ? ($semesterAktif->nama_semester === 'Ganjil' ? 1 : 2) : '-';
                            $tahunNow = now()->year;
                            $angkatan = (int) $mahasiswa->angkatan;
                            $semKe = $angkatan > 0 ? (($tahunNow - $angkatan) * 2) + ($semesterAngka === 1 ? 0 : 1) - (now()->month < 7 ? 1 : 0) : 0;
                            if ($semKe < 1) $semKe = 1;
                        @endphp
                        Semester {{ max($semKe, 1) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                    <i class="bi bi-award"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">IPK</span>
                    <span class="stat-card-premium-value">{{ $ipk > 0 ? number_format($ipk, 2) : '-' }}</span>
                </div>
            </div>
        </div>

        <div class="stat-card-premium">
            <div class="stat-card-premium-body">
                <div class="stat-card-premium-icon" style="background: linear-gradient(135deg, #D4AF37, #C9A84C);">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-card-premium-info">
                    <span class="stat-card-premium-label">Status</span>
                    <span class="stat-card-premium-value" style="font-size:1rem;">
                        <span class="badge-modern badge-success">{{ $mahasiswa->status ?? '-' }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-grid-2col">
        {{-- Jadwal Hari Ini --}}
        <div class="dash-section">
            <div class="dash-section-header">
                <h2 class="dash-section-title"><i class="bi bi-calendar-day me-2" style="color:var(--s-primary);"></i>Jadwal Hari Ini ({{ $hariIni ?? now()->isoFormat('dddd') }})</h2>
                <a href="{{ route('mahasiswa.jadwal') }}" class="btn-modern btn-ghost btn-sm">Lihat Semua</a>
            </div>
            <div class="card-modern-body">
                @if($jadwalHariIni->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                        <h5>Tidak Ada Jadwal</h5>
                        <p>Tidak ada jadwal perkuliahan untuk hari ini.</p>
                    </div>
                @else
                    <div class="schedule-timeline">
                        @foreach($jadwalHariIni as $j)
                        <div class="schedule-item">
                            <div class="schedule-time">
                                <span class="schedule-time-start">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }}</span>
                                <span class="schedule-time-end">{{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</span>
                            </div>
                            <div class="schedule-line"></div>
                            <div class="schedule-content">
                                <strong class="schedule-mk">{{ $j->mataKuliah->nama_mk ?? '-' }}</strong>
                                <span class="schedule-meta">{{ $j->dosen->nama_lengkap ?? '-' }} &middot; {{ $j->ruangan->nama_ruangan ?? '-' }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- KRS Semester Aktif --}}
        <div class="dash-section">
            <div class="dash-section-header">
                <h2 class="dash-section-title"><i class="bi bi-card-checklist me-2" style="color:var(--s-primary);"></i>KRS Semester Aktif</h2>
                <a href="{{ route('mahasiswa.krs.index') }}" class="btn-modern btn-ghost btn-sm">Lihat Semua</a>
            </div>
            <div class="card-modern-body">
                @if($krsAktif)
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;padding:0.75rem;background:rgba(11,42,111,0.05);border-radius:0.5rem;">
                        <div>
                            <strong>{{ $krsAktif->semester->nama_semester ?? '-' }} {{ $krsAktif->semester->tahunAjaran->tahun_awal ?? '' }}/{{ $krsAktif->semester->tahunAjaran->tahun_akhir ?? '' }}</strong>
                            <br>
                            <small class="text-muted">
                                @if($krsAktif->status == 'disetujui')
                                    <span class="badge-modern badge-success">Disetujui</span>
                                @else
                                    <span class="badge-modern badge-warning">{{ $krsAktif->status }}</span>
                                @endif
                            </small>
                        </div>
                        <div style="margin-left:auto;text-align:right;">
                            <strong style="font-size:1.25rem;">{{ $krsAktif->detail->sum(fn($d) => $d->mataKuliah->sks ?? 0) }}</strong>
                            <br><small class="text-muted">SKS</small>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-modern" style="font-size:0.85rem;">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Mata Kuliah</th>
                                    <th>SKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($krsAktif->detail as $d)
                                <tr>
                                    <td><span class="badge-modern badge-info">{{ $d->mataKuliah->kode_mk ?? '-' }}</span></td>
                                    <td>{{ $d->mataKuliah->nama_mk ?? '-' }}</td>
                                    <td>{{ $d->mataKuliah->sks ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="bi bi-journal-slash"></i></div>
                        <h5>Belum Ada KRS</h5>
                        <p>Anda belum memiliki KRS untuk semester aktif.</p>
                        <a href="{{ route('mahasiswa.krs.create') }}" class="btn-modern btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Buat KRS
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="dash-grid-2col">
        {{-- Nilai Terbaru --}}
        <div class="dash-section">
            <div class="dash-section-header">
                <h2 class="dash-section-title"><i class="bi bi-award me-2" style="color:var(--s-primary);"></i>Nilai Terbaru</h2>
                <a href="{{ route('mahasiswa.nilai') }}" class="btn-modern btn-ghost btn-sm">Lihat Semua</a>
            </div>
            <div class="card-modern-body">
                @if($nilai->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon"><i class="bi bi-award-slash"></i></div>
                        <h5>Belum Ada Nilai</h5>
                        <p>Belum ada data nilai akademik.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table-modern" style="font-size:0.85rem;">
                            <thead>
                                <tr>
                                    <th>Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nilai->sortByDesc('semester_id')->take(5) as $n)
                                @php
                                    $grade = $n->nilai_huruf ?? '-';
                                    $badgeClass = match(true) {
                                        in_array($grade, ['A','A-']) => 'badge-success',
                                        in_array($grade, ['B+','B','B-']) => 'badge-info',
                                        in_array($grade, ['C+','C']) => 'badge-warning',
                                        $grade === 'D' => 'badge-danger',
                                        default => 'badge-secondary'
                                    };
                                @endphp
                                <tr>
                                    <td><strong>{{ $n->mataKuliah->nama_mk ?? '-' }}</strong></td>
                                    <td>{{ $n->mataKuliah->sks ?? '-' }}</td>
                                    <td><span class="badge-modern {{ $badgeClass }}">{{ $grade }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Informasi Mahasiswa --}}
        <div class="dash-section">
            <div class="dash-section-header">
                <h2 class="dash-section-title"><i class="bi bi-person-vcard me-2" style="color:var(--s-primary);"></i>Biodata</h2>
            </div>
            <div class="card-modern-body">
                <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem;">
                    <div class="admin-avatar" style="width:56px;height:56px;font-size:1.5rem;background:linear-gradient(135deg, #0B2A6F, #123C96);">{{ substr($mahasiswa->nama_lengkap, 0, 1) }}</div>
                    <div>
                        <strong style="font-size:1.1rem;">{{ $mahasiswa->nama_lengkap }}</strong>
                        <br>
                        <small class="text-muted">{{ $mahasiswa->nim }} &middot; Angkatan {{ $mahasiswa->angkatan }}</small>
                    </div>
                </div>
                <table style="width:100%;font-size:0.9rem;">
                    <tr>
                        <td style="padding:0.35rem 0.5rem 0.35rem 0;color:var(--text-muted);width:110px;">Tempat Lahir</td>
                        <td style="padding:0.35rem 0;">: {{ $mahasiswa->tempat_lahir ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:0.35rem 0.5rem 0.35rem 0;color:var(--text-muted);">Tanggal Lahir</td>
                        <td style="padding:0.35rem 0;">: {{ $mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:0.35rem 0.5rem 0.35rem 0;color:var(--text-muted);">Jenis Kelamin</td>
                        <td style="padding:0.35rem 0;">: {{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : ($mahasiswa->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:0.35rem 0.5rem 0.35rem 0;color:var(--text-muted);">No. HP</td>
                        <td style="padding:0.35rem 0;">: {{ $mahasiswa->no_hp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:0.35rem 0.5rem 0.35rem 0;color:var(--text-muted);">Email</td>
                        <td style="padding:0.35rem 0;">: {{ $mahasiswa->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="padding:0.35rem 0.5rem 0.35rem 0;color:var(--text-muted);">Alamat</td>
                        <td style="padding:0.35rem 0;">: {{ $mahasiswa->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
