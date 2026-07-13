@extends('layouts.main')

@section('title', 'Beranda - SIAKAD Universitas Al-Khairiyah')

@section('content')
<div class="page-transition-overlay" id="pageTransitionOverlay"></div>
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="hero-title">Sistem Informasi Akademik<br><span>Universitas Al-Khairiyah</span></h1>
                <p class="hero-subtitle mt-3 mb-4">Portal akademik terintegrasi untuk mendukung kegiatan perkuliahan, administrasi akademik, dan layanan kemahasiswaan secara digital.</p>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-gold btn-lg me-2 px-4">Masuk Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-gold btn-lg me-2 px-4">Login Sistem</a>
                    <a href="{{ route('register') }}" class="btn btn-navy btn-lg px-4">Daftar Akun</a>
                @endauth
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <div class="glass-card d-inline-block">
                    <img src="/images/logo.jpg" alt="Unival" height="72" class="mb-2" style="filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));">
                    <h5 class="text-white mb-0">SIAKAD Unival</h5>
                    <p class="small text-white-50 mb-0">Modern · Terintegrasi · Terpercaya</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="coverflow-wrapper">
                    <div class="coverflow-track" id="coverflowTrack">
                        <div class="coverflow-item active" data-caption="Gedung Universitas Al-Khairiyah">
                            <img src="/images/fasilitas-gedung.jpg" alt="Gedung">
                            <div class="coverflow-caption">Gedung Universitas Al-Khairiyah</div>
                        </div>
                        <div class="coverflow-item" data-caption="Perpustakaan Universitas Al-Khairiyah">
                            <img src="/images/fasilitas-perpustakaan.jpg" alt="Perpustakaan">
                            <div class="coverflow-caption">Perpustakaan Universitas Al-Khairiyah</div>
                        </div>
                        <div class="coverflow-item" data-caption="Laboratorium Universitas Al-Khairiyah">
                            <img src="/images/fasilitas-lab.jpg" alt="Laboratorium">
                            <div class="coverflow-caption">Laboratorium Universitas Al-Khairiyah</div>
                        </div>
                        <div class="coverflow-item" data-caption="Masjid Universitas Al-Khairiyah">
                            <img src="/images/fasilitas-masjid.jpg" alt="Masjid">
                            <div class="coverflow-caption">Masjid Universitas Al-Khairiyah</div>
                        </div>
                        <div class="coverflow-item" data-caption="Aula Universitas Al-Khairiyah">
                            <img src="/images/fasilitas-aula.jpg" alt="Aula">
                            <div class="coverflow-caption">Aula Universitas Al-Khairiyah</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <h4 class="section-title">Tentang Universitas Al-Khairiyah</h4>
                <p class="text-muted">Universitas Al-Khairiyah adalah perguruan tinggi swasta yang berkedudukan di Kota Cilegon, Banten. Berdiri sejak tahun 2005, universitas ini berkomitmen untuk mencetak generasi unggul yang berakhlak mulia, berilmu pengetahuan, dan berdaya saing global.</p>
                <div class="mt-4">
                    <div class="vision-box">
                        <h6 class="fw-bold" style="color: var(--navy-dark);">Visi</h6>
                        <p class="text-muted small">Menjadi universitas unggul dalam pengembangan ilmu pengetahuan, teknologi, dan seni yang berlandaskan nilai-nilai keislaman pada tahun 2035.</p>
                    </div>
                    <div class="vision-box mt-3">
                        <h6 class="fw-bold" style="color: var(--navy-dark);">Misi</h6>
                        <p class="text-muted small">Menyelenggarakan pendidikan tinggi yang berkualitas, melaksanakan penelitian yang inovatif, dan melaksanakan pengabdian kepada masyarakat yang berkelanjutan.</p>
                    </div>
                </div>
                <a href="{{ route('profil-kampus') }}" class="btn btn-gold mt-3">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<section class="stats-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card text-center">
                    <div class="stat-number" data-target="2500">0</div>
                    <div class="stat-label">Mahasiswa Aktif</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card text-center">
                    <div class="stat-number" data-target="7">0</div>
                    <div class="stat-label">Program Studi</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card text-center">
                    <div class="stat-number" data-target="120">0</div>
                    <div class="stat-label">Dosen Tetap</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card text-center">
                    <div class="stat-number" data-target="2005">0</div>
                    <div class="stat-label">Tahun Berdiri</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="gallery-section py-5">
    <div class="container">
        <h4 class="section-title text-center">Galeri Kampus</h4>
        <p class="text-center text-muted mb-5">Jelajahi fasilitas unggulan Universitas Al-Khairiyah</p>
        <div id="campusCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#campusCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#campusCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#campusCarousel" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#campusCarousel" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#campusCarousel" data-bs-slide-to="4"></button>
            </div>
            <div class="carousel-inner rounded-4 overflow-hidden">
                <div class="carousel-item active">
                    <div class="gallery-slide" style="background-image: url('/images/fasilitas-gedung.jpg');">
                        <div class="gallery-slide-overlay"></div>
                        <div class="gallery-slide-content">
                            <h5>Gedung Utama</h5>
                            <p class="mb-0">Gedung pusat Universitas Al-Khairiyah yang megah dan representatif</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="gallery-slide" style="background-image: url('/images/fasilitas-perpustakaan.jpg');">
                        <div class="gallery-slide-overlay"></div>
                        <div class="gallery-slide-content">
                            <h5>Perpustakaan</h5>
                            <p class="mb-0">Perpustakaan modern dengan koleksi lengkap untuk mendukung akademik</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="gallery-slide" style="background-image: url('/images/fasilitas-lab.jpg');">
                        <div class="gallery-slide-overlay"></div>
                        <div class="gallery-slide-content">
                            <h5>Laboratorium Komputer</h5>
                            <p class="mb-0">Laboratorium komputer dengan perangkat terkini untuk praktik mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="gallery-slide" style="background-image: url('/images/fasilitas-masjid.jpg');">
                        <div class="gallery-slide-overlay"></div>
                        <div class="gallery-slide-content">
                            <h5>Masjid Kampus</h5>
                            <p class="mb-0">Tempat ibadah yang nyaman untuk civitas akademika</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="gallery-slide" style="background-image: url('/images/fasilitas-aula.jpg');">
                        <div class="gallery-slide-overlay"></div>
                        <div class="gallery-slide-content">
                            <h5>Aula Kampus</h5>
                            <p class="mb-0">Aula serbaguna untuk berbagai acara dan kegiatan kampus</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#campusCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#campusCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

<section class="cta-section py-5">
    <div class="container text-center">
        <h4 class="text-white fw-bold">Siap Bergabung?</h4>
        <p class="text-white-50 mb-4">Mulai perjalanan akademik Anda di Universitas Al-Khairiyah</p>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-gold btn-lg px-5">Masuk Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-gold btn-lg px-5">Masuk Dashboard</a>
        @endauth
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.stat-number');
    counters.forEach(counter => {
        const target = parseInt(counter.dataset.target);
        let current = 0;
        const increment = Math.ceil(target / 60);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                counter.textContent = current.toLocaleString();
            }
        }, 30);
    });

    const overlay = document.getElementById('pageTransitionOverlay');
    const triggers = document.querySelectorAll('.btn-gold.btn-lg[href*="login"], .btn-gold.btn-lg[href*="register"]');
    triggers.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            overlay.classList.add('active');
            setTimeout(function() {
                window.location.href = href;
            }, 600);
        });
    });

    /* ===== Cover Flow Carousel ===== */
    const track = document.getElementById('coverflowTrack');
    if (track) {
        const items = track.querySelectorAll('.coverflow-item');
        let activeIndex = 0;
        const total = items.length;
        let autoTimer;

        function positionItems() {
            const margin = 220;
            items.forEach((item, i) => {
                let offset = i - activeIndex;
                if (offset < -2) offset = total + offset;
                if (offset > 2) offset = offset - total;

                let scale, translateX, opacity, zIndex;
                if (offset === 0) {
                    scale = 1;
                    translateX = 0;
                    opacity = 1;
                    zIndex = 5;
                } else if (offset === 1 || offset === -1) {
                    scale = 0.78;
                    translateX = offset * margin;
                    opacity = 0.7;
                    zIndex = 4;
                } else if (offset === 2 || offset === -2) {
                    scale = 0.6;
                    translateX = offset * margin * 0.85;
                    opacity = 0.4;
                    zIndex = 3;
                } else {
                    scale = 0.4;
                    translateX = offset * margin * 0.5;
                    opacity = 0;
                    zIndex = 2;
                }

                item.style.transform = `translateX(${translateX}px) scale(${scale})`;
                item.style.opacity = opacity;
                item.style.zIndex = zIndex;
                item.classList.toggle('active', offset === 0);
            });
        }

        function nextSlide() {
            activeIndex = (activeIndex + 1) % total;
            positionItems();
        }

        function prevSlide() {
            activeIndex = (activeIndex - 1 + total) % total;
            positionItems();
        }

        function startAuto() {
            stopAuto();
            autoTimer = setInterval(nextSlide, 4000);
        }

        function stopAuto() {
            clearInterval(autoTimer);
        }

        items.forEach((item, i) => {
            item.addEventListener('click', function() {
                if (i === activeIndex) return;
                const diff = i - activeIndex;
                const steps = ((diff % total) + total) % total;
                const opposite = steps > total / 2;
                if (opposite) {
                    activeIndex = i;
                    positionItems();
                } else {
                    activeIndex = i;
                    positionItems();
                }
                stopAuto();
                setTimeout(startAuto, 8000);
            });
        });

        positionItems();
        startAuto();
    }
    /* ===== End Cover Flow ===== */
});
</script>
@endpush
@endsection