<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'program_studi';

    protected $fillable = [
        'fakultas_id',
        'kode_prodi',
        'nama_prodi',
        'jenjang',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'program_studi_id');
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'program_studi_id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'program_studi_id');
    }
}
