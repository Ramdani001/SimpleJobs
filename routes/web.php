<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/product', [DashboardController::class, 'product'])->name('login');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('regist');
Route::post('/ceklogin', [LoginController::class, 'authenticate'])->name('cekLogin');
Route::post('/createUser', [LoginController::class, 'createUser'])->name('createUser');

//Settings
Route::get('/settings', [SettingsController::class, 'index']);
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
