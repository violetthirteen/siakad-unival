@extends('layouts.admin')
@section('title', 'Buat KRS - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Buat KRS Baru</h1>
        <p>Buat Kartu Rencana Studi untuk mahasiswa</p>
    </div>
    <a href="{{ route('admin.krs.index') }}" class="btn-modern btn-ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.krs.store') }}" class="form-modern">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Mahasiswa</label>
                    <select name="mahasiswa_id" class="form-control @error('mahasiswa_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswa as $m)
                            <option value="{{ $m->id }}" {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>{{ $m->nim }} - {{ $m->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    @error('mahasiswa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Semester</label>
                    <select name="semester_id" class="form-control @error('semester_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Semester --</option>
                        @foreach($semester as $s)
                            <option value="{{ $s->id }}" {{ old('semester_id') == $s->id ? 'selected' : '' }}>{{ $s->nama_semester }} {{ $s->tahunAjaran->tahun_awal ?? '' }}/{{ $s->tahunAjaran->tahun_akhir ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('semester_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Buat KRS</button>
                <a href="{{ route('admin.krs.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
