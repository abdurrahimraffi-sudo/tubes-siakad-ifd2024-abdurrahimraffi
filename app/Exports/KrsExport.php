<?php

namespace App\Exports;

use App\Models\Krs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KrsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Krs::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen'])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Mahasiswa',
            'Kode MK',
            'Nama Mata Kuliah',
            'SKS',
            'Dosen',
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
            'Kelas',
            'Ruangan',
            'Tanggal Ambil',
        ];
    }

    public function map($krs): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $krs->mahasiswa->nim ?? '-',
            $krs->mahasiswa->nama_mahasiswa ?? '-',
            $krs->jadwal->mataKuliah->kode_mk ?? '-',
            $krs->jadwal->mataKuliah->nama_mk ?? '-',
            $krs->jadwal->mataKuliah->sks ?? '-',
            $krs->jadwal->dosen->nama_dosen ?? '-',
            $krs->jadwal->hari ?? '-',
            $krs->jadwal->jam_mulai ?? '-',
            $krs->jadwal->jam_selesai ?? '-',
            $krs->jadwal->kelas ?? '-',
            $krs->jadwal->ruangan ?? '-',
            $krs->created_at->format('d/m/Y H:i'),
        ];
    }
}
