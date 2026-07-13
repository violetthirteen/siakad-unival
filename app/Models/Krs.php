<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'mahasiswa_id',
        'semester_id',
        'tanggal_dibuat',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_dibuat' => 'date',
        ];
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function detail()
    {
        return $this->hasMany(KrsDetail::class, 'krs_id');
    }
}
