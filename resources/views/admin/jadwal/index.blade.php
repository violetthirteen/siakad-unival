@extends('layouts.admin')
@section('title', 'Data Jadwal - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Data Jadwal</h1>
        <p>Kelola seluruh jadwal perkuliahan semester aktif</p>
    </div>
    <a href="{{ route('admin.jadwal.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Jadwal
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
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Ruangan</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Kuota</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $j)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $j->mataKuliah->nama_mk ?? '-' }}</strong></td>
                        <td>{{ $j->dosen->nama_lengkap ?? '-' }}</td>
                        <td>{{ $j->ruangan->nama_ruangan ?? '-' }}</td>
                        <td><span class="badge-modern badge-info">{{ $j->hari }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</td>
                        <td>{{ $j->kuota }}</td>
                        <td>{{ $j->semester->nama_semester ?? '-' }} {{ $j->semester->tahunAjaran->tahun_awal ?? '' }}</td>
                        <td>
                            <div class="table-modern-actions">
                                <a href="{{ route('admin.jadwal.edit', $j) }}" class="btn-modern btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.jadwal.destroy', $j) }}" onsubmit="return confirm('Yakin hapus jadwal ini?')">
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
                        <td colspan="9">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                                <h5>Belum Ada Jadwal</h5>
                                <p>Data jadwal perkuliahan masih kosong. Tambah jadwal baru untuk memulai.</p>
                                <a href="{{ route('admin.jadwal.create') }}" class="btn-modern btn-primary">
                                    <i class="bi bi-plus-lg"></i> Tambah Jadwal
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
