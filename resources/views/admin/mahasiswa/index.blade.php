@extends('layouts.admin')
@section('title', 'Data Mahasiswa - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Mahasiswa</h1>
        <p>Kelola seluruh data mahasiswa</p>
    </div>
    <a href="{{ route('admin.mahasiswa.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
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
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>JK</th>
                        <th>Prodi</th>
                        <th>Angkatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $m)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-info">{{ $m->nim }}</span></td>
                        <td><strong>{{ $m->nama_lengkap }}</strong></td>
                        <td>{{ $m->jenis_kelamin }}</td>
                        <td>{{ $m->programStudi->nama_prodi ?? '-' }}</td>
                        <td>{{ $m->angkatan }}</td>
                        <td>
                            @if($m->status == 'aktif')
                                <span class="badge-modern badge-success">Aktif</span>
                            @elseif($m->status == 'cuti')
                                <span class="badge-modern badge-warning">Cuti</span>
                            @else
                                <span class="badge-modern badge-danger">{{ $m->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.mahasiswa.edit', $m) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.mahasiswa.destroy', $m) }}" onsubmit="return confirm('Yakin hapus mahasiswa ini?')">
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
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-people-slash"></i></div>
                                <h5>Belum Ada Mahasiswa</h5>
                                <p>Data mahasiswa masih kosong.</p>
                                <a href="{{ route('admin.mahasiswa.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
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
