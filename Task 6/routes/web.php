<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

Route::resource('mahasiswa', MahasiswaController::class);

Route::get('/dosen', [DosenController::class, 'index']);

Route::get('/matakuliah', [MatakuliahController::class, 'index']);