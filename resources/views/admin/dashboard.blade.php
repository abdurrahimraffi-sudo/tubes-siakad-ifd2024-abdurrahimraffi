@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1">Dashboard Admin</h3>
    <p class="text-muted mb-0">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>!</p>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-4 col-xl">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #2563EB, #1E40AF); color: white;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalDosen }}</div>
                    <div class="stat-label">Total Dosen</div>
                </div>
                <i class="fas fa-chalkboard-teacher" style="font-size: 2.5rem; opacity: 0.3;"></i>
            </div>
            <i class="fas fa-chalkboard-teacher stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #059669, #047857); color: white;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalMahasiswa }}</div>
                    <div class="stat-label">Total Mahasiswa</div>
                </div>
                <i class="fas fa-user-graduate" style="font-size: 2.5rem; opacity: 0.3;"></i>
            </div>
            <i class="fas fa-user-graduate stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #D97706, #B45309); color: white;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalMataKuliah }}</div>
                    <div class="stat-label">Mata Kuliah</div>
                </div>
                <i class="fas fa-book" style="font-size: 2.5rem; opacity: 0.3;"></i>
            </div>
            <i class="fas fa-book stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #7C3AED, #6D28D9); color: white;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalJadwal }}</div>
                    <div class="stat-label">Total Jadwal</div>
                </div>
                <i class="fas fa-calendar-alt" style="font-size: 2.5rem; opacity: 0.3;"></i>
            </div>
            <i class="fas fa-calendar-alt stat-icon"></i>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl">
        <div class="card stat-card p-3" style="background: linear-gradient(135deg, #DC2626, #B91C1C); color: white;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-value">{{ $totalKrs }}</div>
                    <div class="stat-label">Total KRS</div>
                </div>
                <i class="fas fa-clipboard-list" style="font-size: 2.5rem; opacity: 0.3;"></i>
            </div>
            <i class="fas fa-clipboard-list stat-icon"></i>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3"><i class="fas fa-chart-bar text-primary me-2"></i>Mahasiswa per Semester</h6>
            <canvas id="chartMahasiswa" height="200"></canvas>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card p-4 h-100">
            <h6 class="fw-bold mb-3"><i class="fas fa-chart-line text-primary me-2"></i>Mata Kuliah per Semester</h6>
            <canvas id="chartMataKuliah" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row g-3">
    <div class="col-12">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-history text-primary me-2"></i>Aktivitas Terbaru</h6>
                <a href="{{ route('admin.krs.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aktivitasTerbaru as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar" style="width:32px;height:32px;font-size:0.75rem;">{{ strtoupper(substr($item->mahasiswa->nama_mahasiswa ?? '?', 0, 1)) }}</div>
                                    <div>
                                        <div class="fw-semibold" style="font-size:0.875rem;">{{ $item->mahasiswa->nama_mahasiswa ?? '-' }}</div>
                                        <small class="text-muted">{{ $item->mahasiswa->nim ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                            <td>{{ $item->jadwal->dosen->nama_dosen ?? '-' }}</td>
                            <td><small class="text-muted">{{ $item->created_at->diffForHumans() }}</small></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada aktivitas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const mhsData = {{ $mahasiswaPerSemester->values()->toJson() }};
const mhsLabels = {{ $mahasiswaPerSemester->keys()->map(fn($s) => "Semester $s")->toJson() }};
const mkData = {{ $mataKuliahPerSemester->values()->toJson() }};
const mkLabels = {{ $mataKuliahPerSemester->keys()->map(fn($s) => "Semester $s")->toJson() }};

new Chart(document.getElementById('chartMahasiswa'), {
    type: 'bar',
    data: {
        labels: mhsLabels,
        datasets: [{
            label: 'Jumlah Mahasiswa',
            data: mhsData,
            backgroundColor: '#2563EB',
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});

new Chart(document.getElementById('chartMataKuliah'), {
    type: 'line',
    data: {
        labels: mkLabels,
        datasets: [{
            label: 'Jumlah Mata Kuliah',
            data: mkData,
            borderColor: '#1E40AF',
            backgroundColor: 'rgba(30,64,175,0.1)',
            fill: true,
            tension: 0.3,
            pointRadius: 5,
            pointBackgroundColor: '#1E40AF',
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
});
</script>
@endpush
