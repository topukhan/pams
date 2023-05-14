<?php

use App\Http\Controllers\FacultyLoginController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['FacultyAuth'])->group(function () {
    // Routes for authenticated Faculty users
    // Supervisor
    Route::get('/supervisor/dashboard', [FacultyLoginController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/supervisor/groupRequests', [SupervisorController::class, 'groupRequests'])->name('supervisor.groupRequests');
    Route::get('/supervisor/groupRequestDetails', [SupervisorController::class, 'groupRequestDetails'])->name('supervisor.groupRequestDetails');
    Route::get('/supervisor/approvedGroups', [SupervisorController::class, 'approvedGroups'])->name('supervisor.approvedGroups');
    Route::get('/supervisor/rejectedGroups', [SupervisorController::class, 'rejectedGroups'])->name('supervisor.rejectedGroups');
    
    // *
    Route::post('/faculty/logout', [FacultyLoginController::class, 'logout'])->name('faculty.logout');
});