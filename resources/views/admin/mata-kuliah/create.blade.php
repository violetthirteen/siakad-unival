@extends('layouts.admin')
@section('title', 'Tambah Mata Kuliah - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div><h1>Tambah Mata Kuliah</h1><p>Buat mata kuliah baru</p></div>
    <a href="{{ route('admin.mata-kuliah.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.mata-kuliah.store') }}" class="form-modern">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Kode MK</label>
                    <input type="text" name="kode_mk" class="form-control @error('kode_mk') is-invalid @enderror" value="{{ old('kode_mk') }}" required>
                    @error('kode_mk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama MK</label>
                    <input type="text" name="nama_mk" class="form-control @error('nama_mk') is-invalid @enderror" value="{{ old('nama_mk') }}" required>
                    @error('nama_mk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">SKS</label>
                    <input type="number" name="sks" class="form-control @error('sks') is-invalid @enderror" value="{{ old('sks') }}" required>
                    @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Semester</label>
                    <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester') }}" required>
                    @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Program Studi</label>
                    <select name="program_studi_id" class="form-control @error('program_studi_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Prodi --</option>
                        @foreach($programStudi as $p)
                            <option value="{{ $p->id }}" {{ old('program_studi_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
                        @endforeach
                    </select>
                    @error('program_studi_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Simpan</button>
                <a href="{{ route('admin.mata-kuliah.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
