@extends('layouts.app')

@section('title', 'KRS Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold mb-1">KRS Saya</h3>
        <p class="text-muted mb-0">Kartu Rencana Studi yang telah diambil</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('mahasiswa.krs.export-excel') }}" class="btn btn-success"><i class="fas fa-file-excel me-2"></i> Export Excel</a>
        <a href="{{ route('mahasiswa.krs.export-pdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf me-2"></i> Cetak PDF</a>
    </div>
</div>

<!-- Summary Card -->
<div class="row g-3 mb-4">
    <div class="col-sm-6">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #2563EB, #1E40AF); color: white;">
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
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #059669, #047857); color: white;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalSks }}</div>
                    <div class="stat-label">Total SKS</div>
                </div>
                <i class="fas fa-layer-group" style="font-size: 2.5rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0"><i class="fas fa-clipboard-list text-primary me-2"></i>Daftar Mata Kuliah</h6>
        <a href="{{ route('mahasiswa.jadwal.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Ambil KRS</a>
    </div>
    @if($krsList->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                    <th width="80">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krsList as $index => $k)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><span class="fw-semibold">{{ $k->jadwal->mataKuliah->kode_mk }}</span></td>
                    <td>{{ $k->jadwal->mataKuliah->nama_mk }}</td>
                    <td><span class="badge bg-success-subtle text-success">{{ $k->jadwal->mataKuliah->sks }} SKS</span></td>
                    <td>{{ $k->jadwal->dosen->nama_dosen }}</td>
                    <td><span class="badge bg-info-subtle text-info">{{ $k->jadwal->hari }}</span></td>
                    <td>{{ $k->jadwal->jam_mulai }} - {{ $k->jadwal->jam_selesai }}</td>
                    <td>{{ $k->jadwal->ruangan }}</td>
                    <td>
                        <form action="{{ route('mahasiswa.krs.drop', $k) }}" method="POST" data-confirm="Drop mata kuliah {{ $k->jadwal->mataKuliah->nama_mk }}?">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Drop"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted py-4">
                    <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
                    Belum mengambil KRS
                </td></tr>
                @endforelse
            </tbody>
            @if($krsList->count() > 0)
            <tfoot>
                <tr class="table-light">
                    <th colspan="3" class="text-end">Total SKS:</th>
                    <th colspan="6"><span class="badge bg-primary" style="font-size:0.9rem;">{{ $totalSks }} SKS</span></th>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
    @else
    <p class="text-muted text-center py-4 mb-0">
        <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
        Belum mengambil KRS. <a href="{{ route('mahasiswa.jadwal.index') }}">Ambil mata kuliah sekarang</a>
    </p>
    @endif
</div>
@endsection
