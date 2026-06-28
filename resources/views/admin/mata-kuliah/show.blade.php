@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.mata-kuliah.index') }}" class="text-decoration-none text-muted">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card p-4 text-center">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#2563EB,#1E40AF);color:white;font-size:2rem;">
                <i class="fas fa-book"></i>
            </div>
            <h5 class="fw-bold mb-1">{{ $mataKuliah->nama_mk }}</h5>
            <p class="text-muted mb-3">{{ $mataKuliah->kode_mk }}</p>
            <div class="d-flex justify-content-center gap-2 mb-3">
                <span class="badge bg-success-subtle text-success">{{ $mataKuliah->sks }} SKS</span>
                <span class="badge bg-primary-subtle text-primary">Semester {{ $mataKuliah->semester }}</span>
            </div>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.mata-kuliah.edit', $mataKuliah) }}" class="btn btn-outline-primary"><i class="fas fa-edit me-2"></i> Edit</a>
                <form action="{{ route('admin.mata-kuliah.destroy', $mataKuliah) }}" method="POST" data-confirm="Hapus mata kuliah ini?">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100"><i class="fas fa-trash me-2"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Mata Kuliah</h6>
            <table class="table table-borderless">
                <tr><th width="150">Kode MK</th><td>: {{ $mataKuliah->kode_mk }}</td></tr>
                <tr><th>Nama</th><td>: {{ $mataKuliah->nama_mk }}</td></tr>
                <tr><th>SKS</th><td>: {{ $mataKuliah->sks }}</td></tr>
                <tr><th>Semester</th><td>: {{ $mataKuliah->semester }}</td></tr>
            </table>
        </div>

        <div class="card p-4 mt-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-calendar-alt text-primary me-2"></i>Jadwal Mata Kuliah</h6>
            @if($mataKuliah->jadwal->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr><th>Dosen</th><th>Hari</th><th>Jam</th><th>Kelas</th><th>Ruangan</th></tr>
                    </thead>
                    <tbody>
                        @foreach($mataKuliah->jadwal as $j)
                        <tr>
                            <td>{{ $j->dosen->nama_dosen }}</td>
                            <td>{{ $j->hari }}</td>
                            <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                            <td>{{ $j->kelas }}</td>
                            <td>{{ $j->ruangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted text-center py-3 mb-0">Belum ada jadwal</p>
            @endif
        </div>
    </div>
</div>
@endsection
