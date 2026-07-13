@extends('layouts.main')

@section('title', 'Jadwal Kuliah - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <h2 class="fw-bold mb-2">Jadwal Kuliah</h2>
        <p class="text-white-50 mb-0">Informasi jadwal perkuliahan Semester Ganjil 2026/2027</p>
    </div>
</div>

<div class="container py-5">
    <div class="alert alert-info">
        <strong>Informasi:</strong> Mahasiswa dapat melihat jadwal kuliah lengkap setelah login ke dashboard.
    </div>
    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Ruangan</th>
                            <th>Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $dummyJadwal = [
                                ['Senin', 'Pemrograman Web', 'Dr. Ahmad Syarif, M.Kom.', 'Lab. Komputer A', '08:00 - 10:00'],
                                ['Senin', 'Basis Data', 'Dr. Rina Marlina, M.Kom.', 'Lab. Komputer B', '10:00 - 12:00'],
                                ['Selasa', 'Jaringan Komputer', 'M. Rizki, S.Kom., M.T.', 'Lab. Jaringan', '08:00 - 10:00'],
                                ['Selasa', 'Struktur Data', 'Dr. Ahmad Syarif, M.Kom.', 'Ruang 301', '13:00 - 15:00'],
                                ['Rabu', 'Sistem Operasi', 'Dewi Lestari, S.Kom., M.Kom.', 'Lab. Komputer A', '08:00 - 10:00'],
                                ['Rabu', 'Matematika Diskrit', 'Dr. H. Agus Salim, M.Pd.', 'Ruang 302', '10:00 - 12:00'],
                                ['Kamis', 'Pemrograman Mobile', 'M. Rizki, S.Kom., M.T.', 'Lab. Komputer B', '08:00 - 10:00'],
                                ['Kamis', 'Rekayasa Perangkat Lunak', 'Dewi Lestari, S.Kom., M.Kom.', 'Ruang 301', '13:00 - 15:00'],
                                ['Jumat', 'Statistika', 'Dr. H. Agus Salim, M.Pd.', 'Ruang 302', '08:00 - 10:00'],
                                ['Jumat', 'Praktikum Basis Data', 'Dr. Rina Marlina, M.Kom.', 'Lab. Komputer A', '10:00 - 12:00'],
                            ];
                        @endphp
                        @foreach($dummyJadwal as $j)
                        <tr>
                            <td>{{ $j[0] }}</td>
                            <td>{{ $j[1] }}</td>
                            <td>{{ $j[2] }}</td>
                            <td>{{ $j[3] }}</td>
                            <td>{{ $j[4] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
