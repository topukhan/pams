<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\CoordinatorLoginController;
use App\Http\Controllers\CoordinatorRequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['CoordinatorAuth'])->group(function () {
    // Routes for authenticated Coordinator users
    Route::get('/coordinator/dashboard', [CoordinatorLoginController::class, 'dashboard'])->name('coordinator.dashboard');
    Route::post('/coordinator/logout', [CoordinatorLoginController::class, 'logout'])->name('coordinator.logout');
    // 
    // Requests (Individual And Group) Add to Group
    Route::get('/coordinator/requests', [CoordinatorRequestController::class, 'requests'])->name('coordinator.requests');
    // Individual request 
    Route::get('/coordinator/requestDetails/{request}', [CoordinatorRequestController::class, 'requestDetails'])->name('coordinator.requestDetails');
    Route::get('/coordinator/requests/group/{request}', [CoordinatorRequestController::class, 'formedGroupsLists'])->name('coordinator.formedGroupsLists');

    Route::get('/coordinator/requestGroupMembersDetails/{group}/{request}', [CoordinatorRequestController::class, 'requestGroupMembersDetails'])->name('coordinator.requestGroupMembersDetails');
    
    Route::post('/coordinator/requests/studentAddToGroup', [CoordinatorRequestController::class, 'requestedStudentAddToGroup'])->name('coordinator.requestedStudentAddToGroup');
    Route::post('/coordinator/requests/transferGroupMembers', [CoordinatorRequestController::class, 'transferGroupMembers'])->name('coordinator.transferGroupMembers');
    // Route::get('/coordinator/requestGroupDetails', [CoordinatorRequestController::class, 'requestGroupDetails'])->name('coordinator.requestGroupDetails');
    // Route::get('/coordinator/requestToPropose', [CoordinatorRequestController::class, 'requestToPropose'])->name('coordinator.requestToPropose');

    // *

});