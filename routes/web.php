<?php

use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangTerjualController;
use App\Http\Controllers\KatalogbarangController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\ProfileController;
use App\Models\BarangMasuk;
use App\Models\BarangTerjual;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/katalog', function () {
    return view('katalog');
})->middleware(['auth', 'verified'])->name('katalog-barang');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('katalog', KatalogbarangController::class);

    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/detail-barang-masuk/{katalog_barang_id}/', [BarangMasukController::class, 'showDetail'])->name('barang-masuk.detail');

    Route::resource('barang-terjual', BarangTerjualController::class);
    Route::get('/detail-barang-terjual/{katalog_barang_id}/', [BarangTerjualController::class, 'showDetail'])->name('barang-terjual.detail');

    Route::resource('laporan-keuangan', LaporanKeuanganController::class);
});

require __DIR__.'/auth.php';