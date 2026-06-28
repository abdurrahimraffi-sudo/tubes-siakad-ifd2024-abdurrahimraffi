@extends('layouts.app')

@section('title', 'Data KRS')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold mb-1">Data KRS</h3>
        <p class="text-muted mb-0">Daftar Kartu Rencana Studi seluruh mahasiswa</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.krs.export-excel') }}" class="btn btn-success"><i class="fas fa-file-excel me-2"></i> Export Excel</a>
        <a href="{{ route('admin.krs.export-pdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf me-2"></i> Export PDF</a>
    </div>
</div>

<div class="card p-4">
    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama mahasiswa, NIM, atau mata kuliah...">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100"><i class="fas fa-filter me-1"></i> Cari</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.krs.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-redo"></i> Reset</a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Tanggal Ambil</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krs as $index => $item)
                <tr>
                    <td>{{ $krs->firstItem() + $index }}</td>
                    <td><span class="fw-semibold">{{ $item->mahasiswa->nim ?? '-' }}</span></td>
                    <td>{{ $item->mahasiswa->nama_mahasiswa ?? '-' }}</td>
                    <td>{{ $item->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                    <td><span class="badge bg-success-subtle text-success">{{ $item->jadwal->mataKuliah->sks ?? 0 }} SKS</span></td>
                    <td>{{ $item->jadwal->dosen->nama_dosen ?? '-' }}</td>
                    <td>{{ $item->jadwal->hari ?? '-' }}</td>
                    <td><small class="text-muted">{{ $item->created_at->format('d/m/Y') }}</small></td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">
                    <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
                    Tidak ada data KRS
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan {{ $krs->count() }} dari {{ $krs->total() }} data</small>
        {{ $krs->links() }}
    </div>
</div>
@endsection
