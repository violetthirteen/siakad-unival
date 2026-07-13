<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'superadmin@unival.ac.id'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('1'),
                'role' => 'super_admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'mahasiswa@unival.ac.id'],
            [
                'name' => 'Mahasiswa',
                'password' => bcrypt('1'),
                'role' => 'mahasiswa',
            ]
        );

        $fti = Fakultas::firstOrCreate(
            ['kode_fakultas' => 'FTI'],
            ['nama_fakultas' => 'Fakultas Ilmu Komputer']
        );

        $fe = Fakultas::firstOrCreate(
            ['kode_fakultas' => 'FE'],
            ['nama_fakultas' => 'Fakultas Ekonomi']
        );

        $fh = Fakultas::firstOrCreate(
            ['kode_fakultas' => 'FH'],
            ['nama_fakultas' => 'Fakultas Hukum']
        );

        User::firstOrCreate(
            ['email' => 'fik@unival.ac.id'],
            [
                'name' => 'Admin FIK',
                'password' => bcrypt('1'),
                'role' => 'admin_fakultas',
                'fakultas_id' => $fti->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'fe@unival.ac.id'],
            [
                'name' => 'Admin FE',
                'password' => bcrypt('1'),
                'role' => 'admin_fakultas',
                'fakultas_id' => $fe->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'fh@unival.ac.id'],
            [
                'name' => 'Admin FH',
                'password' => bcrypt('1'),
                'role' => 'admin_fakultas',
                'fakultas_id' => $fh->id,
            ]
        );

        $ti = ProgramStudi::firstOrCreate(
            ['kode_prodi' => '04'],
            [
                'fakultas_id' => $fti->id,
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'S1',
            ]
        );

        ProgramStudi::firstOrCreate(
            ['kode_prodi' => '05'],
            [
                'fakultas_id' => $fti->id,
                'nama_prodi' => 'Sistem Informasi',
                'jenjang' => 'S1',
            ]
        );

        ProgramStudi::firstOrCreate(
            ['kode_prodi' => '06'],
            [
                'fakultas_id' => $fti->id,
                'nama_prodi' => 'Manajemen Informatika',
                'jenjang' => 'D3',
            ]
        );

        User::firstOrCreate(
            ['email' => 'kaprodi@unival.ac.id'],
            [
                'name' => 'Kaprodi TI',
                'password' => bcrypt('1'),
                'role' => 'admin_prodi',
                'fakultas_id' => $fti->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'dosen@unival.ac.id'],
            [
                'name' => 'Dosen',
                'password' => bcrypt('1'),
                'role' => 'dosen',
            ]
        );
    }
}
