<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $query = MataKuliah::with('programStudi');
        $mataKuliah = $this->filterByFakultas($query)->latest()->get();
        return view('admin.mata-kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        $query = ProgramStudi::query();
        $programStudi = $this->filterByFakultas($query)->get();
        return view('admin.mata-kuliah.create', compact('programStudi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:15|unique:mata_kuliah',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:24',
            'semester' => 'required|integer|min:1|max:14',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $prodi = ProgramStudi::findOrFail($request->program_studi_id);
        $user = auth()->user();
        if ($user->isAdminFakultas() && $prodi->fakultas_id !== $user->fakultas_id) {
            abort(403);
        }

        MataKuliah::create($request->all());

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah)
    {
        $this->filterByFakultas(MataKuliah::where('id', $mataKuliah->id))->firstOrFail();
        $query = ProgramStudi::query();
        $programStudi = $this->filterByFakultas($query)->get();
        return view('admin.mata-kuliah.edit', compact('mataKuliah', 'programStudi'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $this->filterByFakultas(MataKuliah::where('id', $mataKuliah->id))->firstOrFail();

        $request->validate([
            'kode_mk' => 'required|string|max:15|unique:mata_kuliah,kode_mk,' . $mataKuliah->id,
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:24',
            'semester' => 'required|integer|min:1|max:14',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $prodi = ProgramStudi::findOrFail($request->program_studi_id);
        $user = auth()->user();
        if ($user->isAdminFakultas() && $prodi->fakultas_id !== $user->fakultas_id) {
            abort(403);
        }

        $mataKuliah->update($request->all());

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil diupdate.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $this->filterByFakultas(MataKuliah::where('id', $mataKuliah->id))->firstOrFail();
        $mataKuliah->delete();
        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
