<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $namaDepan = ['Adi', 'Bambang', 'Citra', 'Dian', 'Eka', 'Fajar', 'Gita', 'Hadi', 'Indah', 'Joko',
            'Kartika', 'Lina', 'Made', 'Nita', 'Oka', 'Putu', 'Qori', 'Raka', 'Sari', 'Tono',
            'Umar', 'Vina', 'Wahyu', 'Xena', 'Yudi', 'Zaki', 'Andi', 'Bayu', 'Cahya', 'Dewa',
            'Eka', 'Ferry', 'Gilang', 'Hendra', 'Irfan', 'Jihan', 'Krisna', 'Luki', 'Maya', 'Nanda',
            'Oscar', 'Prita', 'Rini', 'Surya', 'Tika', 'Ujang', 'Vito', 'Wulan', 'Yoga', 'Zahra'];

        $namaBelakang = ['Pratama', 'Wijaya', 'Saputra', 'Lestari', 'Nugroho', 'Santoso', 'Anggraini', 'Kusuma', 'Permana', 'Hidayat',
            'Sari', 'Putri', 'Ramadhan', 'Maulana', 'Saputri', 'Firmansyah', 'Wardana', 'Cahyono', 'Utami', 'Gunawan'];

        $demoUser = User::where('email', 'mahasiswa@gmail.com')->first();

        for ($i = 0; $i < 50; $i++) {
            $nama = $namaDepan[$i] . ' ' . $namaBelakang[$i % count($namaBelakang)];
            $nim = '2021' . sprintf('%04d', $i + 1);
            $semester = (($i % 8) + 1);

            $userId = null;
            if ($i === 0) {
                $userId = $demoUser->id;
            } else {
                $user = User::create([
                    'name' => $nama,
                    'email' => strtolower(Str::slug($nama, '.')) . $nim . '@mhs.ac.id',
                    'password' => Hash::make('password'),
                    'role' => 'mahasiswa',
                ]);
                $user->assignRole('mahasiswa');
                $userId = $user->id;
            }

            Mahasiswa::create([
                'nim' => $nim,
                'nama_mahasiswa' => $nama,
                'email' => strtolower(Str::slug($nama, '.')) . $nim . '@mhs.ac.id',
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'alamat' => 'Jl. Mahasiswa No. ' . ($i + 1) . ', Depok',
                'semester' => $semester,
                'user_id' => $userId,
            ]);
        }
    }
}
