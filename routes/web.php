<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TreeviewController;

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

# ------ Unauthenticated routes ------ #
Route::get('/', [AuthenticatedSessionController::class, 'create']);
require __DIR__.'/auth.php';


# ------ Authenticated routes ------ #
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('home'); # dashboard

    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'myProfile'])->name('profile');
        Route::put('/change-ava', [ProfileController::class, 'changeFotoProfile'])->name('change-ava');
        Route::put('/change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');
    }); # profile group

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/destroy/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/penjualan/data', [PenjualanController::class, 'penjualan'])->name('penjualan.penjualan');

    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::post('/penjualan/add_to_cart', [PenjualanController::class, 'addToCart'])->name('penjualan.add_to_cart');
    Route::delete('/penjualan/remove_from_cart/{id}', [PenjualanController::class, 'removeFromCart'])->name('penjualan.remove_from_cart');
    Route::post('/penjualan/bayar', [PenjualanController::class, 'bayar'])->name('penjualan.bayar');
    Route::post('/penjualan/simpan_pelanggan', [PenjualanController::class, 'simpanPelanggan'])->name('penjualan.simpan_pelanggan');
    Route::patch('/penjualan/update_quantity/{id}', [PenjualanController::class, 'updateQuantity'])->name('penjualan.update_quantity');
    Route::get('/penjualan/filter', [PenjualanController::class, 'filterPenjualan'])->name('penjualan.filter');
    Route::get('/penjualan/exportPDF', [PenjualanController::class, 'exportPDF'])->name('penjualan.exportPDF');


    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::delete('/pelanggan/destroy/{id}', [pelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::get('/detail_penjualan', [DetailPenjualanController::class, 'index'])->name('detail_penjualan.index');
Route::get('/detail_penjualan/pdf/{DetailID}', [DetailPenjualanController::class, 'generatePDF'])->name('detail_penjualan.pdf');

    Route::resource('users', UserController::class);
    Route::resource('treeview', TreeviewController::class)->only('index');
    Route::resource('profit', ProfitController::class)->only('index');
});
