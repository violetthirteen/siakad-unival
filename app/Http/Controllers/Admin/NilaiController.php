<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Semester;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $semesters = Semester::with('tahunAjaran')->get();

        $mkQuery = MataKuliah::query();
        $mataKuliah = $this->filterByFakultas($mkQuery)->orderBy('nama_mk')->get();

        $selectedSemester = $request->input('semester_id');
        $selectedMkId = $request->input('mata_kuliah_id');

        $nilai = collect();
        $students = collect();

        if ($selectedSemester && $selectedMkId) {
            $mk = MataKuliah::findOrFail($selectedMkId);
            $mhsQuery = Mahasiswa::with(['nilai' => function ($q) use ($selectedMkId, $selectedSemester) {
                    $q->where('mata_kuliah_id', $selectedMkId)
                      ->where('semester_id', $selectedSemester);
                }])
                ->where('program_studi_id', $mk->program_studi_id)
                ->where('status', 'aktif')
                ->orderBy('nama_lengkap');

            $students = $this->filterByFakultas($mhsQuery)->get();
        } else {
            $query = Nilai::with(['mahasiswa', 'mataKuliah', 'semester.tahunAjaran']);
            $nilai = $this->filterByFakultas($query)->latest()->get();
        }

        return view('admin.nilai.index', compact('semesters', 'mataKuliah', 'selectedSemester', 'selectedMkId', 'nilai', 'students'));
    }

    public function create()
    {
        $user = auth()->user();
        $q = Mahasiswa::where('status', 'aktif');
        $mahasiswa = $this->filterByFakultas($q)->get();
        $mkQuery = MataKuliah::query();
        $mataKuliah = $this->filterByFakultas($mkQuery)->get();
        $semester = Semester::with('tahunAjaran')->get();
        return view('admin.nilai.create', compact('mahasiswa', 'mataKuliah', 'semester'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'semester_id' => 'required|exists:semester,id',
            'nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        $mhs = Mahasiswa::findOrFail($request->mahasiswa_id);
        $user = auth()->user();
        if ($user->isAdminFakultas()) {
            $prodi = $mhs->programStudi;
            if ($prodi->fakultas_id !== $user->fakultas_id) {
                abort(403);
            }
        }

        $data = $request->all();
        $data['nilai_akhir'] = $this->hitungNilaiAkhir($data);
        $data['nilai_huruf'] = $this->konversiNilai($data['nilai_akhir']);

        Nilai::create($data);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai)
    {
        $this->filterByFakultas(Nilai::where('id', $nilai->id))->firstOrFail();

        $user = auth()->user();
        $q = Mahasiswa::query();
        $mahasiswa = $this->filterByFakultas($q)->get();
        $mkQuery = MataKuliah::query();
        $mataKuliah = $this->filterByFakultas($mkQuery)->get();
        $semester = Semester::with('tahunAjaran')->get();
        return view('admin.nilai.edit', compact('nilai', 'mahasiswa', 'mataKuliah', 'semester'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $this->filterByFakultas(Nilai::where('id', $nilai->id))->firstOrFail();

        $request->validate([
            'nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'nilai_uts' => 'nullable|numeric|min:0|max:100',
            'nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        $data = $request->only(['nilai_tugas', 'nilai_uts', 'nilai_uas']);
        $data['nilai_akhir'] = $this->hitungNilaiAkhir($data);
        $data['nilai_huruf'] = $this->konversiNilai($data['nilai_akhir']);

        $nilai->update($data);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil diupdate.');
    }

    public function destroy(Nilai $nilai)
    {
        $this->filterByFakultas(Nilai::where('id', $nilai->id))->firstOrFail();
        $nilai->delete();
        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }

    private function hitungNilaiAkhir(array $data): float
    {
        $tugas = (float) ($data['nilai_tugas'] ?? 0);
        $uts = (float) ($data['nilai_uts'] ?? 0);
        $uas = (float) ($data['nilai_uas'] ?? 0);
        return round(($tugas * 0.2) + ($uts * 0.35) + ($uas * 0.45), 2);
    }

    private function konversiNilai(float $nilai): string
    {
        return match (true) {
            $nilai >= 85 => 'A',
            $nilai >= 75 => 'B+',
            $nilai >= 65 => 'B',
            $nilai >= 60 => 'C+',
            $nilai >= 50 => 'C',
            $nilai >= 40 => 'D',
            default => 'E',
        };
    }
}
