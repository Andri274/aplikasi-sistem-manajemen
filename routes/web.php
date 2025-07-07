<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Internal\InternalController;
use App\Http\Controllers\Internal\KaryawanController;
use App\Http\Controllers\Internal\SlipGajiController;
use App\Http\Controllers\Internal\RekapSlipGajiController;
use App\Http\Controllers\Internal\MarketingController;
use App\Http\Controllers\Internal\LaporanProduksiVendorController as InternalLaporanProduksiVendorController;
use App\Http\Controllers\Internal\PembelianBahanBakuController as InternalPembelianBahanBakuController;
use App\Http\Controllers\Internal\UserController as InternalUserController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\PembelianBahanBakuController as VendorPembelianBahanBakuController;
use App\Http\Controllers\Vendor\LaporanProduksiVendorController as VendorLaporanProduksiVendorController;
use App\Http\Controllers\Vendor\AbsensiController as VendorAbsensiController;

// ======================== AUTH ========================



// ======================== AUTH ========================
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ======================== INTERNAL ========================
Route::middleware(['auth'])->prefix('internal')->name('internal.')->group(function () {
    // Dashboard
    Route::get('/', [InternalController::class, 'index'])->name('index');

    // User Management
    Route::resource('users', InternalUserController::class)->except(['show']);

    // Karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
    Route::get('/karyawan/import', [KaryawanController::class, 'importForm'])->name('karyawan.import.form'); // 👈 GET form upload
    Route::post('/karyawan/import', [KaryawanController::class, 'import'])->name('karyawan.import');         // 👈 POST proses import

    // Slip Gaji
    Route::get('/slip', [SlipGajiController::class, 'index'])->name('slip.index');
    Route::get('/slip/create', [SlipGajiController::class, 'create'])->name('slip.create');
    Route::post('/slip', [SlipGajiController::class, 'store'])->name('slip.store');
    Route::get('/slip/{id}', [SlipGajiController::class, 'show'])->name('slip.show');
    Route::get('/slip/{id}/cetak', [SlipGajiController::class, 'cetak'])->name('slip.cetak');
    Route::delete('/slip/{id}', [SlipGajiController::class, 'destroy'])->name('slip.destroy');

    // Rekap Slip Gaji
    Route::get('/rekap-slip-gaji', [RekapSlipGajiController::class, 'index'])->name('rekap.index');
    Route::get('/rekap-slip-gaji/export/pdf', [RekapSlipGajiController::class, 'exportPDF'])->name('rekap.export.pdf');
    Route::get('/rekap-slip-gaji/export/excel', [RekapSlipGajiController::class, 'exportExcel'])->name('rekap.export.excel');

    // Marketing
    Route::resource('/marketing', MarketingController::class)->names('marketing');
    Route::get('/marketing/export/pdf', [MarketingController::class, 'exportPdf'])->name('marketing.export.pdf');
    Route::get('/marketing/export/excel', [MarketingController::class, 'exportExcel'])->name('marketing.export.excel');

    // Absensi
    Route::get('/absensi', [\App\Http\Controllers\Internal\AbsensiController::class, 'index'])->name('absensi.index');

    // Pembelian Bahan Baku
    Route::prefix('pembelian')->name('pembelian.')->group(function () {
        Route::get('/', [InternalPembelianBahanBakuController::class, 'index'])->name('index');
        Route::post('/', [InternalPembelianBahanBakuController::class, 'store'])->name('store');
        Route::delete('/{id}', [InternalPembelianBahanBakuController::class, 'destroy'])->name('destroy');
        Route::get('/export/pdf', [InternalPembelianBahanBakuController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/excel', [InternalPembelianBahanBakuController::class, 'exportExcel'])->name('export.excel');
    });

    // Exports
    Route::get('/export/karyawan', [InternalController::class, 'exportKaryawan'])->name('export.karyawan');
    Route::get('/export/slip/excel', [InternalController::class, 'exportSlipExcel'])->name('export.slip.excel');
    Route::get('/export/produksi/pdf', [InternalController::class, 'exportProduksiPdf'])->name('export.produksi.pdf');
    Route::get('/export/produksi/excel', [InternalController::class, 'exportProduksiExcel'])->name('export.produksi.excel');
    Route::get('/export/absensi/pdf', [InternalController::class, 'exportAbsensiPdf'])->name('export.absensi.pdf');
    Route::get('/export/absensi/excel', [InternalController::class, 'exportAbsensiExcel'])->name('export.absensi.excel');

    // Laporan Produksi Vendor (Internal)
    Route::get('/produksi', [InternalLaporanProduksiVendorController::class, 'index'])->name('produksi.index');
    Route::get('/produksi/pdf', [InternalLaporanProduksiVendorController::class, 'cetakPDF'])->name('produksi.pdf');
});

// ======================== VENDOR ========================
Route::middleware(['auth'])->prefix('vendor')->name('vendor.')->group(function () {
    // Dashboard
    Route::get('/', [VendorController::class, 'index'])->name('index');
    Route::post('/', [VendorController::class, 'store'])->name('store');
    Route::put('/{id}', [VendorController::class, 'update'])->name('update');
    Route::delete('/{id}', [VendorController::class, 'destroy'])->name('destroy');

    // Pembelian Bahan Baku
    Route::get('/pembelian', [VendorPembelianBahanBakuController::class, 'index'])->name('pembelian.index');
    Route::post('/pembelian', [VendorPembelianBahanBakuController::class, 'store'])->name('pembelian.store');
    Route::delete('/pembelian/{id}', [VendorPembelianBahanBakuController::class, 'destroy'])->name('pembelian.destroy');
    Route::get('/pembelian/export/pdf', [VendorPembelianBahanBakuController::class, 'exportPdf'])->name('pembelian.export.pdf');
    Route::get('/pembelian/export/excel', [VendorPembelianBahanBakuController::class, 'exportExcel'])->name('pembelian.export.excel');

    // Absensi
    Route::get('/absensi', [VendorAbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi', [VendorAbsensiController::class, 'store'])->name('absensi.store');

    // Laporan Produksi Vendor
    Route::get('/laporan', [VendorLaporanProduksiVendorController::class, 'index'])->name('laporan.index');
    Route::post('/laporan', [VendorLaporanProduksiVendorController::class, 'store'])->name('laporan.store');
    Route::put('/laporan/{id}', [VendorLaporanProduksiVendorController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id}', [VendorLaporanProduksiVendorController::class, 'destroy'])->name('laporan.destroy');
});



// Route::get('/', function () {
//     return redirect()->route('login');
// });

