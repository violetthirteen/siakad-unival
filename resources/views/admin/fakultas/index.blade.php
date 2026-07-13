@extends('layouts.admin')
@section('title', 'Data Fakultas - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Fakultas</h1>
        <p>Kelola seluruh data fakultas di lingkungan universitas</p>
    </div>
    <a href="{{ route('admin.fakultas.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Fakultas
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
                        <th>Nama Fakultas</th>
                        <th>Jumlah Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fakultas as $f)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-primary">{{ $f->kode_fakultas }}</span></td>
                        <td><strong>{{ $f->nama_fakultas }}</strong></td>
                        <td>{{ $f->program_studi_count }} Prodi</td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.fakultas.edit', $f) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.fakultas.destroy', $f) }}" onsubmit="return confirm('Yakin hapus fakultas ini?')">
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
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-building-slash"></i></div>
                                <h5>Belum Ada Fakultas</h5>
                                <p>Data fakultas masih kosong. Tambah fakultas baru untuk memulai.</p>
                                <a href="{{ route('admin.fakultas.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Fakultas
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
