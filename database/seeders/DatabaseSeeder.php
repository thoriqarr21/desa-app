<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            CreateKadesUserSeeder::class,
            CreatePegawaiUserSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'username' => 'test12345',
            // 'email' => 'test@example.com',
            'password'=> bcrypt('12345678'),
            'gambar' => 'logo_pemkab_bogor.jpg'
        ]);
    }
}
