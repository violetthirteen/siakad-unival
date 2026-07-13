<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = collect([
            (object) [
                'id' => 1,
                'judul' => 'Pengumuman Hasil Seleksi Mahasiswa Baru TA 2026/2027',
                'kategori' => 'Akademik',
                'tanggal' => '15 Juni 2026',
                'isi' => 'Dengan ini diumumkan hasil seleksi penerimaan mahasiswa baru Universitas Al-Khairiyah Tahun Akademik 2026/2027. Pengumuman dapat dilihat melalui portal resmi SIAKAD. Calon mahasiswa yang dinyatakan lulus diwajibkan melakukan daftar ulang pada tanggal 20-25 Juni 2026.',
                'penulis' => 'Biro Akademik',
            ],
            (object) [
                'id' => 2,
                'judul' => 'Jadwal Perkuliahan Semester Ganjil 2026/2027',
                'kategori' => 'Akademik',
                'tanggal' => '10 Juni 2026',
                'isi' => 'Jadwal perkuliahan Semester Ganjil Tahun Akademik 2026/2027 telah diterbitkan. Mahasiswa diharapkan untuk mengecek jadwal masing-masing melalui menu Jadwal Kuliah di SIAKAD. Perkuliahan akan dimulai pada tanggal 1 Juli 2026.',
                'penulis' => 'Biro Akademik',
            ],
            (object) [
                'id' => 3,
                'judul' => 'Pelaksanaan Wisuda Periode II Tahun 2026',
                'kategori' => 'Kemahasiswaan',
                'tanggal' => '5 Juni 2026',
                'isi' => 'Universitas Al-Khairiyah akan menyelenggarakan Wisuda Periode II Tahun 2026 pada tanggal 30 Juli 2026. Pendaftaran wisuda dibuka dari tanggal 1-15 Juli 2026. Persyaratan dan ketentuan dapat dilihat di portal SIAKAD.',
                'penulis' => 'Biro Kemahasiswaan',
            ],
            (object) [
                'id' => 4,
                'judul' => 'Beasiswa Prestasi Akademik Tahun 2026',
                'kategori' => 'Beasiswa',
                'tanggal' => '1 Juni 2026',
                'isi' => 'Universitas Al-Khairiyah membuka pendaftaran Beasiswa Prestasi Akademik bagi mahasiswa aktif dengan IPK minimal 3.50. Pendaftaran dibuka hingga 30 Juni 2026. Informasi lebih lanjut dapat menghubungi Biro Kemahasiswaan.',
                'penulis' => 'Biro Kemahasiswaan',
            ],
            (object) [
                'id' => 5,
                'judul' => 'Libur Hari Raya Idul Adha 1447 H',
                'kategori' => 'Umum',
                'tanggal' => '25 Mei 2026',
                'isi' => 'Diberitahukan kepada seluruh sivitas akademika bahwa kegiatan perkuliahan dan administrasi kampus libur dalam rangka Hari Raya Idul Adha 1447 H pada tanggal 28-30 Mei 2026. Kegiatan akan kembali normal pada tanggal 31 Mei 2026.',
                'penulis' => 'Rektorat',
            ],
        ]);

        return view('pengumuman.index', compact('pengumuman'));
    }

    public function show($id)
    {
        $pengumuman = collect([
            (object) [
                'id' => 1,
                'judul' => 'Pengumuman Hasil Seleksi Mahasiswa Baru TA 2026/2027',
                'kategori' => 'Akademik',
                'tanggal' => '15 Juni 2026',
                'isi' => 'Dengan ini diumumkan hasil seleksi penerimaan mahasiswa baru Universitas Al-Khairiyah Tahun Akademik 2026/2027. Pengumuman dapat dilihat melalui portal resmi SIAKAD. Calon mahasiswa yang dinyatakan lulus diwajibkan melakukan daftar ulang pada tanggal 20-25 Juni 2026. Berkas yang perlu dibawa saat daftar ulang: (1) Fotokopi Ijazah terlegalisir, (2) Fotokopi KTP, (3) Pas foto 3×4 sebanyak 4 lembar, (4) Bukti pembayaran daftar ulang. Daftar ulang dilaksanakan di Gedung Rektorat Lantai 1, Ruang Registrasi pada pukul 08.00 - 15.00 WIB.',
                'penulis' => 'Biro Akademik',
            ],
            (object) [
                'id' => 2,
                'judul' => 'Jadwal Perkuliahan Semester Ganjil 2026/2027',
                'kategori' => 'Akademik',
                'tanggal' => '10 Juni 2026',
                'isi' => 'Jadwal perkuliahan Semester Ganjil Tahun Akademik 2026/2027 telah diterbitkan. Mahasiswa diharapkan untuk mengecek jadwal masing-masing melalui menu Jadwal Kuliah di SIAKAD. Perkuliahan akan dimulai pada tanggal 1 Juli 2026.',
                'penulis' => 'Biro Akademik',
            ],
            (object) [
                'id' => 3,
                'judul' => 'Pelaksanaan Wisuda Periode II Tahun 2026',
                'kategori' => 'Kemahasiswaan',
                'tanggal' => '5 Juni 2026',
                'isi' => 'Universitas Al-Khairiyah akan menyelenggarakan Wisuda Periode II Tahun 2026 pada tanggal 30 Juli 2026. Pendaftaran wisuda dibuka dari tanggal 1-15 Juli 2026. Persyaratan dan ketentuan dapat dilihat di portal SIAKAD.',
                'penulis' => 'Biro Kemahasiswaan',
            ],
            (object) [
                'id' => 4,
                'judul' => 'Beasiswa Prestasi Akademik Tahun 2026',
                'kategori' => 'Beasiswa',
                'tanggal' => '1 Juni 2026',
                'isi' => 'Universitas Al-Khairiyah membuka pendaftaran Beasiswa Prestasi Akademik bagi mahasiswa aktif dengan IPK minimal 3.50. Pendaftaran dibuka hingga 30 Juni 2026. Informasi lebih lanjut dapat menghubungi Biro Kemahasiswaan.',
                'penulis' => 'Biro Kemahasiswaan',
            ],
            (object) [
                'id' => 5,
                'judul' => 'Libur Hari Raya Idul Adha 1447 H',
                'kategori' => 'Umum',
                'tanggal' => '25 Mei 2026',
                'isi' => 'Diberitahukan kepada seluruh sivitas akademika bahwa kegiatan perkuliahan dan administrasi kampus libur dalam rangka Hari Raya Idul Adha 1447 H pada tanggal 28-30 Mei 2026. Kegiatan akan kembali normal pada tanggal 31 Mei 2026.',
                'penulis' => 'Rektorat',
            ],
        ]);

        $item = $pengumuman->firstWhere('id', (int) $id);

        if (!$item) {
            abort(404);
        }

        return view('pengumuman.show', compact('item'));
    }
}
