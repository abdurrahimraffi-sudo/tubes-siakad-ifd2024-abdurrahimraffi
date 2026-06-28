@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.jadwal.index') }}" class="text-decoration-none text-muted">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card p-4">
            <h5 class="fw-bold mb-4"><i class="fas fa-edit text-primary me-2"></i>Edit Jadwal</h5>
            <form action="{{ route('admin.jadwal.update', $jadwal) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mata Kuliah <span class="text-danger">*</span></label>
                        <select class="form-select @error('mata_kuliah_id') is-invalid @enderror" name="mata_kuliah_id" required>
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($mataKuliah as $mk)
                            <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $jadwal->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                            @endforeach
                        </select>
                        @error('mata_kuliah_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dosen <span class="text-danger">*</span></label>
                        <select class="form-select @error('dosen_id') is-invalid @enderror" name="dosen_id" required>
                            <option value="">Pilih Dosen</option>
                            @foreach($dosen as $d)
                            <option value="{{ $d->id }}" {{ old('dosen_id', $jadwal->dosen_id) == $d->id ? 'selected' : '' }}>{{ $d->nidn }} - {{ $d->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('dosen_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Hari <span class="text-danger">*</span></label>
                        <select class="form-select @error('hari') is-invalid @enderror" name="hari" required>
                            <option value="">Pilih Hari</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                            <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                            @endforeach
                        </select>
                        @error('hari') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jam Mulai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" name="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" required>
                        @error('jam_mulai') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Jam Selesai <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" name="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" required>
                        @error('jam_selesai') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" name="kelas" value="{{ old('kelas', $jadwal->kelas) }}" required>
                        @error('kelas') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ruangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan" value="{{ old('ruangan', $jadwal->ruangan) }}" required>
                        @error('ruangan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Update</button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
