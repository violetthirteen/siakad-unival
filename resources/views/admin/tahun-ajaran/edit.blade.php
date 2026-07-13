@extends('layouts.admin')
@section('title', 'Edit Tahun Ajaran - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div><h1>Edit Tahun Ajaran</h1><p>Ubah data tahun ajaran</p></div>
    <a href="{{ route('admin.tahun-ajaran.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.tahun-ajaran.update', $tahunAjaran) }}" class="form-modern">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Tahun Awal</label>
                    <input type="text" name="tahun_awal" class="form-control @error('tahun_awal') is-invalid @enderror" value="{{ old('tahun_awal', $tahunAjaran->tahun_awal) }}" required>
                    @error('tahun_awal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tahun Akhir</label>
                    <input type="text" name="tahun_akhir" class="form-control @error('tahun_akhir') is-invalid @enderror" value="{{ old('tahun_akhir', $tahunAjaran->tahun_akhir) }}" required>
                    @error('tahun_akhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror">
                        <option value="0" {{ old('is_active', $tahunAjaran->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="1" {{ old('is_active', $tahunAjaran->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                    </select>
                    @error('is_active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Update</button>
                <a href="{{ route('admin.tahun-ajaran.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
