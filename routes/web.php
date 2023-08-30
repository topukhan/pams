<?php

use App\Http\Controllers\Coordinator\CoordinatorLoginController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Supervisor\SupervisorLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentLoginController;
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
})->name('welcome');

//Student login
Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/auth', [StudentLoginController::class, 'authenticate'])->name('student.authenticate');

//Supervisor Login
Route::get('/supervisor/login', [SupervisorLoginController::class, 'showLoginForm'])->name('supervisor.login');
Route::post('/supervisor/auth', [SupervisorLoginController::class, 'authenticate'])->name('supervisor.authenticate');

//Coordinator Login
Route::get('/coordinator/login', [CoordinatorLoginController::class, 'showLoginForm'])->name('coordinator.login');
Route::post('/coordinator/auth', [CoordinatorLoginController::class, 'authenticate'])->name('coordinator.authenticate');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});

Route::middleware(['allow.all.authenticated:student,supervisor,coordinator'])->group(function () {
    Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('sendEmail');
});



require __DIR__ . '/auth.php';
include __DIR__ . '/admin.php';
include __DIR__ . '/student.php';
include __DIR__ . '/coordinator.php';
include __DIR__ . '/supervisor.php';
