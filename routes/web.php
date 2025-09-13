<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KueController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
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

// Keranjang
route::group(['prefix' => 'keranjang', 'as'=>'keranjang.' ],
function(){
    route::get('/index', [KeranjangController::class,'index'])->name('index');
    route::post('/tbh_produk', [KeranjangController::class,'tbh_produk'])->name('tbh_produk');
});
// Tutup Keranjang

// CRUD
Route::group(['middleware' => 'role:admin'], function () {
    Route::resource('kue', KueController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);
});
// Tutup CRUD