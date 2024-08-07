<?php

use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangTerjualController;
use App\Http\Controllers\KatalogbarangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth','verified'])->name('home');

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

    Route::get('/katalog', [KatalogbarangController::class, 'index'])->name('katalog-barang');

    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk');
    Route::get('/barang-terjual', [BarangTerjualController::class, 'index'])->name('barang-terjual');
});

require __DIR__.'/auth.php';