<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfilKampusController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KrsController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\BukuTamuController as AdminBukuTamuController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Mahasiswa\JadwalController as MahasiswaJadwalController;
use App\Http\Controllers\Mahasiswa\KrsController as MahasiswaKrsController;
use App\Http\Controllers\Mahasiswa\NilaiController as MahasiswaNilaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/profil-kampus', [ProfilKampusController::class, 'index'])->name('profil-kampus');
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/buku-tamu', [BukuTamuController::class, 'create'])->name('buku-tamu');
Route::post('/buku-tamu', [BukuTamuController::class, 'store']);

Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('/program-studi', [AkademikController::class, 'programStudi'])->name('program-studi');
    Route::get('/kalender', [AkademikController::class, 'kalender'])->name('kalender');
    Route::get('/jadwal-kuliah', [AkademikController::class, 'jadwalKuliah'])->name('jadwal-kuliah');
    Route::get('/informasi', [AkademikController::class, 'informasi'])->name('informasi');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('role:mahasiswa')->group(function () {
        Route::get('jadwal', [MahasiswaJadwalController::class, 'index'])->name('jadwal');
        Route::get('krs', [MahasiswaKrsController::class, 'index'])->name('krs.index');
        Route::get('krs/create', [MahasiswaKrsController::class, 'create'])->name('krs.create');
        Route::post('krs', [MahasiswaKrsController::class, 'store'])->name('krs.store');
        Route::get('krs/{krs}', [MahasiswaKrsController::class, 'show'])->name('krs.show');
        Route::post('krs/{krs}/add-matkul', [MahasiswaKrsController::class, 'addMatkul'])->name('krs.add-matkul');
        Route::delete('krs/detail/{detail}', [MahasiswaKrsController::class, 'removeMatkul'])->name('krs.remove-matkul');
        Route::get('nilai', [MahasiswaNilaiController::class, 'index'])->name('nilai');
    });

    Route::prefix('admin')->name('admin.')->middleware('role:super_admin,admin_fakultas,admin_prodi')->group(function () {
        Route::resource('fakultas', FakultasController::class);
        Route::resource('program-studi', ProgramStudiController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('dosen', DosenController::class);
        Route::resource('mata-kuliah', MataKuliahController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('tahun-ajaran', TahunAjaranController::class)->except(['show']);
        Route::post('tahun-ajaran/{tahunAjaran}/activate', [TahunAjaranController::class, 'activate'])->name('tahun-ajaran.activate');
        Route::resource('semester', SemesterController::class)->except(['show']);
        Route::post('semester/{semester}/activate', [SemesterController::class, 'activate'])->name('semester.activate');
        Route::resource('jadwal', JadwalController::class);
        Route::get('krs', [KrsController::class, 'index'])->name('krs.index');
        Route::get('krs/create', [KrsController::class, 'create'])->name('krs.create');
        Route::post('krs', [KrsController::class, 'store'])->name('krs.store');
        Route::get('krs/{krs}', [KrsController::class, 'show'])->name('krs.show');
        Route::delete('krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
        Route::post('krs/{krs}/add-matkul', [KrsController::class, 'addMatkul'])->name('krs.add-matkul');
        Route::delete('krs/detail/{detail}', [KrsController::class, 'removeMatkul'])->name('krs.remove-matkul');
        Route::post('krs/{krs}/approve', [KrsController::class, 'approve'])->name('krs.approve');
        Route::resource('nilai', NilaiController::class);
        Route::resource('buku-tamu', AdminBukuTamuController::class)->only(['index', 'destroy']);
        Route::resource('galeri', AdminGaleriController::class);
    });
});
