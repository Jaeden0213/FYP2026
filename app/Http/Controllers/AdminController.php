<?php
namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Event;
use App\Models\UserLog;
use App\Models\User;

use App\Models\Task;
use Carbon\Carbon;

class AdminController extends Controller {

  public function userData(){
    $users = User::all();
    return view('admin.adminUserData', compact('users')); //take the $users and throw it into the view, var must match the same var in the fn

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
    //$suspendedStudents = User::where('status', 'suspended')->count(); // col must be strings, damn get() means store object collection memory
    //$activeStudents = $totalStudents - $suspendedStudents;

    //how many new users every month, week, year
    
    $weeklyStudents = User::where('created_at', '>=', Carbon::now()->subWeek())->count(); //carbon is to translate time
    $monthlyStudents = User::where('created_at', '>=', Carbon::now()->subMonth())->count();
    $yearlyStudents = User::where('created_at', '>=', Carbon::now()->subYear())->count();

   // return view('adminUserGrowth', compact('suspendedStudents', 'totalStudents','activeStudents','weeklyStudents','monthlyStudents', 'yearlyStudents'));
    return view('admin.adminUserGrowth', compact('totalStudents','weeklyStudents','monthlyStudents', 'yearlyStudents'));
  }


  public function statistics()
{
    // Total counts
    $totalStudents = User::count();
    $weeklyStudents = User::where('created_at', '>=', now()->subWeek())->count();
    $monthlyStudents = User::where('created_at', '>=', now()->subMonth())->count();
    $yearlyStudents = User::where('created_at', '>=', now()->subYear())->count();

    // Registrations over the last 7 days
    $last7Days = collect();
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i);
        $count = User::whereDate('created_at', $date)->count();
        $last7Days->push([
            'date' => $date->format('D'), // Mon, Tue...
            'count' => $count
        ]);
    }

    // Monthly registrations for last 12 months
    $last12Months = collect();
    for ($i = 11; $i >= 0; $i--) {
        $month = Carbon::now()->subMonths($i);
        $count = User::whereYear('created_at', $month->year)
                     ->whereMonth('created_at', $month->month)
                     ->count();
        $last12Months->push([
            'month' => $month->format('M Y'), // Jan 2026
            'count' => $count
        ]);
    }

    return view('admin.adminUserGrowth', compact(
        'totalStudents',
        'weeklyStudents',
        'monthlyStudents',
        'yearlyStudents',
        'last7Days',
        'last12Months'
    ));
}

}

?>