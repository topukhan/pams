<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'verified'])->group(function(){
    // Student Routes
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/createGroup', [StudentController::class, 'createGroup'])->name('student.createGroup');
    Route::get('/student/proposalForm', [StudentController::class, 'proposalForm'])->name('student.proposalForm');
    Route::get('/student/proposalChangeForm', [StudentController::class, 'proposalChangeForm'])->name('student.proposalChangeForm'); 
    Route::get('/student/pendingGroups', [StudentController::class, 'pendingGroups'])->name('student.pendingGroups');
    Route::get('/student/pendingGroupDetails', [StudentController::class, 'pendingGroupDetails'])->name('student.pendingGroupDetails');

    //Supervisor Routes
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/supervisor/groupRequests', [SupervisorController::class, 'groupRequests'])->name('supervisor.groupRequests');
    Route::get('/supervisor/pendingGroupDetails', [SupervisorController::class, 'pendingGroupDetails'])->name('supervisor.pendingGroupDetails');
    Route::get('/supervisor/approvedGroups', [SupervisorController::class, 'approvedGroups'])->name('supervisor.approvedGroups');
    
});
//Student
Route::get('/student/login', [StudentController::class, 'login'])->name('student.login');
//Supervisor
Route::get('/supervisor/login', [SupervisorController::class, 'login'])->name('supervisor.login');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
