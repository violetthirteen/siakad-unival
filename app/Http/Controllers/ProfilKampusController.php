<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilKampusController extends Controller
{
    public function index()
    {
        return view('profil-kampus.index');
    }
}
