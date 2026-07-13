@extends('layouts.main')

@section('title', 'Profil Kampus - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <h2 class="fw-bold mb-2">Profil Kampus</h2>
        <p class="text-white-50 mb-0">Mengenal lebih dekat Universitas Al-Khairiyah</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <h4 class="section-title">Sejarah Universitas Al-Khairiyah</h4>
            <p>Universitas Al-Khairiyah didirikan pada tahun 1990 oleh Yayasan Pendidikan Al-Khairiyah sebagai bentuk komitmen dalam mencerdaskan kehidupan bangsa. Berawal dari sebuah Sekolah Tinggi Ilmu Pendidikan (STIP) yang kemudian berkembang menjadi universitas dengan berbagai fakultas dan program studi unggulan.</p>
            <p>Sejak awal berdiri, Universitas Al-Khairiyah berkomitmen untuk menjadi institusi pendidikan tinggi yang unggul dalam pengembangan ilmu pengetahuan, teknologi, dan seni yang berlandaskan nilai-nilai keislaman dan kearifan lokal.</p>
            <p>Hingga saat ini, Universitas Al-Khairiyah telah meluluskan ribuan alumni yang tersebar di berbagai sektor dan profesi, baik di tingkat nasional maupun internasional.</p>

            <h4 class="section-title mt-5">Visi</h4>
            <div class="glass-card mb-4" style="background: linear-gradient(135deg, var(--navy-dark), var(--navy-primary));">
                <p class="text-white mb-0 fst-italic" style="font-size: 1.05rem;">
                    "Menjadi Universitas Unggul dan Berdaya Saing Global Berbasis Nilai-Nilai Keislaman pada Tahun 2035"
                </p>
            </div>

            <h4 class="section-title">Misi</h4>
            <ol class="list-group list-group-numbered mb-4">
                <li class="list-group-item border-0 ps-0">Menyelenggarakan pendidikan tinggi yang bermutu dan relevan dengan kebutuhan masyarakat.</li>
                <li class="list-group-item border-0 ps-0">Melaksanakan penelitian yang inovatif dan bermanfaat bagi pengembangan ilmu pengetahuan.</li>
                <li class="list-group-item border-0 ps-0">Melaksanakan pengabdian kepada masyarakat sebagai implementasi tri dharma perguruan tinggi.</li>
                <li class="list-group-item border-0 ps-0">Mengembangkan tata kelola universitas yang profesional, transparan, dan akuntabel.</li>
                <li class="list-group-item border-0 ps-0">Memperkuat jejaring kerjasama dengan berbagai institusi di tingkat nasional dan internasional.</li>
            </ol>

            <h4 class="section-title">Sambutan Pimpinan</h4>
            <div class="card mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="display-4">👤</div>
                        <div>
                            <h5 class="fw-bold">Prof. Dr. H. Ahmad Fauzi, M.Pd.</h5>
                            <p class="text-muted small">Rektor Universitas Al-Khairiyah</p>
                            <hr>
                            <p class="text-muted">Assalamu&rsquo;alaikum Warahmatullahi Wabarakatuh,</p>
                            <p>Puji syukur ke hadirat Allah SWT atas segala rahmat dan karunia-Nya sehingga Sistem Informasi Akademik (SIAKAD) Universitas Al-Khairiyah dapat hadir sebagai layanan digital bagi seluruh sivitas akademika.</p>
                            <p>SIAKAD Unival merupakan wujud komitmen kami dalam meningkatkan kualitas layanan akademik melalui transformasi digital. Kami berharap platform ini dapat memudahkan mahasiswa, dosen, dan tenaga kependidikan dalam mengakses informasi dan layanan akademik secara cepat, tepat, dan transparan.</p>
                            <p>Kami terus berupaya mengembangkan dan meningkatkan kualitas SIAKAD agar dapat memenuhi kebutuhan seluruh pengguna. Masukan dan saran dari sivitas akademika sangat berarti bagi perbaikan berkelanjutan.</p>
                            <p>Wassalamu&rsquo;alaikum Warahmatullahi Wabarakatuh,</p>
                            <p class="fw-bold mb-0">Prof. Dr. H. Ahmad Fauzi, M.Pd.</p>
                            <p class="text-muted small">Rektor</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-navy mb-4">
                <div class="card-body text-center p-4">
                    <div class="display-3 mb-2">🏛️</div>
                    <h5 class="fw-bold">Universitas Al-Khairiyah</h5>
                    <hr style="border-color: var(--glass-border);">
                    <p class="small text-white-50 mb-1"><strong>Berdiri:</strong> 1990</p>
                    <p class="small text-white-50 mb-1"><strong>Akreditasi:</strong> B (BAN-PT)</p>
                    <p class="small text-white-50 mb-1"><strong>Jumlah Fakultas:</strong> 5</p>
                    <p class="small text-white-50 mb-0"><strong>Jumlah Prodi:</strong> 15</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Struktur Organisasi</h5>
                    <hr>
                    <ul class="list-unstyled">
                        <li class="mb-2"><strong>Rektor</strong><br><span class="text-muted small">Prof. Dr. H. Ahmad Fauzi, M.Pd.</span></li>
                        <li class="mb-2"><strong>Wakil Rektor I</strong><br><span class="text-muted small">Dr. Hj. Siti Nurjanah, M.Si.</span></li>
                        <li class="mb-2"><strong>Wakil Rektor II</strong><br><span class="text-muted small">Dr. H. Bambang Susilo, M.M.</span></li>
                        <li class="mb-2"><strong>Wakil Rektor III</strong><br><span class="text-muted small">Dr. H. Rudi Hartono, M.Pd.</span></li>
                        <li class="mb-2"><strong>Dekan FTI</strong><br><span class="text-muted small">Dr. Ir. Ahmad Syarif, M.Kom.</span></li>
                        <li class="mb-2"><strong>Dekan FEB</strong><br><span class="text-muted small">Dr. Hj. Dewi Sartika, S.E., M.Si.</span></li>
                        <li class="mb-2"><strong>Dekan FKIP</strong><br><span class="text-muted small">Dr. H. Agus Salim, M.Pd.</span></li>
                        <li class="mb-2"><strong>Dekan FH</strong><br><span class="text-muted small">Dr. H. Yusuf Wibisono, S.H., M.H.</span></li>
                        <li class="mb-0"><strong>Dekan FAI</strong><br><span class="text-muted small">Dr. H. Hasan Basri, M.Ag.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
