@extends('layouts.admin')
@section('title', 'Data Mata Kuliah - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Mata Kuliah</h1>
        <p>Kelola seluruh mata kuliah yang tersedia</p>
    </div>
    <a href="{{ route('admin.mata-kuliah.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah MK
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
                        <th>Nama MK</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mataKuliah as $mk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-info">{{ $mk->kode_mk }}</span></td>
                        <td><strong>{{ $mk->nama_mk }}</strong></td>
                        <td>{{ $mk->sks }}</td>
                        <td><span class="badge-modern badge-primary">Semester {{ $mk->semester }}</span></td>
                        <td>{{ $mk->programStudi->nama_prodi ?? '-' }}</td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.mata-kuliah.edit', $mk) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.mata-kuliah.destroy', $mk) }}" onsubmit="return confirm('Yakin hapus MK ini?')">
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
                                <div class="empty-state-icon"><i class="bi bi-journal-slash"></i></div>
                                <h5>Belum Ada Mata Kuliah</h5>
                                <p>Data mata kuliah masih kosong.</p>
                                <a href="{{ route('admin.mata-kuliah.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah MK
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
