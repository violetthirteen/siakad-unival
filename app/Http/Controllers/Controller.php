<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Nilai;

abstract class Controller
{
    protected function filterByFakultas($query)
    {
        $user = auth()->user();
        if ($user && $user->isAdminFakultas()) {
            $modelClass = get_class($query->getModel());

            if ($modelClass === ProgramStudi::class) {
                return $query->where('fakultas_id', $user->fakultas_id);
            }

            if ($modelClass === Jadwal::class) {
                return $query->whereHas('mataKuliah.programStudi', function ($q) use ($user) {
                    $q->where('fakultas_id', $user->fakultas_id);
                });
            }

            if ($modelClass === Krs::class || $modelClass === Nilai::class) {
                return $query->whereHas('mahasiswa.programStudi', function ($q) use ($user) {
                    $q->where('fakultas_id', $user->fakultas_id);
                });
            }

            return $query->whereHas('programStudi', function ($q) use ($user) {
                $q->where('fakultas_id', $user->fakultas_id);
            });
        }
        return $query;
    }

    protected function requireSuperAdmin()
    {
        if (auth()->user()->isAdminFakultas()) {
            abort(403, 'Hanya super admin yang dapat mengakses fitur ini.');
        }
    }
}
