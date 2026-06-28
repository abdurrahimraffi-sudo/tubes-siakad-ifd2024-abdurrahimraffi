<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $semesterFilter = $request->input('semester');

        $jadwal = Jadwal::with(['mataKuliah', 'dosen'])
            ->when($search, function ($query, $search) {
                $query->whereHas('mataKuliah', function ($q) use ($search) {
                    $q->where('nama_mk', 'like', "%{$search}%")
                        ->orWhere('kode_mk', 'like', "%{$search}%");
                })->orWhereHas('dosen', function ($q) use ($search) {
                    $q->where('nama_dosen', 'like', "%{$search}%");
                })->orWhere('ruangan', 'like', "%{$search}%");
            })
            ->when($semesterFilter, function ($query, $semesterFilter) {
                $query->whereHas('mataKuliah', function ($q) use ($semesterFilter) {
                    $q->where('semester', $semesterFilter);
                });
            })
            ->orderBy('hari')->orderBy('jam_mulai')->paginate(10);

        $semesters = MataKuliah::select('semester')->distinct()->orderBy('semester')->pluck('semester');

        return view('admin.jadwal.index', compact('jadwal', 'semesters'));
    }

    public function create(): View
    {
        $mataKuliah = MataKuliah::orderBy('kode_mk')->get();
        $dosen = Dosen::orderBy('nama_dosen')->get();
        return view('admin.jadwal.create', compact('mataKuliah', 'dosen'));
    }

    public function store(JadwalRequest $request): RedirectResponse
    {
        Jadwal::create($request->validated());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal): View
    {
        $jadwal->load(['mataKuliah', 'dosen', 'krs.mahasiswa']);
        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal): View
    {
        $mataKuliah = MataKuliah::orderBy('kode_mk')->get();
        $dosen = Dosen::orderBy('nama_dosen')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'mataKuliah', 'dosen'));
    }

    public function update(JadwalRequest $request, Jadwal $jadwal): RedirectResponse
    {
        $jadwal->update($request->validated());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal): RedirectResponse
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
