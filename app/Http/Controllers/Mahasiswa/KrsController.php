<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\MataKuliah;
use App\Models\Semester;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $krs = Krs::with(['semester.tahunAjaran', 'detail.mataKuliah'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get();

        return view('mahasiswa.krs.index', compact('krs'));
    }

    public function create()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $semester = Semester::with('tahunAjaran')
            ->where('is_active', true)
            ->orWhereHas('tahunAjaran', fn($q) => $q->where('is_active', true))
            ->get();

        return view('mahasiswa.krs.create', compact('semester'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $request->validate([
            'semester_id' => 'required|exists:semester,id',
        ]);

        $exists = Krs::where('mahasiswa_id', $mahasiswa->id)
            ->where('semester_id', $request->semester_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'KRS untuk semester ini sudah ada.');
        }

        $krs = Krs::create([
            'mahasiswa_id' => $mahasiswa->id,
            'semester_id' => $request->semester_id,
            'tanggal_dibuat' => now(),
            'status' => 'draft',
        ]);

        return redirect()->route('mahasiswa.krs.show', $krs)->with('success', 'KRS berhasil dibuat.');
    }

    public function show(Krs $krs)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa || $krs->mahasiswa_id !== $mahasiswa->id) {
            abort(403);
        }

        $krs->load(['semester.tahunAjaran', 'detail.mataKuliah']);
        $mataKuliah = MataKuliah::where('program_studi_id', $mahasiswa->program_studi_id)
            ->where('semester', $krs->semester->nama_semester === 'Ganjil' ? 1 : 2)
            ->get();

        return view('mahasiswa.krs.show', compact('krs', 'mataKuliah'));
    }

    public function addMatkul(Request $request, Krs $krs)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        if (!$mahasiswa || $krs->mahasiswa_id !== $mahasiswa->id) {
            abort(403);
        }

        if ($krs->status !== 'draft') {
            return back()->with('error', 'Tidak dapat mengubah KRS yang sudah disetujui.');
        }

        $request->validate(['mata_kuliah_id' => 'required|exists:mata_kuliah,id']);

        $exists = KrsDetail::where('krs_id', $krs->id)
            ->where('mata_kuliah_id', $request->mata_kuliah_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mata kuliah sudah ada di KRS.');
        }

        KrsDetail::create([
            'krs_id' => $krs->id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
        ]);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function removeMatkul(KrsDetail $detail)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $krs = $detail->krs;

        if (!$mahasiswa || $krs->mahasiswa_id !== $mahasiswa->id) {
            abort(403);
        }

        if ($krs->status !== 'draft') {
            return back()->with('error', 'Tidak dapat mengubah KRS yang sudah disetujui.');
        }

        $detail->delete();
        return back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }
}
