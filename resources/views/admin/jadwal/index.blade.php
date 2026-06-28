@extends('layouts.app')

@section('title', 'Jadwal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold mb-1">Jadwal Kuliah</h3>
        <p class="text-muted mb-0">Kelola jadwal perkuliahan</p>
    </div>
    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Jadwal
    </a>
</div>

<div class="card p-4">
    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari mata kuliah, dosen, ruangan...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="semester">
                    <option value="">Semua Semester</option>
                    @foreach($semesters as $s)
                    <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>Semester {{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100"><i class="fas fa-filter me-1"></i> Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.jadwal.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-redo"></i> Reset</a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Kelas</th>
                    <th>Ruangan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $index => $item)
                <tr>
                    <td>{{ $jadwal->firstItem() + $index }}</td>
                    <td>
                        <div class="fw-semibold">{{ $item->mataKuliah->nama_mk }}</div>
                        <small class="text-muted">{{ $item->mataKuliah->kode_mk }} - {{ $item->mataKuliah->sks }} SKS</small>
                    </td>
                    <td>{{ $item->dosen->nama_dosen }}</td>
                    <td><span class="badge bg-info-subtle text-info">{{ $item->hari }}</span></td>
                    <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->ruangan }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.jadwal.show', $item) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.jadwal.edit', $item) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.jadwal.destroy', $item) }}" method="POST" data-confirm="Hapus jadwal ini?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">
                    <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
                    Tidak ada data jadwal
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan {{ $jadwal->count() }} dari {{ $jadwal->total() }} data</small>
        {{ $jadwal->links() }}
    </div>
</div>
@endsection
