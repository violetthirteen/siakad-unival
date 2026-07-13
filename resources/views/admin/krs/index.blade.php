@extends('layouts.admin')
@section('title', 'Data KRS - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data KRS</h1>
        <p>Kelola Kartu Rencana Studi mahasiswa</p>
    </div>
    <a href="{{ route('admin.krs.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Buat KRS
    </a>
</div>

@if(session('success'))
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
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
                        <th>Mahasiswa</th>
                        <th>NIM</th>
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
                        <td><strong>{{ $k->mahasiswa->nama_lengkap ?? '-' }}</strong></td>
                        <td><span class="badge-modern badge-info">{{ $k->mahasiswa->nim ?? '-' }}</span></td>
                        <td>{{ $k->semester->nama_semester ?? '-' }} {{ $k->semester->tahunAjaran->tahun_awal ?? '' }}</td>
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
                                <a href="{{ route('admin.krs.show', $k) }}" class="btn-modern btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <form method="POST" action="{{ route('admin.krs.destroy', $k) }}" onsubmit="return confirm('Yakin hapus KRS ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-modern btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-card-checklist-slash"></i></div>
                                <h5>Belum Ada KRS</h5>
                                <p>Data KRS masih kosong.</p>
                                <a href="{{ route('admin.krs.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Buat KRS
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
