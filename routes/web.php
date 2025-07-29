<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KueController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/home', [LandingController::class, 'index'])->name('home');
route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::resource('kue', KueController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('satuan', SatuanController::class);
