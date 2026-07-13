<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\ProgramStudi;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Nilai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $mahasiswaPerProdi = ProgramStudi::withCount('mahasiswa')->get();

            $recentMahasiswa = Mahasiswa::latest()->take(5)->get();
            $recentJadwal = Jadwal::with('mataKuliah')->latest()->take(5)->get();

            return view('dashboard.admin', [
                'totalFakultas' => Fakultas::count(),
                'totalProdi' => ProgramStudi::count(),
                'totalMahasiswa' => Mahasiswa::count(),
                'totalDosen' => Dosen::count(),
                'totalMatakuliah' => MataKuliah::count(),
                'totalRuangan' => Ruangan::count(),
                'totalTahunAjaran' => TahunAjaran::count(),
                'totalSemester' => Semester::count(),
                'totalJadwal' => Jadwal::count(),
                'totalKrs' => Krs::count(),
                'totalNilai' => Nilai::count(),
                'mahasiswaPerProdi' => $mahasiswaPerProdi,
                'recentMahasiswa' => $recentMahasiswa,
                'recentJadwal' => $recentJadwal,
            ]);
        }

        if ($user->isAdminFakultas() || $user->isAdminProdi()) {
            $fakultasId = $user->fakultas_id;
            $fakultas = $user->fakultas;

            $totalProdi = ProgramStudi::where('fakultas_id', $fakultasId)->count();
            $totalDosen = Dosen::whereHas('programStudi', fn($q) => $q->where('fakultas_id', $fakultasId))->count();
            $totalMahasiswa = Mahasiswa::whereHas('programStudi', fn($q) => $q->where('fakultas_id', $fakultasId))->count();
            $totalMatakuliah = MataKuliah::whereHas('programStudi', fn($q) => $q->where('fakultas_id', $fakultasId))->count();
            $totalJadwal = Jadwal::whereHas('mataKuliah.programStudi', fn($q) => $q->where('fakultas_id', $fakultasId))->count();
            $totalKrs = Krs::whereHas('mahasiswa.programStudi', fn($q) => $q->where('fakultas_id', $fakultasId))->count();

            return view('dashboard.admin-fakultas', compact(
                'fakultas', 'totalProdi', 'totalDosen', 'totalMahasiswa',
                'totalMatakuliah', 'totalJadwal', 'totalKrs'
            ));
        }

        if ($user->isMahasiswa()) {
            $mahasiswa = $user->mahasiswa()->with('programStudi')->first();

            if (!$mahasiswa) {
                return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
            }

            $krs = Krs::where('mahasiswa_id', $mahasiswa->id)->with('semester.tahunAjaran', 'detail.mataKuliah')->latest()->get();
            $nilai = Nilai::where('mahasiswa_id', $mahasiswa->id)->with('mataKuliah', 'semester.tahunAjaran')->get();
            $semesterAktif = Semester::with('tahunAjaran')->where('is_active', true)->first();

            $krsDisetujui = Krs::where('mahasiswa_id', $mahasiswa->id)->where('status', 'disetujui')->with('detail.mataKuliah')->get();
            $totalSks = $krsDisetujui->sum(fn($k) => $k->detail->sum(fn($d) => $d->mataKuliah->sks ?? 0));

            $totalBobot = 0;
            $totalSksNilai = 0;
            foreach ($nilai as $n) {
                if ($n->nilai_akhir && $n->mataKuliah) {
                    $totalBobot += $n->nilai_akhir * $n->mataKuliah->sks;
                    $totalSksNilai += $n->mataKuliah->sks;
                }
            }
            $ipk = $totalSksNilai > 0 ? round($totalBobot / $totalSksNilai, 2) : 0;

            $hariIndo = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'];
            $hariIni = $hariIndo[now()->format('l')];

            $jadwalHariIni = Jadwal::with(['mataKuliah', 'dosen', 'ruangan'])
                ->whereHas('mataKuliah', fn($q) => $q->where('program_studi_id', $mahasiswa->program_studi_id))
                ->where('hari', $hariIni)
                ->orderBy('jam_mulai')
                ->get();

            $krsAktif = $semesterAktif
                ? Krs::where('mahasiswa_id', $mahasiswa->id)->where('semester_id', $semesterAktif->id)->with('detail.mataKuliah', 'semester.tahunAjaran')->first()
                : null;

            return view('dashboard.mahasiswa', compact(
                'mahasiswa', 'krs', 'nilai', 'semesterAktif', 'totalSks',
                'ipk', 'jadwalHariIni', 'krsAktif', 'hariIni'
            ));
        }

        return redirect('/');
    }
}
