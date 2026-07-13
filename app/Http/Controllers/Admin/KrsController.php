<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $query = Krs::with(['mahasiswa', 'semester.tahunAjaran']);
        $krs = $this->filterByFakultas($query)->latest()->get();
        return view('admin.krs.index', compact('krs'));
    }

    public function create()
    {
        $user = auth()->user();
        $q = Mahasiswa::where('status', 'aktif');
        $mahasiswa = $this->filterByFakultas($q)->get();
        $semester = Semester::with('tahunAjaran')->where('is_active', true)->orWhereHas('tahunAjaran', fn($q) => $q->where('is_active', true))->get();
        return view('admin.krs.create', compact('mahasiswa', 'semester'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'semester_id' => 'required|exists:semester,id',
        ]);

        $mhs = Mahasiswa::findOrFail($request->mahasiswa_id);
        $user = auth()->user();
        if ($user->isAdminFakultas()) {
            $prodi = $mhs->programStudi;
            if ($prodi->fakultas_id !== $user->fakultas_id) {
                abort(403);
            }
        }

        Krs::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'semester_id' => $request->semester_id,
            'tanggal_dibuat' => now(),
            'status' => 'draft',
        ]);

        return redirect()->route('admin.krs.index')->with('success', 'KRS berhasil dibuat.');
    }

    public function show(Krs $krs)
    {
        $this->filterByFakultas(Krs::where('id', $krs->id))->firstOrFail();

        $krs->load(['mahasiswa', 'semester.tahunAjaran', 'detail.mataKuliah']);
        $mataKuliah = MataKuliah::where('program_studi_id', $krs->mahasiswa->program_studi_id)
            ->where('semester', $krs->semester->nama_semester === 'Ganjil' ? 1 : 2)
            ->get();
        return view('admin.krs.show', compact('krs', 'mataKuliah'));
    }

    public function addMatkul(Request $request, Krs $krs)
    {
        $this->filterByFakultas(Krs::where('id', $krs->id))->firstOrFail();
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
        $krs = $detail->krs;
        $this->filterByFakultas(Krs::where('id', $krs->id))->firstOrFail();
        $detail->delete();
        return back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }

    public function approve(Krs $krs)
    {
        $this->filterByFakultas(Krs::where('id', $krs->id))->firstOrFail();
        $krs->update(['status' => 'disetujui']);
        return back()->with('success', 'KRS berhasil disetujui.');
    }

    public function destroy(Krs $krs)
    {
        $this->filterByFakultas(Krs::where('id', $krs->id))->firstOrFail();
        $krs->delete();
        return redirect()->route('admin.krs.index')->with('success', 'KRS berhasil dihapus.');
    }
}
