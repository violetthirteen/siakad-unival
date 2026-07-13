@extends('layouts.main')

@section('title', 'Program Studi - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <h2 class="fw-bold mb-2">Program Studi</h2>
        <p class="text-white-50 mb-0">Fakultas dan Program Studi di Universitas Al-Khairiyah</p>
    </div>
</div>

<div class="container py-5">
    @if($programStudi->isEmpty())
        <div class="row">
            @php $fakultasDummy = ['Fakultas Teknik dan Ilmu Komputer', 'Fakultas Ekonomi dan Bisnis', 'Fakultas Keguruan dan Ilmu Pendidikan', 'Fakultas Hukum', 'Fakultas Agama Islam']; @endphp
            @foreach($fakultasDummy as $f)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold">{{ $f }}</h5>
                        <hr>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2">Program Studi S1</li>
                            <li class="mb-2">Program Studi D3</li>
                            <li class="mb-0">Program Studi S2</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        @foreach($programStudi->groupBy('fakultas.nama_fakultas') as $fakultas => $prodi)
        <div class="card mb-4">
            <div class="card-header card-navy">
                <h5 class="fw-bold mb-0">{{ $fakultas }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Kode Prodi</th>
                                <th>Nama Prodi</th>
                                <th>Jenjang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prodi as $p)
                            <tr>
                                <td>{{ $p->kode_prodi }}</td>
                                <td>{{ $p->nama_prodi }}</td>
                                <td>{{ $p->jenjang }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
