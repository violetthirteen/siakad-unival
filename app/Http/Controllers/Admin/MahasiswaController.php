<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $query = Mahasiswa::with('programStudi');
        $mahasiswa = $this->filterByFakultas($query)->latest()->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $query = ProgramStudi::query();
        $programStudi = $this->filterByFakultas($query)->get();
        return view('admin.mahasiswa.create', compact('programStudi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'program_studi_id' => 'required|exists:program_studi,id',
            'angkatan' => 'required|string|max:4',
        ]);

        $prodi = ProgramStudi::findOrFail($request->program_studi_id);

        $user = auth()->user();
        if ($user->isAdminFakultas() && $prodi->fakultas_id !== $user->fakultas_id) {
            abort(403, 'Anda hanya dapat menambah mahasiswa di fakultas Anda sendiri.');
        }

        $data = $request->all();
        $data['nim'] = Mahasiswa::generateNim($request->angkatan, $request->program_studi_id);

        Mahasiswa::create($data);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan. NIM: ' . $data['nim']);
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $this->filterByFakultas(Mahasiswa::where('id', $mahasiswa->id))->firstOrFail();
        $query = ProgramStudi::query();
        $programStudi = $this->filterByFakultas($query)->get();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'programStudi'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $this->filterByFakultas(Mahasiswa::where('id', $mahasiswa->id))->firstOrFail();

        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'program_studi_id' => 'required|exists:program_studi,id',
            'angkatan' => 'required|string|max:4',
        ]);

        $prodi = ProgramStudi::findOrFail($request->program_studi_id);
        $user = auth()->user();
        if ($user->isAdminFakultas() && $prodi->fakultas_id !== $user->fakultas_id) {
            abort(403);
        }

        $mahasiswa->update($request->all());

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $this->filterByFakultas(Mahasiswa::where('id', $mahasiswa->id))->firstOrFail();
        $mahasiswa->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
