<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'program_studi_id',
        'angkatan',
        'status',
        'foto',
    ];

    public static function generateNim($angkatan, $programStudiId)
    {
        $tahun = substr($angkatan, -2);
        $kodeProdi = ProgramStudi::where('id', $programStudiId)->value('kode_prodi');

        $last = self::where('angkatan', $angkatan)
            ->where('program_studi_id', $programStudiId)
            ->orderBy('nim', 'desc')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->nim, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $tahun . $kodeProdi . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'mahasiswa_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mahasiswa_id');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'mahasiswa_id');
    }
}
