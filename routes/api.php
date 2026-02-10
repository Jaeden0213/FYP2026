<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiTaskController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/ai/task-breakdown{id}', [AiTaskController::class, 'breakdownTask'])->name('AIgenerateSubtasks');

Route::post('/test', function () {
    return response()->json(['message' => 'It works!']);
});

