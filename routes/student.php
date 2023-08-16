<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['StudentAuth', 'SetStudentSessionData'])->group(function () { 
    // Routes for authenticated Student users
    Route::get('/student/dashboard', [StudentLoginController::class, 'dashboard'])->name('student.dashboard');

    //Group formation
    // Route::middleware(['can:create-group'])->group(function () {
        Route::get('/student/createGroup', [GroupController::class, 'createGroup'])->name('student.createGroup');
        Route::post('/student/storeGroup', [GroupController::class, 'storeGroup'])->name('student.storeGroup');
    // });

    //Group Request
    // Route::middleware(['can:access-request'])->group(function (){
        Route::get('/student/groupRequests', [GroupController::class, 'groupRequest'])->name(('student.groupRequest'));
        Route::post('/student/groupRequestResponse/{invitation}', [GroupController::class, 'groupRequestResponse'])->name(('student.groupRequestResponse'));
    // });

    //My group
    // Route::middleware(['can:access-my-group'])->group(function () {
        Route::get('/student/myGroup', [GroupController::class, 'myGroup'])->name('student.myGroup');
        Route::get('/student/myGroupDetails', [GroupController::class, 'myGroupDetails'])->name('student.myGroupDetails');
    // });

   //supervisorAvailability
   Route::get('/student/supervisorAvailability', [StudentController::class, 'supervisorAvailability'])->name('student.supervisor.availability');
     

    // Proposal 
    Route::get('/student/proposalForm', [StudentController::class, 'proposalForm'])->name('student.proposalForm');

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
     
     //  
     Route::get('/student/taskList', [StudentController::class, 'taskList'])->name('student.taskList');
     Route::get('/student/taskDetails', [StudentController::class, 'taskDetails'])->name('student.taskDetails');
     Route::get('/student/upcomingEvents', [StudentController::class, 'upcomingEvents'])->name('student.upcomingEvents');
     Route::get('/student/upcomingEventDetails', [StudentController::class, 'upcomingEventDetails'])->name('student.upcomingEventDetails');
     Route::get('/student/assistance', [StudentController::class, 'assistance'])->name('student.assistance');
     Route::get('/student/changePassword', [StudentController::class, 'changePassword'])->name('student.changePassword');
     Route::get('/student/previousProjects', [StudentController::class, 'previousProjects'])->name('student.previousProjects');


     Route::get('/student/groupMemberRequest', [StudentController::class, 'groupMemberRequest'])->name('student.groupMemberRequest');
     Route::post('/student/requestToCoordinator', [StudentController::class, 'requestToCoordinator'])->name('student.requestToCoordinator');

     Route::post('/student/requestToCoordinatorForm', [StudentController::class, 'requestToCoordinatorForm'])->name('student.requestToCoordinatorForm');

    
});