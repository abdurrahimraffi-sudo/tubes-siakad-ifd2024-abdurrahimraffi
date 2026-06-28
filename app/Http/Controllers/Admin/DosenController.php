<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $dosen = Dosen::when($search, function ($query, $search) {
            $query->where('nidn', 'like', "%{$search}%")
                ->orWhere('nama_dosen', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->orderBy('nama_dosen')->paginate(10);

        return view('admin.dosen.index', compact('dosen'));
    }

    public function create(): View
    {
        return view('admin.dosen.create');
    }

    public function store(DosenRequest $request): RedirectResponse
    {
        Dosen::create($request->validated());

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen): View
    {
        $dosen->load('jadwal.mataKuliah');
        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen): View
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(DosenRequest $request, Dosen $dosen): RedirectResponse
    {
        $dosen->update($request->validated());

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen): RedirectResponse
    {
        $dosen->delete();

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
}
