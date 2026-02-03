<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

// Rute Publik (Bisa diakses tanpa token)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rute Terproteksi (Wajib kirim token Bearer)
Route::middleware('auth:sanctum')->group(function () {
    
    // Endpoint Profil User
    Route::get('/users', [AuthController::class, 'getUser']);
    Route::get('/user', [AuthController::class, 'getAllUsers']); // Biasanya admin
    
    // Endpoint Laporan
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/image/{id}', [LaporanController::class, 'getImage']);
    Route::post('/laporan/create', [LaporanController::class, 'store']);
    Route::put('/laporan/update/{id}', [LaporanController::class, 'update']);
    Route::delete('/laporan/delete/{id}', [LaporanController::class, 'destroy']);
    
    // Endpoint Reports
    Route::get('/reports', [ReportsController::class, 'index']);
    Route::post('/reports/create', [ReportsController::class, 'store']);
    Route::put('/reports/update/{id}', [ReportsController::class, 'update']);
    Route::delete('/reports/delete/{id}', [ReportsController::class, 'destroy']);
    
    // Logout
    Route::get('/logout', [AuthController::class, 'logout']);
});