@extends('layouts.admin')
@section('title', 'Jadwal Kuliah - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Jadwal Kuliah</h1>
        <p>Jadwal perkuliahan program studi Anda</p>
    </div>
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
                        <th>Semester</th>
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
                        <td>{{ $j->semester->nama_semester ?? '-' }} {{ $j->semester->tahunAjaran->tahun_awal ?? '' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-calendar-x"></i></div>
                                <h5>Belum Ada Jadwal</h5>
                                <p>Belum ada jadwal perkuliahan untuk program studi Anda.</p>
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
