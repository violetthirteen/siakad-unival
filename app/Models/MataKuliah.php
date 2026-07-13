<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'program_studi_id',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'mata_kuliah_id');
    }

    public function krsDetail()
    {
        return $this->hasMany(KrsDetail::class, 'mata_kuliah_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mata_kuliah_id');
    }
}
