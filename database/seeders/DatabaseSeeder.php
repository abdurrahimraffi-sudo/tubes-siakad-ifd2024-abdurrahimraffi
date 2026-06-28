<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            DosenSeeder::class,
            MataKuliahSeeder::class,
            MahasiswaSeeder::class,
            JadwalSeeder::class,
            KrsSeeder::class,
        ]);
    }
}
