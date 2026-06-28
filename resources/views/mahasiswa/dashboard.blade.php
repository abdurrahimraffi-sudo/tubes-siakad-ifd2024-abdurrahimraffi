@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1">Dashboard Mahasiswa</h3>
    <p class="text-muted mb-0">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
</div>

@if(!$mahasiswa)
<div class="card p-5 text-center">
    <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size:3rem;"></i>
    <h5 class="fw-bold">Data mahasiswa belum lengkap</h5>
    <p class="text-muted">Hubungi admin untuk melengkapi data Anda.</p>
</div>
@else
<!-- Biodata Card -->
<div class="row g-3 mb-4">
    <div class="col-lg-4">
        <div class="card p-4 text-center h-100">
            <div class="user-avatar mx-auto mb-3" style="width:80px;height:80px;font-size:2rem;">{{ strtoupper(substr($mahasiswa->nama_mahasiswa, 0, 1)) }}</div>
            <h5 class="fw-bold mb-1">{{ $mahasiswa->nama_mahasiswa }}</h5>
            <p class="text-muted mb-2">{{ $mahasiswa->nim }}</p>
            <span class="badge bg-primary-subtle text-primary mb-3">Semester {{ $mahasiswa->semester }}</span>
            <div class="text-start">
                <div class="mb-2"><i class="fas fa-envelope text-primary me-2"></i><small>{{ $mahasiswa->email }}</small></div>
                <div class="mb-2"><i class="fas fa-phone text-primary me-2"></i><small>{{ $mahasiswa->no_hp }}</small></div>
                <div><i class="fas fa-map-marker-alt text-primary me-2"></i><small>{{ $mahasiswa->alamat }}</small></div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row g-3 h-100">
            <div class="col-sm-6">
                <div class="card stat-card p-3 h-100" style="background: linear-gradient(135deg, #2563EB, #1E40AF); color: white;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-value">{{ $krsList->count() }}</div>
                            <div class="stat-label">Mata Kuliah Diambil</div>
                        </div>
                        <i class="fas fa-book" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card stat-card p-3 h-100" style="background: linear-gradient(135deg, #059669, #047857); color: white;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-value">{{ $totalSks }}</div>
                            <div class="stat-label">Total SKS</div>
                        </div>
                        <i class="fas fa-layer-group" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3 h-100 d-flex align-items-center justify-content-center">
                    <a href="{{ route('mahasiswa.krs.export-pdf') }}" class="btn btn-danger btn-lg w-100" style="border-radius: 12px;">
                        <i class="fas fa-file-pdf me-2"></i> Cetak KRS (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jadwal Hari Ini -->
<div class="card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0"><i class="fas fa-calendar-day text-primary me-2"></i>Jadwal Hari Ini</h6>
        <a href="{{ route('mahasiswa.jadwal.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Jadwal</a>
    </div>
    @if($jadwalHariIni->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Mata Kuliah</th><th>Dosen</th><th>Jam</th><th>Ruangan</th></tr>
            </thead>
            <tbody>
                @foreach($jadwalHariIni as $k)
                <tr>
                    <td><div class="fw-semibold">{{ $k->jadwal->mataKuliah->nama_mk }}</div><small class="text-muted">{{ $k->jadwal->mataKuliah->sks }} SKS</small></td>
                    <td>{{ $k->jadwal->dosen->nama_dosen }}</td>
                    <td>{{ $k->jadwal->jam_mulai }} - {{ $k->jadwal->jam_selesai }}</td>
                    <td>{{ $k->jadwal->ruangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-muted text-center py-3 mb-0"><i class="fas fa-coffee me-2"></i>Tidak ada jadwal hari ini</p>
    @endif
</div>

<!-- Mata Kuliah Diambil -->
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0"><i class="fas fa-clipboard-list text-primary me-2"></i>Mata Kuliah yang Diambil</h6>
        <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-sm btn-outline-primary">Kelola KRS</a>
    </div>
    @if($krsList->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Dosen</th><th>Hari</th></tr>
            </thead>
            <tbody>
                @foreach($krsList as $k)
                <tr>
                    <td><span class="fw-semibold">{{ $k->jadwal->mataKuliah->kode_mk }}</span></td>
                    <td>{{ $k->jadwal->mataKuliah->nama_mk }}</td>
                    <td><span class="badge bg-success-subtle text-success">{{ $k->jadwal->mataKuliah->sks }} SKS</span></td>
                    <td>{{ $k->jadwal->dosen->nama_dosen }}</td>
                    <td><span class="badge bg-info-subtle text-info">{{ $k->jadwal->hari }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-muted text-center py-3 mb-0">Belum mengambil mata kuliah. <a href="{{ route('mahasiswa.jadwal.index') }}">Ambil KRS sekarang</a></p>
    @endif
</div>
@endif
@endsection
