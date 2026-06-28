<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\KrsController as AdminKrsController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController as MahasiswaJadwalController;
use App\Http\Controllers\Mahasiswa\KrsController as MahasiswaKrsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', AdminMahasiswaController::class);
        Route::resource('mata-kuliah', MataKuliahController::class)->parameters([
            'mata-kuliah' => 'mataKuliah'
        ]);
        Route::resource('jadwal', AdminJadwalController::class);

        Route::get('/krs', [AdminKrsController::class, 'index'])->name('krs.index');
        Route::get('/krs/export-excel', [AdminKrsController::class, 'exportExcel'])->name('krs.export-excel');
        Route::get('/krs/export-pdf', [AdminKrsController::class, 'exportPdf'])->name('krs.export-pdf');
    });

    // Mahasiswa Routes
    Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('role:mahasiswa')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');

        Route::get('/jadwal', [MahasiswaJadwalController::class, 'index'])->name('jadwal.index');

        Route::get('/krs', [MahasiswaKrsController::class, 'index'])->name('krs.index');
        Route::post('/krs/ambil', [MahasiswaKrsController::class, 'ambil'])->name('krs.ambil');
        Route::delete('/krs/{krs}/drop', [MahasiswaKrsController::class, 'drop'])->name('krs.drop');
        Route::get('/krs/export-pdf', [MahasiswaKrsController::class, 'exportPdf'])->name('krs.export-pdf');
        Route::get('/krs/export-excel', [MahasiswaKrsController::class, 'exportExcel'])->name('krs.export-excel');
    });
});
