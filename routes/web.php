<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AppealController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\AiTaskController; 
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\RewardController;

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [TaskController::class, 'index']);

Route::post('/ai/task-breakdown/{id}', [AiTaskController::class, 'breakdownTask'])->name('AIgenerateSubtasks');
Route::get('/tasks/{id}/subtasks-data', function(Request $request, $id) {
    $startTime = (int) $request->query('after');

    $task = \App\Models\Task::findOrFail($id);
    
    $subtasks = $task->subtasks()->where('created_at', '>=' , date('Y-m-d H:i:s', $startTime))->get();

    return response()->json([
        'ready' => $subtasks->count() > 0,
        'data' => $subtasks
    ]);
});

Route::get('/tasks/{id}/subtasks-points', function(Request $request, $id) {
    $startTime = (int) $request->query('after');

    $task = \App\Models\Task::findOrFail($id);
    
    $subtasks = $task->subtasks()->where('created_at', '>=' , date('Y-m-d H:i:s', $startTime))->get();
    $pending = $task->subtasks->where('points', 0)->count();

    return response()->json([
        'ready' => $pending === 0,
        'data' => $subtasks
    ]);
});

//Route::post('/ai/subtask-points/{id}', [AiTaskController::class, 'subTaskPoints'])->name('AIgenerateSubtasksPoints');

//php artisan queue:work


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
    

    //SUBTASKS
    Route::post('/subtasks/{id}', [SubTaskController::class, 'store'])->name('subtasks.store');
    Route::put('/subtasks/{id}/{taskId}', [SubTaskController::class, 'update'])->name('subtasks.update');
    Route::delete('/subtasks/{id}', [SubTaskController::class, 'destroy'])->name('subtasks.destroy');
    });

    //CALANDAR
    Route::get('/tasks/calendar', [TaskController::class, 'calendar'])->name('tasks.calendar');

    //gamefication - store routes
    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');
    Route::post('/store/redeem/{id}', [StoreController::class, 'redeem'])->name('store.redeem');
    Route::get('/store/pomodoro', function () {return view('store.pomodoro');})->name('store.pomodoro');
    Route::post('/rewards/use/{id}', [RewardController::class, 'useVoucher'])->name('rewards.use');
    Route::post('/inventory/use-voucher/{id}', [RewardController::class, 'useVoucher'])->name('inventory.useVoucher');

    //NOTIFICATIONS
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');


     // Analytics
    
    Route::get('/analytics/overview-data', [AnalyticsController::class, 'overviewData'])->name('analytics.overviewData');
    Route::get('/analytics/charts-data', [AnalyticsController::class, 'chartsData'])->name('analytics.chartsData');
    Route::get('/analytics/insights-data', [AnalyticsController::class, 'insightsData'])->name('analytics.insightsData');

    // ACHIEVEMENTS
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::post('/achievements/{userAchievementTier}/claim', [AchievementController::class, 'claim'])->name('achievements.claim');
    Route::post('/achievements/{userAchievementTier}/equip-title', [AchievementController::class, 'equipTitle'])->name('achievements.equipTitle');
    Route::post('/achievements/unequip-title', [AchievementController::class, 'unequipTitle'])->name('achievements.unequipTitle');
});

Route::get('/inventory', [StoreController::class, 'inventory'])->name('inventory.index');


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

    //APPEAL
    
    Route::get('/appeals', [AppealController::class, 'index'])->name('admin.appeals');
    Route::post('/appeals/{appeal}/approve', [AppealController::class, 'approve'])->name('admin.appeals.approve');
    Route::post('/appeals/{appeal}/reject', [AppealController::class, 'reject'])->name('admin.appeals.reject');

    // REWARDS (STORE ITEMS)
    Route::get('/rewards', [AdminController::class, 'rewardsIndex'])->name('admin.rewards.index');
    Route::get('/rewards/create', [AdminController::class, 'rewardsCreate'])->name('admin.rewards.create');
    Route::post('/rewards', [AdminController::class, 'rewardsStore'])->name('admin.rewards.store');
    Route::get('/rewards/add', [AdminController::class, 'rewardsCreate'])->name('admin.addReward');

    Route::get('/rewards/{item}/edit', [AdminController::class, 'rewardsEdit'])->name('admin.rewards.edit');
    Route::put('/rewards/{item}', [AdminController::class, 'rewardsUpdate'])->name('admin.rewards.update');
    Route::delete('/rewards/{item}', [AdminController::class, 'rewardsDestroy'])->name('admin.rewards.destroy');

    Route::patch('/rewards/{item}/toggle', [AdminController::class, 'rewardsToggle'])->name('admin.rewards.toggle');
    Route::patch('/rewards/{item}/stock/inc', [AdminController::class, 'stockInc'])->name('admin.rewards.stock.inc');
    Route::patch('/rewards/{item}/stock/dec', [AdminController::class, 'stockDec'])->name('admin.rewards.stock.dec');

    // ACHIEVEMENTS
    Route::get('/achievements', [AdminController::class, 'achievementsIndex'])->name('admin.achievements.index');
    Route::get('/achievements/create', [AdminController::class, 'achievementsCreate'])->name('admin.achievements.create');
    Route::post('/achievements', [AdminController::class, 'achievementsStore'])->name('admin.achievements.store');

    Route::get('/achievements/add', [AdminController::class, 'achievementsCreate'])->name('admin.addAchievement');

    Route::get('/achievements/{achievement}/edit', [AdminController::class, 'achievementsEdit'])->name('admin.achievements.edit');
    Route::put('/achievements/{achievement}', [AdminController::class, 'achievementsUpdate'])->name('admin.achievements.update');
    Route::delete('/achievements/{achievement}', [AdminController::class, 'achievementsDestroy'])->name('admin.achievements.destroy');

    Route::patch('/achievements/{achievement}/toggle', [AdminController::class, 'achievementsToggle'])->name('admin.achievements.toggle');

});




require __DIR__.'/auth.php';
