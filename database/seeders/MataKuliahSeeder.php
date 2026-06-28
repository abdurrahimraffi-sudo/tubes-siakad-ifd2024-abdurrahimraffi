<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $mataKuliah = [
            ['kode_mk' => 'IF101', 'nama_mk' => 'Pemrograman Web', 'sks' => 3, 'semester' => 1],
            ['kode_mk' => 'IF102', 'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 1],
            ['kode_mk' => 'IF103', 'nama_mk' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1],
            ['kode_mk' => 'IF104', 'nama_mk' => 'Pengantar Teknologi Informasi', 'sks' => 2, 'semester' => 1],
            ['kode_mk' => 'IF201', 'nama_mk' => 'Basis Data', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'IF202', 'nama_mk' => 'Struktur Data', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'IF203', 'nama_mk' => 'Sistem Operasi', 'sks' => 3, 'semester' => 2],
            ['kode_mk' => 'IF204', 'nama_mk' => 'Pemrograman Berorientasi Objek', 'sks' => 4, 'semester' => 2],
            ['kode_mk' => 'IF301', 'nama_mk' => 'Pemrograman Web Lanjut', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'IF302', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'IF303', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'IF304', 'nama_mk' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 3],
            ['kode_mk' => 'IF401', 'nama_mk' => 'Framework Pemrograman Web', 'sks' => 4, 'semester' => 4],
            ['kode_mk' => 'IF402', 'nama_mk' => 'Pemrograman Mobile', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'IF403', 'nama_mk' => 'Data Mining', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'IF404', 'nama_mk' => 'Sistem Informasi Manajemen', 'sks' => 3, 'semester' => 4],
            ['kode_mk' => 'IF501', 'nama_mk' => 'Cloud Computing', 'sks' => 3, 'semester' => 5],
            ['kode_mk' => 'IF502', 'nama_mk' => 'Keamanan Informasi', 'sks' => 3, 'semester' => 5],
            ['kode_mk' => 'IF503', 'nama_mk' => 'Pemrograman Framework', 'sks' => 4, 'semester' => 5],
            ['kode_mk' => 'IF504', 'nama_mk' => 'Teknologi Big Data', 'sks' => 3, 'semester' => 5],
        ];

        foreach ($mataKuliah as $mk) {
            MataKuliah::create($mk);
        }
    }
}
