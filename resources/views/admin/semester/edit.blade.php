@extends('layouts.admin')
@section('title', 'Edit Semester - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div><h1>Edit Semester</h1><p>Ubah data semester</p></div>
    <a href="{{ route('admin.semester.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.semester.update', $semester) }}" class="form-modern">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" class="form-control @error('tahun_ajaran_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Tahun Ajaran --</option>
                        @foreach($tahunAjaran as $ta)
                            <option value="{{ $ta->id }}" {{ old('tahun_ajaran_id', $semester->tahun_ajaran_id) == $ta->id ? 'selected' : '' }}>{{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }}</option>
                        @endforeach
                    </select>
                    @error('tahun_ajaran_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nama Semester</label>
                    <select name="nama_semester" class="form-control @error('nama_semester') is-invalid @enderror" required>
                        <option value="Ganjil" {{ old('nama_semester', $semester->nama_semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ old('nama_semester', $semester->nama_semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('nama_semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                        <option value="0" {{ old('is_active', $semester->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="1" {{ old('is_active', $semester->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                    </select>
                    @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Update</button>
                <a href="{{ route('admin.semester.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
