<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [TaskController::class, 'index']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//auth means ensure that user is logged in, if not, it will redirect user to login page
//verified means ensure user's (gmail) is verified in their gmail already

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//TASK

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); 
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
 // any shit inside of the {} will be passed as parameter in contrler
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus']);

require __DIR__.'/auth.php';
