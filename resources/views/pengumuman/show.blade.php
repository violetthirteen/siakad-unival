@extends('layouts.main')

@section('title', $item->judul . ' - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <a href="{{ route('pengumuman') }}" class="text-white-50 text-decoration-none small">&larr; Kembali ke Pengumuman</a>
        <h2 class="fw-bold mb-2 mt-2">Detail Pengumuman</h2>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge badge-gold">{{ $item->kategori }}</span>
                        <small class="text-muted">{{ $item->tanggal }}</small>
                    </div>
                    <h4 class="fw-bold mb-2">{{ $item->judul }}</h4>
                    <p class="text-muted small mb-4">Dipublikasikan oleh: {{ $item->penulis }}</p>
                    <hr>
                    <p class="lh-lg">{{ $item->isi }}</p>
                    <hr class="my-4">
                    <a href="{{ route('pengumuman') }}" class="btn btn-navy">&larr; Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
