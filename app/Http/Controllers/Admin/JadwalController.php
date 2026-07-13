<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\Semester;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $query = Jadwal::with(['mataKuliah', 'dosen', 'ruangan', 'semester']);
        $jadwal = $this->filterByFakultas($query)->latest()->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $user = auth()->user();
        $query = MataKuliah::query();
        $mataKuliah = $this->filterByFakultas($query)->get();
        $dosen = $user->isAdminFakultas()
            ? Dosen::whereHas('programStudi', fn($q) => $q->where('fakultas_id', $user->fakultas_id))->get()
            : Dosen::all();
        $ruangan = Ruangan::all();
        $semester = Semester::with('tahunAjaran')->where('is_active', true)->orWhereHas('tahunAjaran', fn($q) => $q->where('is_active', true))->get();
        return view('admin.jadwal.create', compact('mataKuliah', 'dosen', 'ruangan', 'semester'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:dosen,id',
            'ruangan_id' => 'required|exists:ruangan,id',
            'semester_id' => 'required|exists:semester,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $mk = MataKuliah::findOrFail($request->mata_kuliah_id);
        $user = auth()->user();
        if ($user->isAdminFakultas() && $mk->programStudi->fakultas_id !== $user->fakultas_id) {
            abort(403);
        }

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal)
    {
        $this->filterByFakultas(Jadwal::where('id', $jadwal->id))->firstOrFail();

        $user = auth()->user();
        $query = MataKuliah::query();
        $mataKuliah = $this->filterByFakultas($query)->get();
        $dosen = $user->isAdminFakultas()
            ? Dosen::whereHas('programStudi', fn($q) => $q->where('fakultas_id', $user->fakultas_id))->get()
            : Dosen::all();
        $ruangan = Ruangan::all();
        $semester = Semester::with('tahunAjaran')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'mataKuliah', 'dosen', 'ruangan', 'semester'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $this->filterByFakultas(Jadwal::where('id', $jadwal->id))->firstOrFail();

        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:dosen,id',
            'ruangan_id' => 'required|exists:ruangan,id',
            'semester_id' => 'required|exists:semester,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $mk = MataKuliah::findOrFail($request->mata_kuliah_id);
        $user = auth()->user();
        if ($user->isAdminFakultas() && $mk->programStudi->fakultas_id !== $user->fakultas_id) {
            abort(403);
        }

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $this->filterByFakultas(Jadwal::where('id', $jadwal->id))->firstOrFail();
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
