<?php

use App\Http\Controllers\Coordinator;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\FacultyLoginController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['FacultyAuth'])->group(function () {
    // Routes for authenticated Faculty users
    // Supervisor
    Route::get('/supervisor/dashboard', [FacultyLoginController::class, 'dashboard'])->name('supervisor.dashboard');
    //request
    Route::get('/supervisor/groupRequests', [SupervisorController::class, 'groupRequests'])->name('supervisor.groupRequests');
    Route::get('/supervisor/groupRequestDetails', [SupervisorController::class, 'groupRequestDetails'])->name('supervisor.groupRequestDetails');
    //approve
    Route::get('/supervisor/approveGroup', [SupervisorController::class, 'storeApproveGroup'])->name('supervisor.store.approveGroup');
    Route::get('/supervisor/approvedGroups', [SupervisorController::class, 'approvedGroups'])->name('supervisor.approvedGroups');
    Route::get('/supervisor/approvedGroupDetails', [SupervisorController::class, 'approvedGroupDetails'])->name('supervisor.approvedGroupDetails');
    // reject
    Route::get('/supervisor/rejectedGroups', [SupervisorController::class, 'rejectedGroups'])->name('supervisor.rejectedGroups');
    //assign task
    Route::get('/supervisor/assignTask', [SupervisorController::class, 'assignTask'])->name('supervisor.assignTask');
    
    // *
    Route::post('/faculty/logout', [FacultyLoginController::class, 'logout'])->name('faculty.logout');




    //  /////Coordinator
    Route::get('/coordinator/dashboard', [CoordinatorController::class, 'dashboard'])->name('coordinator.dashboard');

    Route::get('/coordinator/formedGroupsLists', [CoordinatorController::class, 'formedGroupsLists'])->name('coordinator.formedGroupsLists');


});