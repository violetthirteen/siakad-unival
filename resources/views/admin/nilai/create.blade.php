@extends('layouts.admin')
@section('title', 'Input Nilai - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div><h1>Input Nilai</h1><p>Buat data nilai baru</p></div>
    <a href="{{ route('admin.nilai.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.nilai.store') }}" class="form-modern">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mahasiswa</label>
                    <select name="mahasiswa_id" class="form-control @error('mahasiswa_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach($mahasiswa as $m)
                            <option value="{{ $m->id }}" {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>{{ $m->nim }} - {{ $m->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    @error('mahasiswa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="mata_kuliah_id" class="form-control @error('mata_kuliah_id') is-invalid @enderror" required>
                        <option value="">-- Pilih MK --</option>
                        @foreach($mataKuliah as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                        @endforeach
                    </select>
                    @error('mata_kuliah_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Semester</label>
                    <select name="semester_id" class="form-control @error('semester_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Semester --</option>
                        @foreach($semester as $s)
                            <option value="{{ $s->id }}" {{ old('semester_id') == $s->id ? 'selected' : '' }}>{{ $s->nama_semester }} {{ $s->tahunAjaran->tahun_awal ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('semester_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Nilai Tugas</label>
                    <input type="number" name="nilai_tugas" class="form-control @error('nilai_tugas') is-invalid @enderror" value="{{ old('nilai_tugas') }}" step="0.01">
                    @error('nilai_tugas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Nilai UTS</label>
                    <input type="number" name="nilai_uts" class="form-control @error('nilai_uts') is-invalid @enderror" value="{{ old('nilai_uts') }}" step="0.01">
                    @error('nilai_uts') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Nilai UAS</label>
                    <input type="number" name="nilai_uas" class="form-control @error('nilai_uas') is-invalid @enderror" value="{{ old('nilai_uas') }}" step="0.01">
                    @error('nilai_uas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Simpan</button>
                <a href="{{ route('admin.nilai.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
