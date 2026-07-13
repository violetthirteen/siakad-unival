<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    public function index()
    {
        return view('buku-tamu.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'pesan' => 'required|string',
        ]);

        BukuTamu::create($request->all());

        return back()->with('success', 'Pesan berhasil dikirim! Terima kasih.');
    }
}
