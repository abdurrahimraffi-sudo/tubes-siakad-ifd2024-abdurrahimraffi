@extends('layouts.app')

@section('title', 'Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h3 class="fw-bold mb-1">Mata Kuliah</h3>
        <p class="text-muted mb-0">Kelola data mata kuliah</p>
    </div>
    <a href="{{ route('admin.mata-kuliah.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Tambah Mata Kuliah
    </a>
</div>

<div class="card p-4">
    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama mata kuliah...">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100"><i class="fas fa-filter me-1"></i> Cari</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-redo"></i> Reset</a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mataKuliah as $index => $item)
                <tr>
                    <td>{{ $mataKuliah->firstItem() + $index }}</td>
                    <td><span class="fw-semibold">{{ $item->kode_mk }}</span></td>
                    <td>{{ $item->nama_mk }}</td>
                    <td><span class="badge bg-success-subtle text-success">{{ $item->sks }} SKS</span></td>
                    <td><span class="badge bg-primary-subtle text-primary">Semester {{ $item->semester }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.mata-kuliah.show', $item) }}" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.mata-kuliah.edit', $item) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.mata-kuliah.destroy', $item) }}" method="POST" data-confirm="Hapus mata kuliah {{ $item->nama_mk }}?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">
                    <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
                    Tidak ada data mata kuliah
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Menampilkan {{ $mataKuliah->count() }} dari {{ $mataKuliah->total() }} data</small>
        {{ $mataKuliah->links() }}
    </div>
</div>
@endsection
