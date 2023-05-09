<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;



Route::get('/admin/register', [AdminLoginController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminLoginController::class, 'registration'])->name('admin.register');
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');