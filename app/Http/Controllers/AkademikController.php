<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkademikController extends Controller
{
    public function programStudi()
    {
        $programStudi = \App\Models\ProgramStudi::with('fakultas')->get();
        return view('akademik.program-studi', compact('programStudi'));
    }

    public function kalenderAkademik()
    {
        return view('akademik.kalender');
    }

    public function jadwalKuliah()
    {
        return view('akademik.jadwal-kuliah');
    }

    public function informasiAkademik()
    {
        return view('akademik.informasi');
    }
}
