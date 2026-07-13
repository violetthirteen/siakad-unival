@extends('layouts.main')

@section('title', 'Pengumuman - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <h2 class="fw-bold mb-2">Pengumuman</h2>
        <p class="text-white-50 mb-0">Informasi terbaru dari Universitas Al-Khairiyah</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @foreach($pengumuman as $item)
            <div class="card announcement-card mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge badge-gold">{{ $item->kategori }}</span>
                        <small class="text-muted">{{ $item->tanggal }}</small>
                    </div>
                    <h5 class="fw-bold">{{ $item->judul }}</h5>
                    <p class="text-muted small mb-3">{{ $item->penulis }}</p>
                    <p class="text-muted mb-3">{{ Str::limit($item->isi, 200) }}</p>
                    <a href="{{ route('pengumuman.show', $item->id) }}" class="btn btn-navy btn-sm">Baca Selengkapnya</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
