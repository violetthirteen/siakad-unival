<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $nilai = Nilai::with(['mataKuliah', 'semester.tahunAjaran'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->orderBy('semester_id')
            ->get()
            ->groupBy(fn($n) => $n->semester->nama_semester . ' ' . $n->semester->tahunAjaran->tahun_awal . '/' . $n->semester->tahunAjaran->tahun_akhir);

        return view('mahasiswa.nilai.index', compact('nilai'));
    }
}
