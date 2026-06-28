@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.mata-kuliah.index') }}" class="text-decoration-none text-muted">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card p-4">
            <h5 class="fw-bold mb-4"><i class="fas fa-edit text-primary me-2"></i>Edit Mata Kuliah</h5>
            <form action="{{ route('admin.mata-kuliah.update', $mataKuliah) }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Kode MK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" name="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" required>
                        @error('kode_mk') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_mk') is-invalid @enderror" name="nama_mk" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}" required>
                        @error('nama_mk') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">SKS <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('sks') is-invalid @enderror" name="sks" value="{{ old('sks', $mataKuliah->sks) }}" min="1" max="6" required>
                        @error('sks') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Semester <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('semester') is-invalid @enderror" name="semester" value="{{ old('semester', $mataKuliah->semester) }}" min="1" max="14" required>
                        @error('semester') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Update</button>
                    <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
