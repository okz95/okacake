<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KueController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/', [LandingController::class, 'index'])->name('landing');
// Auth
route::group(['prefix' => 'auth', 'as'=>'auth.'],
function(){
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class,'login_process'])->name('login.process');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/register', [AuthController::class,'register'])->name('register');
    Route::post('/register', [AuthController::class,'register_process'])->name('register.process');

});
// Tutup Auth

// ------------------ Sistem -------------------
route::get('/dashboard', DashboardController::class)->name('dashboard');

// Profile
route::group(['prefix' => 'profile', 'as'=>'profile.' ],
function(){
    route::get('/index', [ProfileController::class,'index'])->name('index');
    route::get('/edit/{id}', [ProfileController::class,'edit'])->name('edit');
    route::put('/update/{id}', [ProfileController::class,'update'])->name('update');
});
// Tutup Profile

// Toko
route::group(['prefix' => 'toko', 'as'=>'toko.' ],
function(){
    route::get('/index', [TokoController::class,'index'])->name('index');
    route::get('/edit', [TokoController::class,'edit'])->name('edit');
    route::put('/update', [TokoController::class,'update'])->name('update');
});
// Tutup Toko

// Keranjang
route::group(['prefix' => 'keranjang', 'as'=>'keranjang.' ],
function(){
    route::get('/pesanan', [KeranjangController::class,'pesanan'])->name('pesanan');
    route::post('/tbh_produk', [KeranjangController::class,'tbh_produk'])->name('tbh_produk');
    route::put('/update_pesanan', [KeranjangController::class,'update_pesanan'])->name('update_pesanan');
    route::get('/konfirmasi', [KeranjangController::class,'konfirmasi'])->name('konfirmasi');
    route::get('/bayar', [KeranjangController::class,'bayar'])->name('bayar');
    route::put('/upload', [KeranjangController::class,'upload'])->name('upload');
    route::delete('/hapus/{id}', [KeranjangController::class,'hapus'])->name('hapus');
});
// Tutup Keranjang

// Transaksi
route::group(['prefix' => 'transaksi', 'as'=>'transaksi.' ],
function(){
    route::get('/index', [TransaksiController::class,'index'])->name('index');
    route::put('/konfirmasi/{id}', [TransaksiController::class,'konfirmasi'])->name('konfirmasi');
    route::get('/dikirim', [TransaksiController::class,'dikirim'])->name('dikirim');
    route::get('/laporan', [TransaksiController::class,'laporan'])->name('laporan');
    route::get('/cetak/{id}', [TransaksiController::class,'cetak'])->name('cetak');
});
// Tutup Transaksi

// CRUD
Route::group(['middleware' => 'role:admin'], function () {
    Route::resource('kue', KueController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);
});
// Tutup CRUD