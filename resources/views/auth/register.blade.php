@extends('layouts.auth')

@section('title', 'Register - SIAKAD Universitas Al-Khairiyah')

@section('content')
<div class="auth-split">
    <div class="auth-gallery">
        <div id="authSlider" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false">
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">
                    <div class="auth-slide" style="background-image: url('/images/gedung-kampus.jpg'); background-size: cover; background-position: center;">
                        <div class="auth-slide-overlay"></div>
                        <div class="auth-slide-content">
                            <h2 class="auth-slide-headline">Mewujudkan Generasi Unggul dan Berdaya Saing</h2>
                            <p class="auth-slide-sub">Kampus Pusat Universitas Al-Khairiyah</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="auth-slide" style="background-image: url('/images/wisuda.jpg'); background-size: cover; background-position: center;">
                        <div class="auth-slide-overlay"></div>
                        <div class="auth-slide-content">
                            <h2 class="auth-slide-headline">Digital Academic Experience</h2>
                            <p class="auth-slide-sub">Wisuda Universitas Al-Khairiyah</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="auth-slide" style="background-image: url('/images/seminar.jpg'); background-size: cover; background-position: center;">
                        <div class="auth-slide-overlay"></div>
                        <div class="auth-slide-content">
                            <h2 class="auth-slide-headline">Belajar, Berkembang, Berprestasi</h2>
                            <p class="auth-slide-sub">Seminar Akademik Nasional</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="auth-slide" style="background-image: url('/images/mahasiswa-belajar.jpg'); background-size: cover; background-position: center;">
                        <div class="auth-slide-overlay"></div>
                        <div class="auth-slide-content">
                            <h2 class="auth-slide-headline">Kampus Modern untuk Masa Depan Digital</h2>
                            <p class="auth-slide-sub">Mahasiswa Universitas Al-Khairiyah</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="auth-slide" style="background-image: url('/images/organisasi.jpg'); background-size: cover; background-position: center;">
                        <div class="auth-slide-overlay"></div>
                        <div class="auth-slide-content">
                            <h2 class="auth-slide-headline">Membangun Pemimpin Masa Depan</h2>
                            <p class="auth-slide-sub">Organisasi Kemahasiswaan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="auth-slider-indicators">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#authSlider" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#authSlider" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#authSlider" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#authSlider" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#authSlider" data-bs-slide-to="4"></button>
                </div>
            </div>
        </div>

    </div>

    <div class="auth-form">
        <div class="auth-card">
            <div class="auth-card-brand">
                <img src="/images/logo.jpg" alt="Unival" height="55" class="d-block mx-auto mb-2">
                <h5 class="fw-bold mb-1" style="color: #001B4D;">Universitas Al-Khairiyah</h5>
                <small style="color: #6B7280;">Sistem Informasi Akademik</small>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-3">
                @csrf

                <div class="mb-2">
                    <label for="name" class="auth-label">Nama Lengkap</label>
                    <input type="text" class="auth-input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="email" class="auth-label">Email</label>
                    <input type="email" class="auth-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <label for="password" class="auth-label">Password</label>
                        <input type="password" class="auth-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Min. 8 karakter" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="auth-label">Konfirmasi</label>
                        <input type="password" class="auth-input" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                </div>

                <input type="hidden" name="role" value="mahasiswa">

                <button type="submit" class="auth-btn">Daftar</button>
            </form>

            <p class="text-center mt-3 mb-0" style="color: #6B7280; font-size: 0.9rem;">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="auth-link fw-semibold">Login</a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const card = document.querySelector('.auth-card');
    if (card) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px) scale(0.95)';
        requestAnimationFrame(() => {
            card.style.transition = 'all 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0) scale(1)';
        });
    }
});
</script>
@endpush
@endsection