@extends('layouts.admin')
@section('title', 'Tahun Ajaran - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Tahun Ajaran</h1>
        <p>Kelola tahun ajaran perkuliahan</p>
    </div>
    <a href="{{ route('admin.tahun-ajaran.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Tahun Ajaran
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
                        <th>Tahun Ajaran</th>
                        <th>Jumlah Semester</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tahunAjaran as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $t->tahun_awal }}/{{ $t->tahun_akhir }}</strong></td>
                        <td>{{ $t->semester_count }} Semester</td>
                        <td>
                            @if($t->is_active)
                                <span class="badge-modern badge-success">Aktif</span>
                            @else
                                <span class="badge-modern badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.tahun-ajaran.edit', $t) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.tahun-ajaran.activate', $t) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-modern btn-success btn-sm">
                                        <i class="bi bi-check-lg"></i> Aktifkan
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.tahun-ajaran.destroy', $t) }}" onsubmit="return confirm('Yakin hapus?')">
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
                                <div class="empty-state-icon"><i class="bi bi-calendar-slash"></i></div>
                                <h5>Belum Ada Tahun Ajaran</h5>
                                <p>Data tahun ajaran masih kosong.</p>
                                <a href="{{ route('admin.tahun-ajaran.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Tahun Ajaran
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
