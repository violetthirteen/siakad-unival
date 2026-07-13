@extends('layouts.main')

@section('title', 'Informasi Akademik - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <h2 class="fw-bold mb-2">Informasi Akademik</h2>
        <p class="text-white-50 mb-0">Panduan dan informasi seputar perkuliahan</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold">📋 Kalender Akademik</h5>
                    <hr>
                    <p class="text-muted">Informasi lengkap mengenai jadwal kegiatan akademik selama satu tahun ajaran, termasuk jadwal perkuliahan, ujian, dan libur akademik.</p>
                    <a href="{{ route('akademik.kalender') }}" class="btn btn-navy btn-sm">Lihat Kalender</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold">📚 Panduan Akademik</h5>
                    <hr>
                    <p class="text-muted">Buku panduan akademik berisi peraturan akademik, kurikulum, tata cara pengisian KRS, dan informasi penting lainnya bagi mahasiswa.</p>
                    <a href="#" class="btn btn-navy btn-sm">Download Panduan</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold"><img src="/images/logo.jpg" alt="" height="24" class="me-2" style="border-radius: 4px;">Pedoman Skripsi</h5>
                    <hr>
                    <p class="text-muted">Panduan penulisan skripsi dan tugas akhir bagi mahasiswa program sarjana, termasuk format, tata cara, dan prosedur sidang.</p>
                    <a href="#" class="btn btn-navy btn-sm">Download Pedoman</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold">💳 Biaya Pendidikan</h5>
                    <hr>
                    <p class="text-muted">Informasi mengenai biaya pendidikan, UKT, SPP, dan mekanisme pembayaran serta beasiswa yang tersedia.</p>
                    <a href="#" class="btn btn-navy btn-sm">Lihat Informasi</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body p-4">
            <h5 class="fw-bold">Syarat dan Ketentuan Akademik</h5>
            <hr>
            <ul class="text-muted">
                <li class="mb-2">Mahasiswa wajib mengisi KRS pada setiap awal semester sesuai jadwal yang ditentukan.</li>
                <li class="mb-2">Kehadiran perkuliahan minimal 75% untuk dapat mengikuti Ujian Akhir Semester.</li>
                <li class="mb-2">Mahasiswa dapat mengambil maksimal 24 SKS per semester dengan IPK minimal 3.00.</li>
                <li class="mb-2">Nilai kelulusan minimal adalah C untuk setiap mata kuliah.</li>
                <li class="mb-2">Mahasiswa dinyatakan lulus jika telah menyelesaikan minimal 144 SKS dengan IPK minimal 2.00.</li>
                <li class="mb-0">Masa studi maksimal untuk program S1 adalah 14 semester (7 tahun).</li>
            </ul>
        </div>
    </div>
</div>
@endsection
