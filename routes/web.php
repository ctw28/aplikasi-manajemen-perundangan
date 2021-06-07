<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RancanganController;
use App\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix'=>'rancangan'],function(){
    Route::get('/', [RancanganController::class, 'index'])->name('rancangan');
    Route::get('/tambah-data', [RancanganController::class, 'create'])->name('rancangan.create');
    Route::post('/simpan', [RancanganController::class, 'store'])->name('rancangan.store');
    Route::get('/{id}/edit-data', [RancanganController::class, 'edit'])->name('rancangan.edit');
    Route::put('/{id}', [RancanganController::class, 'update'])->name('rancangan.update');
    Route::get('/{id}/hapus',[RancanganController::class, 'destroy'])->name('rancangan.destroy');
});

Route::group(['prefix'=>'produk'],function(){
    Route::get('/', [ProdukController::class, 'index'])->name('produk');
    Route::get('/tambah-data', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/simpan', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/{id}/hapus',[ProdukController::class, 'destroy'])->name('produk.destroy');
});

// Route::get('/dashboard', 'DashboardController@index')->name('dashboard');