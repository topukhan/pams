<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['StudentAuth'])->group(function () { 
    // Routes for authenticated Student users
    Route::get('/student/dashboard', [StudentLoginController::class, 'dashboard'])->name('student.dashboard');

    //Group formation
    Route::get('/student/createGroup', [GroupController::class, 'createGroup'])->name('student.createGroup');
    Route::post('/student/storeGroup', [GroupController::class, 'storeGroup'])->name('student.storeGroup');

    //Group Request
    Route::get('/student/groupRequests', [GroupController::class, 'groupRequest'])->name(('student.groupRequest'));

    
    //My group
    Route::get('/student/myGroup', [GroupController::class, 'myGroup'])->name('student.myGroup');
    Route::get('/student/myGroupDetails', [GroupController::class, 'myGroupDetails'])->name('student.myGroupDetails');

   //supervisorAvailability
   Route::get('/student/supervisorAvailability', [StudentController::class, 'supervisorAvailability'])->name('student.supervisor.availability');

    // Proposal 
    Route::get('/student/proposalForm/', [StudentController::class, 'proposalForm'])->name('student.proposalForm');
    Route::post('/student/proposalForm', [StudentController::class, 'storeProposalForm'])->name('student.store.proposalForm');
    
    //Change Topic
    Route::get('/student/proposalChangeForm', [StudentController::class, 'proposalChangeForm'])->name('student.proposalChangeForm');
    Route::get('/student/pendingGroups', [StudentController::class, 'pendingGroups'])->name('student.pendingGroups');
    Route::get('/student/pendingGroupDetails', [StudentController::class, 'pendingGroupDetails'])->name('student.pendingGroupDetails');

    Route::get('/student/profile', [StudentProfileController::class, 'index'])->name('student.profile');
    Route::get('/student/profile/edit', [StudentProfileController::class, 'edit'])->name('student.profileEdit');
    Route::patch('/student/profile/update', [StudentProfileController::class, 'update'])->name('student.profileUpdate');

    // *
     Route::post('/student/logout', [StudentLoginController::class, 'logout'])->name('student.logout');

});