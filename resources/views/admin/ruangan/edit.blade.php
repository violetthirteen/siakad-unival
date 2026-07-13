@extends('layouts.admin')
@section('title', 'Edit Ruangan - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div><h1>Edit Ruangan</h1><p>Ubah data ruangan</p></div>
    <a href="{{ route('admin.ruangan.index') }}" class="btn-modern btn-ghost"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.ruangan.update', $ruangan) }}" class="form-modern">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Kode Ruangan</label>
                    <input type="text" name="kode_ruangan" class="form-control @error('kode_ruangan') is-invalid @enderror" value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" required>
                    @error('kode_ruangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required>
                    @error('nama_ruangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kapasitas</label>
                    <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', $ruangan->kapasitas) }}">
                    @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Update</button>
                <a href="{{ route('admin.ruangan.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
