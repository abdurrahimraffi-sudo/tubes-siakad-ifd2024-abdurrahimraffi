<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Jadwal;
use App\Exports\KrsMahasiswaExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class KrsController extends Controller
{
    public function index(): View
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $krsList = Krs::with(['jadwal.mataKuliah', 'jadwal.dosen'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get();

        $totalSks = $krsList->sum(fn ($krs) => $krs->jadwal->mataKuliah->sks ?? 0);

        return view('mahasiswa.krs.index', compact('krsList', 'totalSks'));
    }

    public function ambil(Request $request): RedirectResponse
    {
        $request->validate([
            'jadwal_id' => ['required', 'exists:jadwal,id'],
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        $exists = Krs::where('mahasiswa_id', $mahasiswa->id)
            ->where('jadwal_id', $request->jadwal_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah mengambil mata kuliah ini.');
        }

        Krs::create([
            'mahasiswa_id' => $mahasiswa->id,
            'jadwal_id' => $request->jadwal_id,
        ]);

        return back()->with('success', 'Mata kuliah berhasil diambil.');
    }

    public function drop(Krs $krs): RedirectResponse
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if ($krs->mahasiswa_id !== $mahasiswa->id) {
            abort(403);
        }

        $krs->delete();

        return back()->with('success', 'Mata kuliah berhasil di-drop.');
    }

    public function exportPdf()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $krsList = Krs::with(['jadwal.mataKuliah', 'jadwal.dosen'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->get();

        $totalSks = $krsList->sum(fn ($krs) => $krs->jadwal->mataKuliah->sks ?? 0);

        $pdf = Pdf::loadView('mahasiswa.krs.pdf', compact('mahasiswa', 'krsList', 'totalSks'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('KRS-' . $mahasiswa->nim . '.pdf');
    }

    public function exportExcel()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        return Excel::download(new KrsMahasiswaExport($mahasiswa->id), 'KRS-' . $mahasiswa->nim . '.xlsx');
    }
}
