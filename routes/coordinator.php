<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\CoordinatorLoginController;
use App\Http\Controllers\CoordinatorRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['CoordinatorAuth'])->group(function () {
    // Routes for authenticated Coordinator users
    Route::get('/coordinator/dashboard', [CoordinatorLoginController::class, 'dashboard'])->name('coordinator.dashboard');
    // 
    Route::get('/coordinator/formedGroupsLists', [CoordinatorController::class, 'formedGroupsLists'])->name('coordinator.formedGroupsLists');
    Route::get('/coordinator/requests', [CoordinatorRequestController::class, 'requests'])->name('coordinator.requests');
    // *
    Route::post('/coordinator/logout', [CoordinatorLoginController::class, 'logout'])->name('coordinator.logout');

});