<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::latest()->get();
        return view('admin.ruangan.index', compact('ruangan'));
    }

    public function create()
    {
        $this->requireSuperAdmin();
        return view('admin.ruangan.create');
    }

    public function store(Request $request)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'kode_ruangan' => 'required|string|max:15|unique:ruangan',
            'nama_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        Ruangan::create($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        $this->requireSuperAdmin();
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'kode_ruangan' => 'required|string|max:15|unique:ruangan,kode_ruangan,' . $ruangan->id,
            'nama_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $ruangan->update($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diupdate.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $this->requireSuperAdmin();
        $ruangan->delete();
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
