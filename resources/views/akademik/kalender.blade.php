@extends('layouts.main')

@section('title', 'Kalender Akademik - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <h2 class="fw-bold mb-2">Kalender Akademik</h2>
        <p class="text-white-50 mb-0">Tahun Akademik 2026/2027</p>
    </div>
</div>

<div class="container py-5">
    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $kalender = [
                                ['Pendaftaran Mahasiswa Baru', 'Januari - Maret 2026', 'Gelombang I'],
                                ['Pendaftaran Mahasiswa Baru', 'April - Juni 2026', 'Gelombang II'],
                                ['Pengumuman Hasil Seleksi', '15 Juni 2026', 'SPMB'],
                                ['Daftar Ulang Mahasiswa Baru', '20 - 25 Juni 2026', 'Registrasi'],
                                ['Awal Perkuliahan Semester Ganjil', '1 Juli 2026', 'Semester Ganjil'],
                                ['Masa Pengisian KRS', '15 - 30 Juni 2026', 'KRS Online'],
                                ['Ujian Tengah Semester (UTS)', '16 - 20 September 2026', 'UTS Ganjil'],
                                ['Ujian Akhir Semester (UAS)', '11 - 15 Desember 2026', 'UAS Ganjil'],
                                ['Libur Semester Ganjil', '16 Desember 2026 - 5 Januari 2027', 'Libur'],
                                ['Awal Perkuliahan Semester Genap', '10 Januari 2027', 'Semester Genap'],
                                ['Ujian Tengah Semester (UTS) Genap', '17 - 21 Maret 2027', 'UTS Genap'],
                                ['Ujian Akhir Semester (UAS) Genap', '16 - 20 Juni 2027', 'UAS Genap'],
                                ['Wisuda Periode I', '28 Februari 2027', 'Wisuda'],
                                ['Wisuda Periode II', '30 Juli 2027', 'Wisuda'],
                            ];
                        @endphp
                        @foreach($kalender as $i => $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k[0] }}</td>
                            <td>{{ $k[1] }}</td>
                            <td>{{ $k[2] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
