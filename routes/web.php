<?php

use App\Http\Controllers\ApotekerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SupplierController;
use App\Models\Penjualan;

// Authentication Routes
Route::get('/', [ObatController::class, 'showIndex'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Master Data - Obat
    Route::get('/data-obat', [ObatController::class, 'index'])->name('admin.data-obat');
    Route::post('/data-obat', [ObatController::class, 'store'])->name('obat.store');
    Route::put('/data-obat/{kode_obat}', [ObatController::class, 'update'])->name('obat.update');
    Route::delete('/data-obat/{kode_obat}', [ObatController::class, 'destroy'])->name('obat.destroy');

    // Master Data - Pelanggan
    Route::get('/data-pelanggan', [PelangganController::class, 'index'])->name('admin.data-pelanggan');
    Route::post('/data-pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/data-pelanggan/{kode_pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/data-pelanggan/{kode_pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    // Master Data - Supplier
    Route::get('/data-supplier', [SupplierController::class, 'index'])->name('admin.data-supplier');
    Route::post('/data-supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::put('/data-supplier/{kode_supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/data-supplier/{kode_supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    // Master Data - Apoteker
    Route::get('/data-apoteker', [ApotekerController::class, 'index'])->name('admin.data-apoteker');
    Route::post('/data-apoteker', [ApotekerController::class, 'store'])->name('apoteker.store');
    Route::put('/data-apoteker/{kode_apoteker}', [ApotekerController::class, 'update'])->name('apoteker.update');
    Route::delete('/data-apoteker/{kode_apoteker}', [ApotekerController::class, 'destroy'])->name('apoteker.destroy');

    // Transaksi

    // Route untuk halaman pembelian
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::post('/pembelian/simpan', [PembelianController::class, 'simpan'])->name('pembelian.simpan');
    // Route untuk mendapatkan data obat berdasarkan supplier
    Route::get('/get-obat-by-supplier/{supplierId}', [PembelianController::class, 'getObatBySupplier'])->name('pembelian.getObatBySupplier');

    Route::get('/riwayat-pembelian', [PembelianController::class, 'show'])->name('riwayat.pembelian');


    // Route untuk halaman penjualan
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::post('/penjualan/simpan', [PenjualanController::class, 'simpan'])->name('penjualan.simpan');
    // Route untuk mendapatkan data obat berdasarkan supplier
    Route::get('/get-obat-by-supplier/{supplierId}', [PenjualanController::class, 'getObatBySupplier'])->name('penjualan.getObatBySupplier');
    Route::get('/riwayat-penjualan', [PenjualanController::class, 'show'])->name('riwayat.penjualan');
});
