<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        if (! $mahasiswa) {
            return view('mahasiswa.dashboard', [
                'mahasiswa' => null,
                'jadwalHariIni' => collect(),
                'krsList' => collect(),
                'totalSks' => 0,
            ]);
        }

        $hariIni = now()->locale('id')->dayName;
        $hariIndo = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $namaHari = $hariIndo[$hariIni] ?? $hariIni;

        $krsList = Krs::with(['jadwal.mataKuliah', 'jadwal.dosen'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get();

        $jadwalHariIni = $krsList->filter(fn ($krs) => $krs->jadwal && $krs->jadwal->hari === $namaHari);

        $totalSks = $krsList->sum(fn ($krs) => $krs->jadwal->mataKuliah->sks ?? 0);

        return view('mahasiswa.dashboard', compact('mahasiswa', 'jadwalHariIni', 'krsList', 'totalSks'));
    }
}
