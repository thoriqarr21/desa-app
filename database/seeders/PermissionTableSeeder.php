<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'jalan-list',
           'jalan-create',
           'jalan-edit',
           'jalan-delete',
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
           'kegiatan-delete'
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
