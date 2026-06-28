@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold mb-1">Data Mahasiswa</h3>
        <p class="text-muted mb-0">Kelola data mahasiswa</p>
    </div>
    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Mahasiswa
    </a>
</div>

<div class="card p-4">
    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari NIM, nama, atau email...">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100"><i class="fas fa-filter me-1"></i> Cari</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-redo"></i> Reset</a>
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
                    <th>Email</th>
                    <th>Semester</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $index => $item)
                <tr>
                    <td>{{ $mahasiswa->firstItem() + $index }}</td>
                    <td><span class="fw-semibold">{{ $item->nim }}</span></td>
                    <td>{{ $item->nama_mahasiswa }}</td>
                    <td>{{ $item->email }}</td>
                    <td><span class="badge bg-primary-subtle text-primary">{{ $item->semester }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.mahasiswa.show', $item) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.mahasiswa.edit', $item) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.mahasiswa.destroy', $item) }}" method="POST" data-confirm="Hapus data mahasiswa {{ $item->nama_mahasiswa }}?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">
                    <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
                    Tidak ada data mahasiswa
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan {{ $mahasiswa->count() }} dari {{ $mahasiswa->total() }} data</small>
        {{ $mahasiswa->links() }}
    </div>
</div>
@endsection
