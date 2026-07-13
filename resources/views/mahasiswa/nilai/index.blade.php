@extends('layouts.admin')
@section('title', 'Nilai - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Nilai</h1>
        <p>Data nilai akademik Anda</p>
    </div>
</div>

@if(session('success'))
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

@forelse($nilai as $semesterLabel => $nilaiSemester)
<div class="card-modern mb-4">
    <div class="card-modern-header">
        <h5 class="mb-0">{{ $semesterLabel }}</h5>
    </div>
    <div class="card-modern-body p-0">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>N. Akhir</th>
                        <th>N. Huruf</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilaiSemester as $n)
                    @php
                        $grade = $n->nilai_huruf ?? '-';
                        $badgeClass = match(true) {
                            in_array($grade, ['A','A-']) => 'badge-success',
                            in_array($grade, ['B+','B','B-']) => 'badge-info',
                            in_array($grade, ['C+','C']) => 'badge-warning',
                            $grade === 'D' => 'badge-danger',
                            default => 'badge-secondary'
                        };
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge-modern badge-info">{{ $n->mataKuliah->kode_mk ?? '-' }}</span></td>
                        <td><strong>{{ $n->mataKuliah->nama_mk ?? '-' }}</strong></td>
                        <td>{{ $n->mataKuliah->sks ?? '-' }}</td>
                        <td>{{ $n->nilai_tugas ?? '-' }}</td>
                        <td>{{ $n->nilai_uts ?? '-' }}</td>
                        <td>{{ $n->nilai_uas ?? '-' }}</td>
                        <td><strong>{{ $n->nilai_akhir ?? '-' }}</strong></td>
                        <td>
                            @if($n->nilai_huruf)
                            <span class="badge-modern {{ $badgeClass }}">{{ $grade }}</span>
                            @else
                            <span class="badge-modern badge-secondary">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@empty
<div class="card-modern">
    <div class="card-modern-body">
        <div class="empty-state">
            <div class="empty-state-icon"><i class="bi bi-award-slash"></i></div>
            <h5>Belum Ada Nilai</h5>
            <p>Belum ada data nilai akademik.</p>
        </div>
    </div>
</div>
@endforelse
@endsection
