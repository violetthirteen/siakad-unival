@extends('layouts.admin')
@section('title', 'Tambah Program Studi - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div><h1>Tambah Program Studi</h1><p>Buat program studi baru</p></div>
    <a href="{{ route('admin.program-studi.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.program-studi.store') }}" class="form-modern">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Kode Prodi</label>
                    <input type="text" name="kode_prodi" class="form-control @error('kode_prodi') is-invalid @enderror" value="{{ old('kode_prodi') }}" required>
                    @error('kode_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Prodi</label>
                    <input type="text" name="nama_prodi" class="form-control @error('nama_prodi') is-invalid @enderror" value="{{ old('nama_prodi') }}" required>
                    @error('nama_prodi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jenjang</label>
                    <select name="jenjang" class="form-control @error('jenjang') is-invalid @enderror" required>
                        @foreach(['D3','D4','S1','S2','S3'] as $j)
                            <option value="{{ $j }}" {{ old('jenjang') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                    @error('jenjang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fakultas</label>
                    <select name="fakultas_id" class="form-control @error('fakultas_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Fakultas --</option>
                        @foreach($fakultas as $f)
                            <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>{{ $f->nama_fakultas }}</option>
                        @endforeach
                    </select>
                    @error('fakultas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Simpan</button>
                <a href="{{ route('admin.program-studi.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
