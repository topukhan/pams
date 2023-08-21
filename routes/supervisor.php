<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\Supervisor\SupervisorLoginController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Supervisor\SupervisorProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['SupervisorAuth'])->group(function () {
    
    Route::get('/supervisor/dashboard', [SupervisorLoginController::class, 'dashboard'])->name('supervisor.dashboard');
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
    //Project proposals
    Route::get('/supervisor/proposalList', [SupervisorController::class, 'proposalList'])->name('supervisor.proposalList');
    Route::get('/supervisor/proposalDetails/{group_id}/{proposal_id}', [SupervisorController::class, 'proposalDetails'])->name('supervisor.proposalDetails');
    Route::get('/supervisor/proposalSuggest/{group_id}/{proposal_id}', [SupervisorController::class, 'proposalSuggest'])->name('supervisor.proposalSuggest');
    Route::post('/supervisor/proposalResponse', [SupervisorController::class, 'proposalResponse'])->name('supervisor.proposalResponse');

    Route::get('/supervisor/profile', [SupervisorProfileController::class, 'index'])->name('supervisor.profile');
    Route::get('/supervisor/profile/edit', [SupervisorProfileController::class, 'edit'])->name('supervisor.profileEdit');
    Route::patch('/supervisor/profile/update', [SupervisorProfileController::class, 'update'])->name('supervisor.profileUpdate');
    // *
    Route::post('/supervisor/logout', [SupervisorLoginController::class, 'logout'])->name('supervisor.logout');


});