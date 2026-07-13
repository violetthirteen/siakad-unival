<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'kapasitas',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'ruangan_id');
    }
}
