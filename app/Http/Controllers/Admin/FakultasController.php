<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index()
    {
        $this->requireSuperAdmin();
        $fakultas = Fakultas::withCount('programStudi')->latest()->get();
        return view('admin.fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        $this->requireSuperAdmin();
        return view('admin.fakultas.create');
    }

    public function store(Request $request)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'kode_fakultas' => 'required|string|max:10|unique:fakultas',
            'nama_fakultas' => 'required|string|max:255',
        ]);

        Fakultas::create($request->all());

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    public function edit(Fakultas $fakultas)
    {
        $this->requireSuperAdmin();
        return view('admin.fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'kode_fakultas' => 'required|string|max:10|unique:fakultas,kode_fakultas,' . $fakultas->id,
            'nama_fakultas' => 'required|string|max:255',
        ]);

        $fakultas->update($request->all());

        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil diupdate.');
    }

    public function destroy(Fakultas $fakultas)
    {
        $this->requireSuperAdmin();
        $fakultas->delete();
        return redirect()->route('admin.fakultas.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}
