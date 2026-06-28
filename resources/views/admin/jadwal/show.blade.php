@extends('layouts.app')

@section('title', 'Detail Jadwal')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.jadwal.index') }}" class="text-decoration-none text-muted">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-5">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Jadwal</h6>
            <table class="table table-borderless">
                <tr><th width="120">Mata Kuliah</th><td>: {{ $jadwal->mataKuliah->nama_mk }}</td></tr>
                <tr><th>Kode MK</th><td>: {{ $jadwal->mataKuliah->kode_mk }}</td></tr>
                <tr><th>SKS</th><td>: {{ $jadwal->mataKuliah->sks }}</td></tr>
                <tr><th>Dosen</th><td>: {{ $jadwal->dosen->nama_dosen }}</td></tr>
                <tr><th>Hari</th><td>: {{ $jadwal->hari }}</td></tr>
                <tr><th>Jam</th><td>: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td></tr>
                <tr><th>Kelas</th><td>: {{ $jadwal->kelas }}</td></tr>
                <tr><th>Ruangan</th><td>: {{ $jadwal->ruangan }}</td></tr>
            </table>
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="btn btn-outline-primary flex-fill"><i class="fas fa-edit me-2"></i> Edit</a>
                <form action="{{ route('admin.jadwal.destroy', $jadwal) }}" method="POST" data-confirm="Hapus jadwal ini?">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-users text-primary me-2"></i>Mahasiswa yang Mengambil ({{ $jadwal->krs->count() }})</h6>
            @if($jadwal->krs->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr><th>NIM</th><th>Nama</th><th>Semester</th></tr>
                    </thead>
                    <tbody>
                        @foreach($jadwal->krs as $k)
                        <tr>
                            <td>{{ $k->mahasiswa->nim }}</td>
                            <td>{{ $k->mahasiswa->nama_mahasiswa }}</td>
                            <td>{{ $k->mahasiswa->semester }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted text-center py-3 mb-0">Belum ada mahasiswa yang mengambil</p>
            @endif
        </div>
    </div>
</div>
@endsection
