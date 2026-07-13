@extends('layouts.admin')
@section('title', 'Data Nilai - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Nilai</h1>
        <p>Kelola seluruh data nilai mahasiswa</p>
    </div>
    @if(auth()->user()->role === 'super_admin')
    <a href="{{ route('admin.nilai.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Input Nilai
    </a>
    @endif
</div>

@if(session('success'))
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

{{-- Filter --}}
<div class="card-modern mb-4">
    <div class="card-modern-body">
        <form method="GET" action="{{ route('admin.nilai.index') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Semester</label>
                <select name="semester_id" class="form-modern form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Semester --</option>
                    @foreach($semesters as $s)
                    <option value="{{ $s->id }}" {{ $selectedSemester == $s->id ? 'selected' : '' }}>
                        {{ $s->nama_semester }} {{ $s->tahunAjaran->tahun_awal ?? '' }}/{{ $s->tahunAjaran->tahun_akhir ?? '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Mata Kuliah</label>
                <select name="mata_kuliah_id" class="form-modern form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Mata Kuliah --</option>
                    @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ $selectedMkId == $mk->id ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                @if($selectedSemester || $selectedMkId)
                <a href="{{ route('admin.nilai.index') }}" class="btn-modern btn-secondary">
                    <i class="bi bi-x-lg"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

@if($selectedSemester && $selectedMkId)
    {{-- Per-MK view: all students in MK --}}
    @php
        $selectedMk = $mataKuliah->firstWhere('id', $selectedMkId);
    @endphp
    <div class="card-modern">
        <div class="card-modern-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">{{ $selectedMk->kode_mk ?? '' }} - {{ $selectedMk->nama_mk ?? '' }} <small class="text-muted ms-2">({{ $selectedMk->sks ?? '-' }} SKS)</small></h5>
            </div>
            <span class="badge-modern badge-primary">{{ $students->count() }} Mahasiswa</span>
        </div>
        <div class="card-modern-body p-0">
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Akhir</th>
                            <th>Huruf</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $mhs)
                        @php
                            $n = $mhs->nilai->first();
                            $hasNilai = !is_null($n);
                            $grade = $n->nilai_huruf ?? '-';
                            $badgeClass = match(true) {
                                in_array($grade, ['A','A-']) => 'badge-success',
                                in_array($grade, ['B+','B','B-']) => 'badge-info',
                                in_array($grade, ['C+','C']) => 'badge-warning',
                                $grade === 'D' => 'badge-danger',
                                default => 'badge-secondary'
                            };
                        @endphp
                        <tr class="{{ !$hasNilai ? 'table-modern-dimmed' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge-modern badge-primary">{{ $mhs->nim }}</span></td>
                            <td><strong>{{ $mhs->nama_lengkap }}</strong></td>
                            <td>{{ $hasNilai ? $n->nilai_tugas : '-' }}</td>
                            <td>{{ $hasNilai ? $n->nilai_uts : '-' }}</td>
                            <td>{{ $hasNilai ? $n->nilai_uas : '-' }}</td>
                            <td><strong>{{ $hasNilai ? $n->nilai_akhir : '-' }}</strong></td>
                            <td>
                                @if($hasNilai)
                                <span class="badge-modern {{ $badgeClass }}">{{ $grade }}</span>
                                @else
                                <span class="badge-modern badge-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-modern-actions">
                                    @if($hasNilai && auth()->user()->role === 'super_admin')
                                    <a href="{{ route('admin.nilai.edit', $n) }}" class="btn-modern btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form method="POST" action="{{ route('admin.nilai.destroy', $n) }}" onsubmit="return confirm('Yakin hapus?')" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-modern btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                    </form>
                                    @elseif(!$hasNilai)
                                    <span class="text-muted small">Belum dinilai</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="empty-state-icon"><i class="bi bi-people-slash"></i></div>
                                    <h5>Tidak Ada Mahasiswa</h5>
                                    <p>Tidak ditemukan mahasiswa aktif pada mata kuliah ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    {{-- Default flat table --}}
    <div class="card-modern">
        <div class="card-modern-body p-0">
            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Semester</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Akhir</th>
                            <th>Huruf</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilai as $n)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $n->mahasiswa->nim ?? '-' }}</strong> - {{ $n->mahasiswa->nama_lengkap ?? '-' }}</td>
                            <td>{{ $n->mataKuliah->nama_mk ?? '-' }}</td>
                            <td>{{ $n->semester->nama_semester ?? '-' }} {{ $n->semester->tahunAjaran->tahun_awal ?? '' }}</td>
                            <td>{{ $n->nilai_tugas ?? '-' }}</td>
                            <td>{{ $n->nilai_uts ?? '-' }}</td>
                            <td>{{ $n->nilai_uas ?? '-' }}</td>
                            <td><strong>{{ $n->nilai_akhir ?? '-' }}</strong></td>
                            <td>
                                @php
                                    $grade = $n->nilai_huruf ?? '-';
                                    $badgeClass = in_array($grade, ['A','A-','B+']) ? 'badge-success' : (in_array($grade, ['B','B-','C+','C']) ? 'badge-warning' : 'badge-danger');
                                @endphp
                                <span class="badge-modern {{ $badgeClass }}">{{ $grade }}</span>
                            </td>
                            <td>
                                <div class="table-modern-actions">
                                    @if(auth()->user()->role === 'super_admin')
                                    <a href="{{ route('admin.nilai.edit', $n) }}" class="btn-modern btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form method="POST" action="{{ route('admin.nilai.destroy', $n) }}" onsubmit="return confirm('Yakin hapus?')" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-modern btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                    </form>
                                    @else
                                    <span class="text-muted small">-</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">
                                <div class="empty-state">
                                    <div class="empty-state-icon"><i class="bi bi-award-slash"></i></div>
                                    <h5>Belum Ada Nilai</h5>
                                    <p>Data nilai masih kosong.</p>
                                    @if(auth()->user()->role === 'super_admin')
                                    <a href="{{ route('admin.nilai.create') }}" class="btn-modern btn-primary"><i class="bi bi-plus-lg"></i> Input Nilai</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection
