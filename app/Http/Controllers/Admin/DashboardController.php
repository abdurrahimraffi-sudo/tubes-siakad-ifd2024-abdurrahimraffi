<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalDosen = Dosen::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalMataKuliah = MataKuliah::count();
        $totalJadwal = Jadwal::count();
        $totalKrs = Krs::count();

        $mahasiswaPerSemester = Mahasiswa::selectRaw('semester, COUNT(*) as total')
            ->groupBy('semester')
            ->orderBy('semester')
            ->pluck('total', 'semester');

        $mataKuliahPerSemester = MataKuliah::selectRaw('semester, COUNT(*) as total')
            ->groupBy('semester')
            ->orderBy('semester')
            ->pluck('total', 'semester');

        $aktivitasTerbaru = Krs::with(['mahasiswa', 'jadwal.mataKuliah'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalMataKuliah',
            'totalJadwal',
            'totalKrs',
            'mahasiswaPerSemester',
            'mataKuliahPerSemester',
            'aktivitasTerbaru'
        ));
    }
}
