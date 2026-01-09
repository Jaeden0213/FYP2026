<?php
namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Event;
use App\Models\UserLog;

use App\Models\Task;
use Carbon\Carbon;

class AdminController extends Controller {

  public function userData(){
    $users = User::all();
    return view('adminUserData', compact('users')); //take the $users and throw it into the view, var must match the same var in the fn

  }

  public function userLogs(){

    // listen to successful login
Event::listen(Login::class, function ($event) {
    UserLog::create([
        'user_id' => $event->user->id,
        'type'    => 'login_success',
        'ip'      => request()->ip(),
    ]);
});

// listen to failed login
Event::listen(Failed::class, function ($event) {
    UserLog::create([
        'user_id' => $event->user?->id,
        'type'    => 'login_failed',
        'ip'      => request()->ip(),
    ]);
});

  }

  public function userGrowth(){

    //how many students
    $totalStudents = User::count();

    //how many suspended, active
    $suspendedStudents = User::where('status', 'suspended')->count(); // col must be strings, damn get() means store object collection memory
    $activeStudents = $totalStudents - $suspendedStudents;

    //how many new users every month, week, year
    
    $weeklyStudents = User::where('created_at', '>=', Carbon::now()->subWeek())->count(); //carbon is to translate time
    $monthlyStudents = User::where('created_at', '>=', Carbon::now()->subMonth())->count();
    $yearlyStudents = User::where('created_at', '>=', Carbon::now()->subYear())->count();

    return view('adminUserGrowth', compact('$suspendedStudents', '$totalStudents','$activeStudents','$weeklyStudents','$monthlyStudents', '$yearlyStudents'));

  }
}

?>