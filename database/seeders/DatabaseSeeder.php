<?php

namespace Database\Seeders;

use App\Models\KategoriKegiatan;
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
            'gambar' => asset('assets/img/logo_pemkab_bogor.jpg'),
        ]);
        $kategoriList = [
            [
                'nama_kategori' => 'Pemerintahan Desa',
                'deskripsi_kategori' => 'Meliputi kegiatan administrasi, pengelolaan keuangan desa, penyusunan peraturan desa, dan penyelenggaraan musyawarah desa.',
            ],
            [
                'nama_kategori' => 'Pembinaan Kemasyarakatan',
                'deskripsi_kategori' => 'Kegiatan yang bertujuan untuk meningkatkan kualitas sumber daya manusia dan memperkuat nilai-nilai sosial budaya masyarakat desa.',
            ],
            [
                'nama_kategori' => 'Pemberdayaan Masyarakat',
                'deskripsi_kategori' => 'Kegiatan yang fokus pada peningkatan potensi ekonomi dan kemandirian masyarakat desa',
            ],
            [
                'nama_kategori' => 'Penanggulangan Bencana',
                'deskripsi_kategori' => 'Kegiatan yang dilakukan untuk mencegah dan menanggulangi risiko bencana yang mungkin terjadi di desa.',
            ],
        ];
        
        foreach ($kategoriList as $kategori) {
            KategoriKegiatan::create($kategori);
        }
    }
}
