@extends('layouts.admin')
@section('title', 'Data Program Studi - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Program Studi</h1>
        <p>Kelola seluruh program studi</p>
    </div>
    <a href="{{ route('admin.program-studi.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Prodi
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
                        <th>Kode</th>
                        <th>Nama Prodi</th>
                        <th>Jenjang</th>
                        <th>Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programStudi as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-info">{{ $p->kode_prodi }}</span></td>
                        <td><strong>{{ $p->nama_prodi }}</strong></td>
                        <td><span class="badge-modern badge-primary">{{ $p->jenjang }}</span></td>
                        <td>{{ $p->fakultas->nama_fakultas ?? '-' }}</td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.program-studi.edit', $p) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.program-studi.destroy', $p) }}" onsubmit="return confirm('Yakin hapus prodi ini?')">
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
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-book-slash"></i></div>
                                <h5>Belum Ada Program Studi</h5>
                                <p>Data program studi masih kosong.</p>
                                <a href="{{ route('admin.program-studi.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Prodi
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
