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
    // Route::get('/coordinator/formedGroupsLists', [CoordinatorController::class, 'formedGroupsLists'])->name('coordinator.formedGroupsLists');
    Route::get('/coordinator/requests', [CoordinatorRequestController::class, 'requests'])->name('coordinator.requests');
    Route::get('/coordinator/requestDetails/{request}', [CoordinatorRequestController::class, 'requestDetails'])->name('coordinator.requestDetails');
    Route::get('/coordinator/requestGroupDetails', [CoordinatorRequestController::class, 'requestGroupDetails'])->name('coordinator.requestGroupDetails');
    Route::get('/coordinator/requestGroupMembersDetails', [CoordinatorRequestController::class, 'requestGroupMembersDetails'])->name('coordinator.requestGroupMembersDetails');
    Route::get('/coordinator/requestToPropose', [CoordinatorRequestController::class, 'requestToPropose'])->name('coordinator.requestToPropose');

    Route::get('/coordinator/requests/group/{request}', [CoordinatorRequestController::class, 'formedGroupsLists'])->name('coordinator.formedGroupsLists');
    Route::post('/coordinator/requests/addToGroup', [CoordinatorRequestController::class, 'requestedStudentAddToGroup'])->name('coordinator.requestedStudentAddToGroup');
    // *

});