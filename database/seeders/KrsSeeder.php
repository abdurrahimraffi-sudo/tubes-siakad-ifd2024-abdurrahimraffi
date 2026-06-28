<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswaIds = Mahasiswa::pluck('id')->toArray();
        $jadwalIds = Jadwal::pluck('id')->toArray();

        foreach ($mahasiswaIds as $mhsId) {
            $jumlahKrs = rand(4, 7);
            $jadwalDipilih = array_rand(array_flip($jadwalIds), $jumlahKrs);

            if (!is_array($jadwalDipilih)) {
                $jadwalDipilih = [$jadwalDipilih];
            }

            foreach ($jadwalDipilih as $jadwalId) {
                Krs::firstOrCreate([
                    'mahasiswa_id' => $mhsId,
                    'jadwal_id' => $jadwalId,
                ]);
            }
        }
    }
}
