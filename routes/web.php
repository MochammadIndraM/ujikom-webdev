<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SupplierController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::middleware(['auth'])->group(function () {
    // Master Data
    Route::get('/data-obat', function () {
        return view('master-data.data-obat');
    })->name('data-obat');

    Route::get('/data-pelanggan', function () {
        return view('master-data.data-pelanggan');
    })->name('data-pelanggan');

    // Menampilkan daftar supplier
    Route::get('/data-supplier', [SupplierController::class, 'index'])->name('admin.data-supplier');

    // Menyimpan data supplier baru
    Route::post('/data-supplier', [SupplierController::class, 'store'])->name('supplier.store');

    // Memperbarui data supplier
    Route::put('/data-supplier/{kode_supplier}', [SupplierController::class, 'update'])->name('supplier.update');

    // Menghapus data supplier
    Route::delete('/data-supplier/{kode_supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    // Transaksi
    Route::get('/pembelian', function () {
        return view('transaksi.pembelian');
    })->name('pembelian');

    Route::get('/penjualan', function () {
        return view('transaksi.penjualan');
    })->name('penjualan');
});
