@extends('layouts.admin')
@section('title', 'Data Ruangan - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Ruangan</h1>
        <p>Kelola seluruh data ruangan perkuliahan</p>
    </div>
    @if(auth()->user()->role === 'super_admin')
    <a href="{{ route('admin.ruangan.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Ruangan
    </a>
    @endif
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
                        <th>Nama Ruangan</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ruangan as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-primary">{{ $r->kode_ruangan }}</span></td>
                        <td><strong>{{ $r->nama_ruangan }}</strong></td>
                        <td>{{ $r->kapasitas }} Orang</td>
                        <td>
                            <div class="table-modern-actions">
                                @if(auth()->user()->role === 'super_admin')
                                <a href="{{ route('admin.ruangan.edit', $r) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.ruangan.destroy', $r) }}" onsubmit="return confirm('Yakin hapus ruangan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-modern btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                                @else
                                <span class="badge-modern badge-secondary">Read Only</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-door-closed"></i></div>
                                <h5>Belum Ada Ruangan</h5>
                                <p>Data ruangan masih kosong.</p>
                                @if(auth()->user()->role === 'super_admin')
                                <a href="{{ route('admin.ruangan.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Ruangan
                                </a>
                                @endif
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
