@extends('layouts.app')

@section('title', 'Detail Dosen')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.dosen.index') }}" class="text-decoration-none text-muted">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-4">
        <div class="card p-4 text-center">
            <div class="user-avatar mx-auto mb-3" style="width:80px;height:80px;font-size:2rem;">{{ strtoupper(substr($dosen->nama_dosen, 0, 1)) }}</div>
            <h5 class="fw-bold mb-1">{{ $dosen->nama_dosen }}</h5>
            <p class="text-muted mb-3">{{ $dosen->nidn }}</p>
            <div class="d-grid gap-2">
                <a href="{{ route('admin.dosen.edit', $dosen) }}" class="btn btn-outline-primary"><i class="fas fa-edit me-2"></i> Edit</a>
                <form action="{{ route('admin.dosen.destroy', $dosen) }}" method="POST" data-confirm="Hapus data dosen ini?">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100"><i class="fas fa-trash me-2"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card p-4">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i>Informasi Dosen</h6>
            <table class="table table-borderless">
                <tr><th width="150">NIDN</th><td>: {{ $dosen->nidn }}</td></tr>
                <tr><th>Nama</th><td>: {{ $dosen->nama_dosen }}</td></tr>
                <tr><th>Email</th><td>: {{ $dosen->email }}</td></tr>
                <tr><th>No. HP</th><td>: {{ $dosen->no_hp }}</td></tr>
                <tr><th>Alamat</th><td>: {{ $dosen->alamat }}</td></tr>
            </table>
        </div>

        <div class="card p-4 mt-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-calendar-alt text-primary me-2"></i>Jadwal Mengajar</h6>
            @if($dosen->jadwal->count() > 0)
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr><th>Mata Kuliah</th><th>Hari</th><th>Jam</th><th>Ruangan</th></tr>
                    </thead>
                    <tbody>
                        @foreach($dosen->jadwal as $j)
                        <tr>
                            <td>{{ $j->mataKuliah->nama_mk }}</td>
                            <td>{{ $j->hari }}</td>
                            <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                            <td>{{ $j->ruangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted text-center py-3 mb-0">Belum ada jadwal mengajar</p>
            @endif
        </div>
    </div>
</div>
@endsection
