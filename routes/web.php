<?php

use App\Exports\InventarisExport;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Maatwebsite\Excel\Facades\Excel;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/product', [DashboardController::class, 'product'])->name('login');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('regist');
Route::post('/ceklogin', [LoginController::class, 'authenticate'])->name('cekLogin');
Route::post('/createUser', [LoginController::class, 'createUser'])->name('createUser');

// Settings
Route::get('/settings', [SettingsController::class, 'index']);
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

// Inventaris
Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
Route::post('/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
Route::PATCH('/inventaris/{id}', [InventarisController::class, 'update'])->name('inventaris.update');
Route::delete('/inventaris/{id}', [InventarisController::class, 'destroy'])->name('inventaris.destroy');
Route::get('/inventaris/export', function () {
    return Excel::download(new InventarisExport, 'data_inventaris.xlsx');
})->name('inventaris.export');

// Report
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
