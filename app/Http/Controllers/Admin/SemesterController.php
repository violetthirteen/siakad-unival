<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $this->requireSuperAdmin();
        $semester = Semester::with('tahunAjaran')->latest()->get();
        return view('admin.semester.index', compact('semester'));
    }

    public function create()
    {
        $this->requireSuperAdmin();
        $tahunAjaran = \App\Models\TahunAjaran::all();
        return view('admin.semester.create', compact('tahunAjaran'));
    }

    public function store(Request $request)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'nama_semester' => 'required|in:Ganjil,Genap',
        ]);

        Semester::create($request->all());

        return redirect()->route('admin.semester.index')->with('success', 'Semester berhasil ditambahkan.');
    }

    public function edit(Semester $semester)
    {
        $this->requireSuperAdmin();
        $tahunAjaran = \App\Models\TahunAjaran::all();
        return view('admin.semester.edit', compact('semester', 'tahunAjaran'));
    }

    public function update(Request $request, Semester $semester)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',
            'nama_semester' => 'required|in:Ganjil,Genap',
        ]);

        $semester->update($request->all());

        return redirect()->route('admin.semester.index')->with('success', 'Semester berhasil diupdate.');
    }

    public function destroy(Semester $semester)
    {
        $this->requireSuperAdmin();
        $semester->delete();
        return redirect()->route('admin.semester.index')->with('success', 'Semester berhasil dihapus.');
    }

    public function activate(Semester $semester)
    {
        $this->requireSuperAdmin();
        Semester::where('is_active', true)->update(['is_active' => false]);
        $semester->update(['is_active' => true]);
        return redirect()->route('admin.semester.index')->with('success', 'Semester diaktifkan.');
    }
}
