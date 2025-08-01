<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class CreateKadesUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat role "Kades"
        $kadesRole = Role::firstOrCreate(['name' => 'Kades']);

        // 2. Daftar permission untuk role Kades
        $permissions = [
            'laporankegiatan-list',
            'laporankegiatan-create',
            'laporankegiatan-edit',
            'laporankegiatan-delete',
            'laporankegiatan-approve',

            'proyek-list',
            'proyek-create',
            'proyek-edit',
            'proyek-delete',

            'kategori-list',
            'kategori-create',
            'kategori-edit',
            'kategori-delete',

            'laporan-list',
            'laporan-create',
            'laporan-edit',
            'laporan-approve',
            'laporan-delete',

            'kegiatan-list',
            'kegiatan-create',
            'kegiatan-edit',
            'kegiatan-delete',

            'user-list',
        ];

        // 3. Buat dan beri izin ke role Kades
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $kadesRole->givePermissionTo($permission);
        }

        // 4. (Opsional) Tambahkan user contoh
        $kadesUser = User::firstOrCreate(
            [   'username' => 'kades12345',
                'name' => 'Kades User',
                'password' => bcrypt('12345678'),
                'gambar' => asset('assets/img/logo_pemkab_bogor.jpg'),
            ]
        );

        $kadesUser->assignRole($kadesRole);
    }
}
