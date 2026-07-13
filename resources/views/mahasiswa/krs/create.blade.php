@extends('layouts.admin')
@section('title', 'Buat KRS - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Buat KRS Baru</h1>
        <p>Pilih semester untuk membuat Kartu Rencana Studi</p>
    </div>
    <a href="{{ route('mahasiswa.krs.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>

@if(session('error'))
<div class="alert-modern alert-danger">
    <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('mahasiswa.krs.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Semester</label>
                <select name="semester_id" class="form-modern form-select" required>
                    <option value="">-- Pilih Semester --</option>
                    @foreach($semester as $s)
                    <option value="{{ $s->id }}">
                        {{ $s->nama_semester }} {{ $s->tahunAjaran->tahun_awal ?? '' }}/{{ $s->tahunAjaran->tahun_akhir ?? '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-modern btn-primary"><i class="bi bi-save"></i> Buat KRS</button>
        </form>
    </div>
</div>
@endsection
