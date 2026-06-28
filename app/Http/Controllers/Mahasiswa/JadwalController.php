<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function index(Request $request): View
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $semesterFilter = $request->input('semester');

        $jadwal = Jadwal::with(['mataKuliah', 'dosen'])
            ->when($semesterFilter, function ($query, $semesterFilter) {
                $query->whereHas('mataKuliah', function ($q) use ($semesterFilter) {
                    $q->where('semester', $semesterFilter);
                });
            })
            ->orderBy('hari')->orderBy('jam_mulai')->paginate(15);

        $semesters = \App\Models\MataKuliah::select('semester')->distinct()->orderBy('semester')->pluck('semester');

        $krsIds = $mahasiswa ? $mahasiswa->krs()->pluck('jadwal_id')->toArray() : [];

        return view('mahasiswa.jadwal.index', compact('jadwal', 'semesters', 'krsIds'));
    }
}
