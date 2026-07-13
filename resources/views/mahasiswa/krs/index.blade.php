@extends('layouts.admin')
@section('title', 'Kartu Rencana Studi - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Kartu Rencana Studi (KRS)</h1>
        <p>Kelola Kartu Rencana Studi Anda</p>
    </div>
    <a href="{{ route('mahasiswa.krs.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Buat KRS Baru
    </a>
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

<div class="card-modern">
    <div class="card-modern-body p-0">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Semester</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->semester->nama_semester ?? '-' }} {{ $k->semester->tahunAjaran->tahun_awal ?? '' }}/{{ $k->semester->tahunAjaran->tahun_akhir ?? '' }}</td>
                        <td>{{ $k->tanggal_dibuat->format('d/m/Y') }}</td>
                        <td>
                            @if($k->status == 'disetujui')
                                <span class="badge-modern badge-success">Disetujui</span>
                            @else
                                <span class="badge-modern badge-warning">{{ $k->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('mahasiswa.krs.show', $k) }}" class="btn-modern btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-card-checklist-slash"></i></div>
                                <h5>Belum Ada KRS</h5>
                                <p>Anda belum memiliki Kartu Rencana Studi. Buat KRS baru untuk memulai.</p>
                                <a href="{{ route('mahasiswa.krs.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Buat KRS Baru
                                </a>
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
