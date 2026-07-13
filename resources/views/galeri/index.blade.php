@extends('layouts.main')

@section('title', 'Galeri - SIAKAD Unival')

@section('content')
<div class="container">
    <h4 class="mb-4">Galeri</h4>

    @if($galeri->isEmpty())
        <p class="text-muted">Belum ada foto.</p>
    @else
        <div class="row">
            @foreach($galeri as $g)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ Storage::url($g->foto) }}" class="card-img-top" alt="{{ $g->judul }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $g->judul }}</h5>
                        @if($g->deskripsi)
                            <p class="card-text text-muted">{{ $g->deskripsi }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
