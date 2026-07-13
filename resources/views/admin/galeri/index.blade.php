@extends('layouts.admin')
@section('title', 'Galeri - Admin - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Galeri</h1>
        <p>Kelola foto galeri kampus</p>
    </div>
    <a href="{{ route('admin.galeri.create') }}" class="btn-modern btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Foto
    </a>
</div>

@if(session('success'))
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

@forelse($galeri as $g)
<div class="card-modern mb-3">
    <div class="card-modern-body" style="display:flex;gap:1.25rem;align-items:start;">
        <img src="{{ Storage::url($g->foto) }}" style="width:200px;height:140px;object-fit:cover;border-radius:var(--s-radius-sm);flex-shrink:0;">
        <div style="flex:1;">
            <h5 style="margin:0 0 0.35rem;font-weight:600;">{{ $g->judul }}</h5>
            <p style="margin:0 0 1rem;color:var(--s-text-muted);font-size:0.85rem;">{{ Str::limit($g->deskripsi, 100) }}</p>
            <div style="display:flex;gap:0.5rem;">
                <a href="{{ route('admin.galeri.edit', $g) }}" class="btn-modern btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                <form method="POST" action="{{ route('admin.galeri.destroy', $g) }}" onsubmit="return confirm('Yakin hapus foto ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-modern btn-danger btn-sm"><i class="bi bi-trash3"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@empty
<div class="card-modern">
    <div class="card-modern-body">
        <div class="empty-state">
            <div class="empty-state-icon"><i class="bi bi-images-slash"></i></div>
            <h5>Belum Ada Foto</h5>
            <p>Galeri foto masih kosong.</p>
            <a href="{{ route('admin.galeri.create') }}" class="btn-modern btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Foto
            </a>
        </div>
    </div>
</div>
@endforelse
@endsection
