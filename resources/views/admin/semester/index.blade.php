@extends('layouts.admin')
@section('title', 'Data Semester - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Semester</h1>
        <p>Kelola seluruh data semester</p>
    </div>
    <a href="{{ route('admin.semester.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Semester
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
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semester as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $s->nama_semester }}</strong></td>
                        <td>{{ $s->tahunAjaran->tahun_awal ?? '' }}/{{ $s->tahunAjaran->tahun_akhir ?? '' }}</td>
                        <td>
                            @if($s->is_active)
                                <span class="badge-modern badge-success">Aktif</span>
                            @else
                                <span class="badge-modern badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.semester.edit', $s) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.semester.activate', $s) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-modern btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Aktifkan
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.semester.destroy', $s) }}" onsubmit="return confirm('Yakin hapus?')">
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
                                <div class="empty-state-icon"><i class="bi bi-layers-slash"></i></div>
                                <h5>Belum Ada Semester</h5>
                                <p>Data semester masih kosong.</p>
                                <a href="{{ route('admin.semester.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Semester
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
