<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $this->requireSuperAdmin();
        $tahunAjaran = TahunAjaran::latest()->get();
        return view('admin.tahun-ajaran.index', compact('tahunAjaran'));
    }

    public function create()
    {
        $this->requireSuperAdmin();
        return view('admin.tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'tahun_awal' => 'required|integer|min:2000|max:2099',
            'tahun_akhir' => 'required|integer|min:2000|max:2099|gt:tahun_awal',
        ]);

        TahunAjaran::create($request->all());

        return redirect()->route('admin.tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        $this->requireSuperAdmin();
        return view('admin.tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $this->requireSuperAdmin();
        $request->validate([
            'tahun_awal' => 'required|integer|min:2000|max:2099',
            'tahun_akhir' => 'required|integer|min:2000|max:2099|gt:tahun_awal',
        ]);

        $tahunAjaran->update($request->all());

        return redirect()->route('admin.tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil diupdate.');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        $this->requireSuperAdmin();
        $tahunAjaran->delete();
        return redirect()->route('admin.tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil dihapus.');
    }

    public function activate(TahunAjaran $tahunAjaran)
    {
        $this->requireSuperAdmin();
        TahunAjaran::where('is_active', true)->update(['is_active' => false]);
        $tahunAjaran->update(['is_active' => true]);
        return redirect()->route('admin.tahun-ajaran.index')->with('success', 'Tahun ajaran diaktifkan.');
    }
}
