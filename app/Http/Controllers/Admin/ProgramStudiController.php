<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $query = ProgramStudi::with('fakultas');
        $programStudi = $this->filterByFakultas($query)->latest()->get();
        return view('admin.program-studi.index', compact('programStudi'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->isAdminFakultas()) {
            $fakultas = Fakultas::where('id', $user->fakultas_id)->get();
        } else {
            $fakultas = Fakultas::all();
        }
        return view('admin.program-studi.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $rules = [
            'kode_prodi' => 'required|string|max:10|unique:program_studi',
            'nama_prodi' => 'required|string|max:255',
            'jenjang' => 'required|in:D3,D4,S1,S2,S3',
        ];

        if ($user->isSuperAdmin()) {
            $rules['fakultas_id'] = 'required|exists:fakultas,id';
        }

        $request->validate($rules);

        $data = $request->all();
        if ($user->isAdminFakultas()) {
            $data['fakultas_id'] = $user->fakultas_id;
        }

        ProgramStudi::create($data);

        return redirect()->route('admin.program-studi.index')->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function edit(ProgramStudi $programStudi)
    {
        $this->filterByFakultas(ProgramStudi::where('id', $programStudi->id))->firstOrFail();

        $user = auth()->user();
        if ($user->isAdminFakultas()) {
            $fakultas = Fakultas::where('id', $user->fakultas_id)->get();
        } else {
            $fakultas = Fakultas::all();
        }
        return view('admin.program-studi.edit', compact('programStudi', 'fakultas'));
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $this->filterByFakultas(ProgramStudi::where('id', $programStudi->id))->firstOrFail();

        $user = auth()->user();
        $rules = [
            'kode_prodi' => 'required|string|max:10|unique:program_studi,kode_prodi,' . $programStudi->id,
            'nama_prodi' => 'required|string|max:255',
            'jenjang' => 'required|in:D3,D4,S1,S2,S3',
        ];

        if ($user->isSuperAdmin()) {
            $rules['fakultas_id'] = 'required|exists:fakultas,id';
        }

        $request->validate($rules);

        $data = $request->all();
        if ($user->isAdminFakultas()) {
            $data['fakultas_id'] = $programStudi->fakultas_id;
        }

        $programStudi->update($data);

        return redirect()->route('admin.program-studi.index')->with('success', 'Program studi berhasil diupdate.');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        $this->filterByFakultas(ProgramStudi::where('id', $programStudi->id))->firstOrFail();
        $programStudi->delete();
        return redirect()->route('admin.program-studi.index')->with('success', 'Program studi berhasil dihapus.');
    }
}
