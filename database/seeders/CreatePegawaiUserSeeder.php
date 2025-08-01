<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class CreatePegawaiUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Role "Pegawai"
        $pegawaiRole = Role::firstOrCreate(['name' => 'Pegawai']);

        // 2. Daftar permission yang akan diberikan ke role "Pegawai"
        $permissions = [
            'laporan-delete',
            'kegiatan-list',
            'laporan-list',
            'laporan-create',
            'laporan-edit',
            'laporankegiatan-list',
            'laporankegiatan-create',
            'laporankegiatan-edit',
            'laporankegiatan-delete',
            'proyek-list',
        ];

        // 3. Loop dan buat permission, lalu assign ke role Pegawai
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $pegawaiRole->givePermissionTo($permission);
        }

        // 4. (Opsional) Buat 1 user Pegawai untuk testing
        $pegawaiUser = User::firstOrCreate(
            [   'name' => 'Pegawai User',
                'username' => 'pegawai12345',  
                'password' => bcrypt('12345678'),
                'gambar' => asset('assets/img/logo_pemkab_bogor.jpg'),
            ]
        );

        $pegawaiUser->assignRole($pegawaiRole);
    }
}
