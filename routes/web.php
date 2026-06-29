<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ClusteringController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
});

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::post('/transaksi/import', [TransaksiController::class, 'import'])->name('transaksi.import');

    // Clustering
    Route::get('/clustering', [ClusteringController::class, 'index'])->name('clustering.index');
    Route::post('/clustering', [ClusteringController::class, 'run'])->name('clustering.run');
    Route::get('/clustering/hasil', [ClusteringController::class, 'showResults'])->name('clustering.results');
    
    // Laporan
    Route::get('/laporan', [ClusteringController::class, 'reportIndex'])->name('laporan.index');
    Route::get('/laporan/pdf', [ClusteringController::class, 'exportPdf'])->name('laporan.pdf');
});
