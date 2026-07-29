<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\StokGedungController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\MonitoringStokController;
use App\Http\Controllers\LaporanAdminController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class,'index'])
    ->name('dashboard');

    Route::resource('obat', ObatController::class)->middleware('auth');

    Route::resource('gedung', GedungController::class)->middleware('auth');
        
    Route::resource('user', UserController::class)->middleware('auth');

    Route::resource('distribusi', DistribusiController::class);

    Route::post('/distribusi/{permintaan}/setujui',
        [DistribusiController::class,'setujui'])
        ->name('distribusi.setujui');

    Route::post('/distribusi/{permintaan}/tolak',
        [DistribusiController::class,'tolak'])
        ->name('distribusi.tolak');

    Route::post('/distribusi/{permintaan}/kirim',
        [DistribusiController::class,'kirim'])
        ->name('distribusi.kirim');

    Route::get('/petugas/dashboard', [DashboardPetugasController::class, 'index'])
    ->name('petugas.dashboard');

    Route::resource('permintaan', PermintaanController::class)
    ->middleware('auth');

    Route::get('/stok-gedung', [StokGedungController::class,'index'])
    ->name('stok-gedung.index');

    Route::get('/riwayat-permintaan', [PermintaanController::class,'riwayat'])
    ->name('riwayat.index');

    Route::get('/riwayat-permintaan/{permintaan}', [PermintaanController::class,'showRiwayat'])
    ->name('riwayat.show');

    Route::get('/laporan', [PermintaanController::class,'laporan'])
    ->name('laporan.index');

    Route::get('/laporan/{id}/pdf', [PermintaanController::class,'pdf'])
    ->name('laporan.pdf');

    Route::get('/stok-gedung/{id}/gunakan', [StokGedungController::class,'gunakan'])
    ->name('stok.gunakan');

    Route::post('/stok-gedung/{id}/gunakan', [StokGedungController::class,'simpanPenggunaan'])
    ->name('stok.simpan');

    Route::get('/stok-gedung/form/download', [StokGedungController::class,'downloadForm'])->name('stok.form');

    Route::resource('distribusi', DistribusiController::class);

    Route::get('/monitoring-stok', [MonitoringStokController::class,'index']) ->name('monitoring.index');

    Route::get('/monitoring-stok/{id}', [MonitoringStokController::class,'show']) ->name('monitoring.show');

    Route::get('/laporan-admin', [LaporanAdminController::class, 'index'])->name('laporan.admin.index');

    Route::get('/laporan-admin/distribusi', [LaporanAdminController::class, 'distribusiPdf'])->name('laporan.admin.distribusi');

    Route::get('/laporan-admin/penggunaan', [LaporanAdminController::class, 'penggunaanPdf'])->name('laporan.admin.penggunaan');

    Route::get('/laporan-admin/stok', [LaporanAdminController::class, 'stokPdf']) ->name('laporan.admin.stok');

    Route::get('/laporan/distribusi', [LaporanAdminController::class,'distribusi'])->name('laporan.distribusi');

    Route::get('/laporan/distribusi/pdf', [LaporanAdminController::class,'distribusiPdf'])->name('laporan.distribusi.pdf');

    Route::get('/laporan-admin', [LaporanAdminController::class,'index'])
    ->name('laporan.admin.index');

    Route::get('/laporan-admin/distribusi', [LaporanAdminController::class,'distribusi'])
        ->name('laporan.admin.distribusi');

    Route::get('/laporan-admin/distribusi/preview', [LaporanAdminController::class,'previewDistribusi'])
        ->name('laporan.admin.distribusi.preview');

    Route::get('/laporan-admin/distribusi/pdf', [LaporanAdminController::class,'pdfDistribusi'])
        ->name('laporan.admin.distribusi.pdf');

    Route::get('/laporan-admin/penggunaan', [LaporanAdminController::class, 'penggunaan'])
    ->name('laporan.admin.penggunaan');

    Route::get('/laporan-admin/penggunaan/pdf', [LaporanAdminController::class, 'penggunaanPdf'])
        ->name('laporan.admin.penggunaan.pdf');
    });

require __DIR__.'/auth.php';
