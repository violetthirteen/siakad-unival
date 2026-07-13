@extends('layouts.admin')
@section('title', 'Detail KRS - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Detail KRS</h1>
        <p>Informasi Kartu Rencana Studi mahasiswa</p>
    </div>
    <div style="display:flex;gap:0.75rem;flex-wrap:wrap;">
        @if($krs->status == 'draft')
            <form method="POST" action="{{ route('admin.krs.approve', $krs) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn-modern btn-success"><i class="bi bi-check-lg"></i> Setujui KRS</button>
            </form>
        @endif
        <a href="{{ route('admin.krs.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
</div>

@if(session('success'))
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif
@if(session('error'))
<div class="alert-modern alert-danger">
    <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

<div class="card-modern mb-4">
    <div class="card-modern-body">
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-item-label">Mahasiswa</div>
                <div class="detail-item-value">{{ $krs->mahasiswa->nim ?? '-' }} - {{ $krs->mahasiswa->nama_lengkap ?? '-' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-item-label">Semester</div>
                <div class="detail-item-value">{{ $krs->semester->nama_semester ?? '-' }} {{ $krs->semester->tahunAjaran->tahun_awal ?? '' }}/{{ $krs->semester->tahunAjaran->tahun_akhir ?? '' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-item-label">Status</div>
                <div class="detail-item-value">
                    @if($krs->status == 'disetujui')
                        <span class="badge-modern badge-success">Disetujui</span>
                    @else
                        <span class="badge-modern badge-warning">{{ $krs->status }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-modern">
    <div class="card-modern-header">
        <h5><i class="bi bi-journal-text me-2"></i>Mata Kuliah</h5>
        @if($krs->status == 'draft')
        <form method="POST" action="{{ route('admin.krs.add-matkul', $krs) }}" style="display:flex;gap:0.5rem;align-items:center;">
            @csrf
            <select name="mata_kuliah_id" class="form-control form-modern" style="width:auto;min-width:250px;padding:0.45rem 0.85rem;font-size:0.85rem;" required>
                <option value="">-- Pilih MK --</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                @endforeach
            </select>
            <button type="submit" class="btn-modern btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</button>
        </form>
        @endif
    </div>
    <div class="card-modern-body p-0">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama MK</th>
                        <th>SKS</th>
                        @if($krs->status == 'draft')<th>Aksi</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs->detail as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-info">{{ $d->mataKuliah->kode_mk ?? '-' }}</span></td>
                        <td><strong>{{ $d->mataKuliah->nama_mk ?? '-' }}</strong></td>
                        <td>{{ $d->mataKuliah->sks ?? '-' }}</td>
                        @if($krs->status == 'draft')
                        <td>
                            <form method="POST" action="{{ route('admin.krs.remove-matkul', $d) }}" onsubmit="return confirm('Hapus MK dari KRS?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-modern btn-danger btn-sm"><i class="bi bi-trash3"></i> Hapus</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="@if($krs->status == 'draft')5 @else 4 @endif">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-journal-slash"></i></div>
                                <h5>Belum Ada Mata Kuliah</h5>
                                <p>Belum ada mata kuliah yang ditambahkan ke KRS ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
