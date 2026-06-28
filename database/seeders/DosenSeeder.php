<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $namaDepan = ['Budi', 'Siti', 'Ahmad', 'Dewi', 'Rudi', 'Sri', 'Agus', 'Rina', 'Eko', 'Wati'];
        $namaBelakang = ['Santoso', 'Wijaya', 'Hidayat', 'Lestari', 'Pratama', 'Sari', 'Nugroho', 'Anggraini', 'Kusuma', 'Permana'];

        for ($i = 0; $i < 10; $i++) {
            $nama = $namaDepan[$i] . ' ' . $namaBelakang[$i];
            Dosen::create([
                'nidn' => sprintf('10%05d', $i + 1),
                'nama_dosen' => $nama,
                'email' => strtolower(Str::slug($nama, '.')) . '@dosen.ac.id',
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'alamat' => 'Jl. Pendidikan No. ' . ($i + 1) . ', Jakarta',
            ]);
        }
    }
}
