<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use App\Exports\KrsExport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class KrsController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $krs = Krs::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen'])
            ->when($search, function ($query, $search) {
                $query->whereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama_mahasiswa', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                })->orWhereHas('jadwal.mataKuliah', function ($q) use ($search) {
                    $q->where('nama_mk', 'like', "%{$search}%")
                        ->orWhere('kode_mk', 'like', "%{$search}%");
                });
            })->latest()->paginate(15);

        return view('admin.krs.index', compact('krs'));
    }

    public function exportExcel()
    {
        return Excel::download(new KrsExport, 'data-krs.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $krs = Krs::with(['mahasiswa', 'jadwal.mataKuliah', 'jadwal.dosen'])->get();

        $pdf = Pdf::loadView('admin.krs.pdf', compact('krs'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('data-krs.pdf');
    }
}
