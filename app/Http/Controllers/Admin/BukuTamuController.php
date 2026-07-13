<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function index()
    {
        $this->requireSuperAdmin();
        $bukuTamu = BukuTamu::latest()->get();
        return view('admin.buku-tamu.index', compact('bukuTamu'));
    }

    public function destroy(BukuTamu $bukuTamu)
    {
        $this->requireSuperAdmin();
        $bukuTamu->delete();
        return redirect()->route('admin.buku-tamu.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
