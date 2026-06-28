<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Models\MataKuliah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $mataKuliah = MataKuliah::when($search, function ($query, $search) {
            $query->where('kode_mk', 'like', "%{$search}%")
                ->orWhere('nama_mk', 'like', "%{$search}%");
        })->orderBy('semester')->orderBy('kode_mk')->paginate(10);

        return view('admin.mata-kuliah.index', compact('mataKuliah'));
    }

    public function create(): View
    {
        return view('admin.mata-kuliah.create');
    }

    public function store(MataKuliahRequest $request): RedirectResponse
    {
        MataKuliah::create($request->validated());

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(MataKuliah $mataKuliah): View
    {
        $mataKuliah->load('jadwal.dosen');
        return view('admin.mata-kuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah): View
    {
        return view('admin.mata-kuliah.edit', compact('mataKuliah'));
    }

    public function update(MataKuliahRequest $request, MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->update($request->validated());

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->delete();

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
