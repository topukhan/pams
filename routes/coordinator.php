<?php

use App\Http\Controllers\Coordinator\CoordinatorController;
use App\Http\Controllers\Coordinator\CoordinatorLoginController;
use App\Http\Controllers\Coordinator\CoordinatorRequestController;
use App\Http\Controllers\NoticeController;
use App\Models\Coordinator;
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
    //Incomplete Group's Proposal permission
    Route::get('/coordinator/groupApproveForProposal/{request}', [CoordinatorRequestController::class, 'groupApproveForProposal'])->name('coordinator.groupApproveForProposal');
    // *

    Route::get('/coordinator/proposalList', [CoordinatorRequestController::class, 'proposalList'])->name('coordinator.proposalList');

    Route::get('/coordinator/proposalDetails/{group_id}/{proposal_id}', [CoordinatorRequestController::class, 'proposalDetails'])->name('coordinator.proposalDetails');

    Route::get('/coordinator/projectApproval/{request_id}', [CoordinatorRequestController::class, 'projectApproval'])->name('coordinator.projectApproval');
    Route::post('/coordinator/projectApprove/{proposal}', [CoordinatorRequestController::class, 'projectApprove'])->name('coordinator.projectApprove');
    Route::post('/coordinator/reProposalFeedback/{proposal}', [CoordinatorRequestController::class, 'reProposalFeedback'])->name('coordinator.reProposalFeedback');

    Route::get('/coordinator/notice', [NoticeController::class, 'noticeCreate'])->name('coordinator.noticeCreate');
    //coordinator notice create
    Route::post('/coordinator/noticeStore', [CoordinatorController::class, 'noticeStore'])->name('coordinator.noticeStore');


    //notify 
    Route::get('/coordinator/notifications', function () {
        return view('frontend.coordinator.notification');
    })->name('coordinator.notifications');
});
