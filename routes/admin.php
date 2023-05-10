<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;


//register
Route::get('/admin/register', [AdminLoginController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminLoginController::class, 'registration'])->name('admin.register');
// login
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
//logout
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/admin/addStudent', [AdminController::class, 'addStudent'])->name('admin.addStudent');
