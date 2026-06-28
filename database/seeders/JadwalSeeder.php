<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $jamMulaiList = ['07:30:00', '09:15:00', '11:00:00', '13:00:00', '14:45:00'];
        $kelasList = ['A', 'B', 'C'];
        $ruanganList = ['R101', 'R102', 'R201', 'R202', 'R301', 'Lab A', 'Lab B', 'Lab C'];

        $dosenIds = Dosen::pluck('id')->toArray();
        $mkIds = MataKuliah::pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $jamMulai = $jamMulaiList[array_rand($jamMulaiList)];
            $jamSelesai = date('H:i:s', strtotime($jamMulai . ' +2 hours'));

            Jadwal::create([
                'mata_kuliah_id' => $mkIds[array_rand($mkIds)],
                'dosen_id' => $dosenIds[array_rand($dosenIds)],
                'hari' => $hariList[array_rand($hariList)],
                'jam_mulai' => $jamMulai,
                'jam_selesai' => $jamSelesai,
                'kelas' => $kelasList[array_rand($kelasList)],
                'ruangan' => $ruanganList[array_rand($ruanganList)],
            ]);
        }
    }
}
