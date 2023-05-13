<?php

use App\Http\Controllers\FacultyLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentLoginController;
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



require __DIR__ . '/auth.php';
include __DIR__ . '/admin.php';
include __DIR__ . '/student.php';
include __DIR__ . '/faculty.php';
