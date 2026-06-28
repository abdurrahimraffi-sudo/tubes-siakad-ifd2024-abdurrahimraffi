<?php

namespace App\Exports;

use App\Models\Krs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KrsMahasiswaExport implements FromCollection, WithHeadings, WithMapping
{
    protected $mahasiswaId;

    public function __construct($mahasiswaId)
    {
        $this->mahasiswaId = $mahasiswaId;
    }

    public function collection()
    {
        return Krs::with(['jadwal.mataKuliah', 'jadwal.dosen'])
            ->where('mahasiswa_id', $this->mahasiswaId)
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode MK',
            'Nama Mata Kuliah',
            'SKS',
            'Semester',
            'Dosen',
            'Hari',
            'Jam Mulai',
            'Jam Selesai',
            'Kelas',
            'Ruangan',
        ];
    }

    public function map($krs): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $krs->jadwal->mataKuliah->kode_mk ?? '-',
            $krs->jadwal->mataKuliah->nama_mk ?? '-',
            $krs->jadwal->mataKuliah->sks ?? '-',
            $krs->jadwal->mataKuliah->semester ?? '-',
            $krs->jadwal->dosen->nama_dosen ?? '-',
            $krs->jadwal->hari ?? '-',
            $krs->jadwal->jam_mulai ?? '-',
            $krs->jadwal->jam_selesai ?? '-',
            $krs->jadwal->kelas ?? '-',
            $krs->jadwal->ruangan ?? '-',
        ];
    }
}
