@extends('layouts.admin')
@section('title', 'Data Dosen - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Dosen</h1>
        <p>Kelola seluruh data dosen</p>
    </div>
    <a href="{{ route('admin.dosen.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Dosen
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
                        <th>NIDN</th>
                        <th>Nama Lengkap</th>
                        <th>JK</th>
                        <th>Prodi</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dosen as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-primary">{{ $d->nidn }}</span></td>
                        <td><strong>{{ $d->nama_lengkap }}</strong></td>
                        <td>{{ $d->jenis_kelamin }}</td>
                        <td>{{ $d->programStudi->nama_prodi ?? '-' }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.dosen.edit', $d) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.dosen.destroy', $d) }}" onsubmit="return confirm('Yakin hapus dosen ini?')">
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
                                <div class="empty-state-icon"><i class="bi bi-person-slash"></i></div>
                                <h5>Belum Ada Dosen</h5>
                                <p>Data dosen masih kosong.</p>
                                <a href="{{ route('admin.dosen.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Dosen
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
