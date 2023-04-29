<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/student/dashboard', function () {
    return view('frontend.student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/student/createGroup', function () {
    return view('frontend.student.createGroup');
})->middleware(['auth', 'verified'])->name('createGroup');


Route::get('/student/form', function () {
    return view('frontend.student.form');
})->middleware(['auth', 'verified'])->name('form');

Route::get('/student/pendingGroups', function () {
    return view('frontend.student.pendingGroups');
})->middleware(['auth', 'verified'])->name('pendingGroups');

Route::get('/student/pendingDetails', function () {
    return view('frontend.student.pendingDetails');
})->middleware(['auth', 'verified'])->name('pendingDetails');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
