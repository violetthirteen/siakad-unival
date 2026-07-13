@extends('layouts.admin')
@section('title', 'Edit Jadwal - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Jadwal</h1>
        <p>Ubah data jadwal perkuliahan</p>
    </div>
    <a href="{{ route('admin.jadwal.index') }}" class="btn-modern btn-ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.jadwal.update', $jadwal) }}" class="form-modern">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="mata_kuliah_id" class="form-control @error('mata_kuliah_id') is-invalid @enderror" required>
                        <option value="">-- Pilih MK --</option>
                        @foreach($mataKuliah as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $jadwal->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                        @endforeach
                    </select>
                    @error('mata_kuliah_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dosen</label>
                    <select name="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->id }}" {{ old('dosen_id', $jadwal->dosen_id) == $d->id ? 'selected' : '' }}>{{ $d->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    @error('dosen_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ruangan</label>
                    <select name="ruangan_id" class="form-control @error('ruangan_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($ruangan as $r)
                            <option value="{{ $r->id }}" {{ old('ruangan_id', $jadwal->ruangan_id) == $r->id ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
                        @endforeach
                    </select>
                    @error('ruangan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Semester</label>
                    <select name="semester_id" class="form-control @error('semester_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Semester --</option>
                        @foreach($semester as $s)
                            <option value="{{ $s->id }}" {{ old('semester_id', $jadwal->semester_id) == $s->id ? 'selected' : '' }}>{{ $s->nama_semester }} {{ $s->tahunAjaran->tahun_awal ?? '' }}/{{ $s->tahunAjaran->tahun_akhir ?? '' }}</option>
                        @endforeach
                    </select>
                    @error('semester_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hari</label>
                    <select name="hari" class="form-control @error('hari') is-invalid @enderror" required>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                            <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i')) }}" required>
                    @error('jam_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i')) }}" required>
                    @error('jam_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Kuota</label>
                    <input type="number" name="kuota" class="form-control @error('kuota') is-invalid @enderror" value="{{ old('kuota', $jadwal->kuota) }}" required>
                    @error('kuota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Update</button>
                <a href="{{ route('admin.jadwal.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
