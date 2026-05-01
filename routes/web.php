<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PengajuanController;

Route::get('/', function () { return redirect()->route('login'); });

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // anggota
    Route::middleware('role:anggota')->group(function () {
        Route::get('/pinjam', [PengajuanController::class, 'anggotaIndex'])->name('pinjam.index');
        Route::post('/pinjam/store', [PengajuanController::class, 'anggotaStore'])->name('pinjam.store');
    });

    // admin
    Route::middleware('role:admin')->group(function () {

        // tambah user dan anggota
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        Route::post('/users/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::post('/users/update', [UserController::class, 'update'])->name('user.update');

        // tambah buku
        Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
        Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
        Route::post('/buku/delete', [BukuController::class, 'delete'])->name('buku.delete');
        Route::post('/buku/update', [BukuController::class, 'update'])->name('buku.update');

        // pengajuan
        Route::get('/pengajuanbuku', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::post('/pengajuanbuku/approve/{id}', [PengajuanController::class, 'approve']);
        Route::post('/pengajuanbuku/reject/{id}', [PengajuanController::class, 'reject']);
        Route::post('/pengajuanbuku/returned/{id}', [PengajuanController::class, 'returned']);
        Route::post('/pengajuanbuku/delete', [PengajuanController::class, 'delete'])->name('pengajuan.delete');
    });
});