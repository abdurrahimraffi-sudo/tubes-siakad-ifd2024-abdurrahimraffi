@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.mahasiswa.index') }}" class="text-decoration-none text-muted">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card p-4 text-center">
            <div class="user-avatar mx-auto mb-3" style="width:80px;height:80px;font-size:2rem;">{{ strtoupper(substr($mahasiswa->nama_mahasiswa, 0, 1)) }}</div>
            <h5 class="fw-bold mb-1">{{ $mahasiswa->nama_mahasiswa }}</h5>
            <p class="text-muted mb-3">{{ $mahasiswa->nim }}</p>
            <span class="badge bg-primary-subtle text-primary mb-3">Semester {{ $mahasiswa->semester }}</span>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.mahasiswa.edit', $mahasiswa) }}" class="btn btn-outline-primary"><i class="fas fa-edit me-2"></i> Edit</a>
                <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa) }}" method="POST" data-confirm="Hapus data mahasiswa ini?">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100"><i class="fas fa-trash me-2"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Mahasiswa</h6>
            <table class="table table-borderless">
                <tr><th width="150">NIM</th><td>: {{ $mahasiswa->nim }}</td></tr>
                <tr><th>Nama</th><td>: {{ $mahasiswa->nama_mahasiswa }}</td></tr>
                <tr><th>Email</th><td>: {{ $mahasiswa->email }}</td></tr>
                <tr><th>No. HP</th><td>: {{ $mahasiswa->no_hp }}</td></tr>
                <tr><th>Semester</th><td>: {{ $mahasiswa->semester }}</td></tr>
                <tr><th>Alamat</th><td>: {{ $mahasiswa->alamat }}</td></tr>
            </table>
        </div>

        <div class="card p-4 mt-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-clipboard-list text-primary me-2"></i>KRS yang Diambil</h6>
            @if($mahasiswa->krs->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr><th>Mata Kuliah</th><th>SKS</th><th>Dosen</th><th>Hari</th></tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa->krs as $k)
                        <tr>
                            <td>{{ $k->jadwal->mataKuliah->nama_mk }}</td>
                            <td>{{ $k->jadwal->mataKuliah->sks }}</td>
                            <td>{{ $k->jadwal->dosen->nama_dosen }}</td>
                            <td>{{ $k->jadwal->hari }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted text-center py-3 mb-0">Belum mengambil KRS</p>
            @endif
        </div>
    </div>
</div>
@endsection
