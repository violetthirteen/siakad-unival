<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';

    protected $fillable = [
        'tahun_ajaran_id',
        'nama_semester',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'semester_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'semester_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'semester_id');
    }
}
