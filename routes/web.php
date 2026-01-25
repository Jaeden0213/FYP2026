<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AppealController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [TaskController::class, 'index']);


// Appeal route: Allow suspended users to submit (requires auth and verified, but not suspend check)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/appeal', [AppealController::class, 'store'])->name('appeal.store');
});

Route::middleware(['auth', 'verified', 'suspend'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    

    // TASKS
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index'); 
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

//auth means ensure that user is logged in, if not, it will redirect user to login page
//verified means ensure user's (gmail) is verified in their gmail already

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus']);

//ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {


    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'userData'])
        ->name('admin.users');

    Route::get('/growth', [AdminController::class, 'statistics'])
        ->name('admin.growth');

    Route::post('/suspendUser/{id}',[AdminController::class, 'suspendUser'])
        ->name('admin.suspendUser');

    Route::post('/activateUser/{id}',[AdminController::class, 'activateUser'])
        ->name('admin.activateUser');
    
    Route::delete('/deleteUser/{id}',[AdminController::class, 'deleteUser'])
        ->name('admin.deleteUser');

    Route::post('/promoteUser/{id}',[AdminController::class, 'promoteUser'])
        ->name('admin.promoteUser');


});

//jordon these 2 probably we need to group them like the code above
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');
    Route::post('/store/redeem/{id}', [StoreController::class, 'redeem'])->name('store.redeem');
});

Route::get('/inventory', [StoreController::class, 'inventory'])->name('inventory.index');


require __DIR__.'/auth.php';
