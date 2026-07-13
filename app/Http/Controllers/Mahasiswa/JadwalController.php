<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $jadwal = Jadwal::with(['mataKuliah', 'dosen', 'ruangan', 'semester.tahunAjaran'])
            ->whereHas('mataKuliah', function ($q) use ($mahasiswa) {
                $q->where('program_studi_id', $mahasiswa->program_studi_id);
            })
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('mahasiswa.jadwal.index', compact('jadwal'));
    }
}
