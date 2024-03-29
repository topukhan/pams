<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\Admin\ProjectTypeController;
use Illuminate\Support\Facades\Route;


//register
Route::get('/admin/register', [AdminLoginController::class, 'showRegisterForm'])->name('admin.registerForm');
Route::post('/admin/register', [AdminLoginController::class, 'registration'])->name('admin.register');
// login
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
//logout
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');



Route::middleware(['AdminAuth'])->group(function () {
    // Routes for authenticated Admin users
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Add student
    Route::get('/admin/addStudent', [AdminController::class, 'addStudentForm'])->name('admin.addStudentForm');
    Route::post('/admin/addStudent', [AdminController::class, 'addStudent'])->name('admin.addStudent');

    //Add supervisor
    Route::get('/admin/addSupervisor', [AdminController::class, 'addSupervisorForm'])->name('admin.addSupervisorForm');
    Route::post('/admin/addSupervisor', [AdminController::class, 'addSupervisor'])->name('admin.addSupervisor');

    //Add Coordinator
    Route::get('/admin/addCoordinator', [AdminController::class, 'addCoordinatorForm'])->name('admin.addCoordinatorForm');
    Route::post('/admin/addCoordinator', [AdminController::class, 'addCoordinator'])->name('admin.addCoordinator');

    //Add domain
    Route::resource('admin/projectTypes', ProjectTypeController::class);
    Route::resource('admin/designations', DesignationController::class);
    Route::resource('admin/domains', DomainController::class);
});
