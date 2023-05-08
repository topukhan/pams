<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FacultyLoginController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentLoginController;
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
Route::middleware(['auth', 'verified'])->group(function () {
    //Supervisor Routes
    
    Route::get('/supervisor/groupRequests', [SupervisorController::class, 'groupRequests'])->name('supervisor.groupRequests');
    Route::get('/supervisor/pendingGroupDetails', [SupervisorController::class, 'pendingGroupDetails'])->name('supervisor.pendingGroupDetails');
    Route::get('/supervisor/approvedGroups', [SupervisorController::class, 'approvedGroups'])->name('supervisor.approvedGroups');
});
//Student login
Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentLoginController::class, 'authenticate'])->name('student.authenticate');

//Supervisor/ Faculty Login
Route::get('/faculty/login', [FacultyLoginController::class, 'showLoginForm'])->name('faculty.login');
Route::post('/faculty/login', [FacultyLoginController::class, 'authenticate'])->name('faculty.authenticate');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['StudentAuth'])->group(function () {
    // Routes for authenticated Student users
    Route::get('/student/dashboard', [StudentLoginController::class, 'dashboard'])->name('student.dashboard');

    //Group formation
    Route::get('/student/createGroup', [GroupController::class, 'createGroup'])->name('student.createGroup');
    Route::post('/student/createGroup', [GroupController::class, 'storeGroup'])->name('student.storeGroup');
    Route::get('/student/myGroup', [GroupController::class, 'myGroup'])->name('student.myGroup');
    Route::get('/student/myGroupDetails', [GroupController::class, 'myGroupDetails'])->name('student.myGroupDetails');

   


    Route::get('/student/proposalForm', [StudentController::class, 'proposalForm'])->name('student.proposalForm');
    Route::get('/student/proposalChangeForm', [StudentController::class, 'proposalChangeForm'])->name('student.proposalChangeForm');
    Route::get('/student/pendingGroups', [StudentController::class, 'pendingGroups'])->name('student.pendingGroups');
    Route::get('/student/pendingGroupDetails', [StudentController::class, 'pendingGroupDetails'])->name('student.pendingGroupDetails');

    // *
    Route::post('/student/logout', [StudentController::class, 'logout'])->name('student.logout');
});

Route::middleware(['FacultyAuth'])->group(function () {
    // Routes for authenticated Faculty users
    // Supervisor
    Route::get('/supervisor/dashboard', [FacultyLoginController::class, 'dashboard'])->name('supervisor.dashboard');
    
    // *
    Route::post('/faculty/logout', [FacultyController::class, 'logout'])->name('faculty.logout');
});


require __DIR__ . '/auth.php';
