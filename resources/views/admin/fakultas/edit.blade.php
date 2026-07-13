@extends('layouts.admin')
@section('title', 'Edit Fakultas - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Fakultas</h1>
        <p>Ubah data fakultas</p>
    </div>
    <a href="{{ route('admin.fakultas.index') }}" class="btn-modern btn-ghost">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card-modern">
    <div class="card-modern-body">
        <form method="POST" action="{{ route('admin.fakultas.update', $fakultas) }}" class="form-modern">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Kode Fakultas</label>
                    <input type="text" name="kode_fakultas" class="form-control @error('kode_fakultas') is-invalid @enderror" value="{{ old('kode_fakultas', $fakultas->kode_fakultas) }}" required>
                    @error('kode_fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Fakultas</label>
                    <input type="text" name="nama_fakultas" class="form-control @error('nama_fakultas') is-invalid @enderror" value="{{ old('nama_fakultas', $fakultas->nama_fakultas) }}" required>
                    @error('nama_fakultas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-modern btn-primary"><i class="bi bi-floppy"></i> Update</button>
                <a href="{{ route('admin.fakultas.index') }}" class="btn-modern btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
