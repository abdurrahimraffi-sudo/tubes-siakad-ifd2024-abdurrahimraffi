@extends('layouts.app')

@section('title', 'Jadwal Kuliah')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1">Jadwal Kuliah</h3>
    <p class="text-muted mb-0">Daftar jadwal perkuliahan dan ambil KRS</p>
</div>

<div class="card p-4">
    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <label class="form-label fw-semibold">Filter Semester</label>
                <select class="form-select" name="semester" onchange="this.form.submit()">
                    <option value="">Semua Semester</option>
                    @foreach($semesters as $s)
                    <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>Semester {{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <a href="{{ route('mahasiswa.jadwal.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-redo me-1"></i> Reset Filter</a>
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
                    <th width="100">Aksi</th>
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
                        @if(in_array($item->id, $krsIds))
                        <span class="badge bg-success-subtle text-success"><i class="fas fa-check me-1"></i> Diambil</span>
                        @else
                        <form action="{{ route('mahasiswa.krs.ambil') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jadwal_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> Ambil</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">
                    <i class="fas fa-inbox d-block mb-2" style="font-size:2rem;"></i>
                    Tidak ada jadwal
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
