<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $query = Dosen::with('programStudi');
        $dosen = $this->filterByFakultas($query)->latest()->get();
        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        $query = ProgramStudi::query();
        $programStudi = $this->filterByFakultas($query)->get();
        return view('admin.dosen.create', compact('programStudi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|max:20|unique:dosen',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $prodi = ProgramStudi::findOrFail($request->program_studi_id);
        $user = auth()->user();
        if ($user->isAdminFakultas() && $prodi->fakultas_id !== $user->fakultas_id) {
            abort(403);
        }

        Dosen::create($request->all());

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        $this->filterByFakultas(Dosen::where('id', $dosen->id))->firstOrFail();
        $query = ProgramStudi::query();
        $programStudi = $this->filterByFakultas($query)->get();
        return view('admin.dosen.edit', compact('dosen', 'programStudi'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $this->filterByFakultas(Dosen::where('id', $dosen->id))->firstOrFail();

        $request->validate([
            'nidn' => 'required|string|max:20|unique:dosen,nidn,' . $dosen->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'program_studi_id' => 'required|exists:program_studi,id',
        ]);

        $prodi = ProgramStudi::findOrFail($request->program_studi_id);
        $user = auth()->user();
        if ($user->isAdminFakultas() && $prodi->fakultas_id !== $user->fakultas_id) {
            abort(403);
        }

        $dosen->update($request->all());

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diupdate.');
    }

    public function destroy(Dosen $dosen)
    {
        $this->filterByFakultas(Dosen::where('id', $dosen->id))->firstOrFail();
        $dosen->delete();
        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
