<?php

use App\Http\Controllers\FacultyLoginController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['FacultyAuth'])->group(function () {
    // Routes for authenticated Faculty users
    // Supervisor
    Route::get('/supervisor/dashboard', [FacultyLoginController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/supervisor/groupRequests', [SupervisorController::class, 'groupRequests'])->name('supervisor.groupRequests');
    Route::get('/supervisor/pendingGroupDetails', [SupervisorController::class, 'pendingGroupDetails'])->name('supervisor.pendingGroupDetails');
    Route::get('/supervisor/approvedGroups', [SupervisorController::class, 'approvedGroups'])->name('supervisor.approvedGroups');
    
    // *
    Route::post('/faculty/logout', [FacultyLoginController::class, 'logout'])->name('faculty.logout');
});