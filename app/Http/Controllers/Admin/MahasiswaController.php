<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class MahasiswaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $mahasiswa = Mahasiswa::with('user')
            ->when($search, function ($query, $search) {
                $query->where('nim', 'like', "%{$search}%")
                    ->orWhere('nama_mahasiswa', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orderBy('nama_mahasiswa')->paginate(10);

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create(): View
    {
        return view('admin.mahasiswa.create');
    }

    public function store(MahasiswaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['nama_mahasiswa'],
            'email' => $data['email'],
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);
        $user->assignRole('mahasiswa');

        $data['user_id'] = $user->id;

        Mahasiswa::create($data);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa): View
    {
        $mahasiswa->load(['user', 'krs.jadwal.mataKuliah', 'krs.jadwal.dosen']);
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->update($request->validated());

        if ($mahasiswa->user) {
            $mahasiswa->user->update([
                'name' => $request->nama_mahasiswa,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        if ($mahasiswa->user) {
            $mahasiswa->user->delete();
        }
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
