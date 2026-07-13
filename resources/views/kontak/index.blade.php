@extends('layouts.main')

@section('title', 'Kontak - Universitas Al-Khairiyah')

@section('content')
<div class="profile-header">
    <div class="container">
        <h2 class="fw-bold mb-2">Kontak</h2>
        <p class="text-white-50 mb-0">Hubungi Universitas Al-Khairiyah</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Informasi Kontak</h5>
                    <hr>
                    <div class="d-flex mb-3">
                        <div class="me-3" style="font-size: 1.5rem;">📍</div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="text-muted mb-0">Jl. Raya Cilegon, Kota Cilegon, Banten 42435</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3" style="font-size: 1.5rem;">📞</div>
                        <div>
                            <h6 class="fw-bold mb-1">Telepon</h6>
                            <p class="text-muted mb-0">(0254) 123456</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3" style="font-size: 1.5rem;">📧</div>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <p class="text-muted mb-0">info@unival.ac.id</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3" style="font-size: 1.5rem;">🌐</div>
                        <div>
                            <h6 class="fw-bold mb-1">Website</h6>
                            <p class="text-muted mb-0">https://unival.ac.id</p>
                        </div>
                    </div>
                    <hr>
                    <h6 class="fw-bold">Jam Operasional</h6>
                    <p class="text-muted small mb-1"><strong>Senin - Jumat:</strong> 08:00 - 16:00 WIB</p>
                    <p class="text-muted small mb-1"><strong>Sabtu:</strong> 08:00 - 14:00 WIB</p>
                    <p class="text-muted small mb-0"><strong>Minggu:</strong> Libur</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Form Hubungi Kami</h5>
                    <hr>
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email Anda">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Subjek</label>
                                <input type="text" class="form-control" placeholder="Subjek pesan">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..."></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-navy">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-4 text-center text-muted">
                    <h5 class="fw-bold">Peta Lokasi</h5>
                    <hr>
                    <div style="width: 100%; height: 250px; background: linear-gradient(135deg, var(--navy-dark), var(--navy-primary)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fff;">
                        <div>
                            <div style="font-size: 3rem;">🗺️</div>
                            <p class="mb-0 mt-2">Jl. Raya Cilegon, Kota Cilegon, Banten</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
