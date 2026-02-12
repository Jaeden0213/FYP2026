<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Event;
use App\Models\UserLog;
use App\Models\User;
use App\Models\StoreItem;

use App\Models\Task;
use Carbon\Carbon;

class AdminController extends Controller {

  public function userData(){
    $users = User::all();
    $totalStudents = User::count();
    return view('admin.adminUserData', compact('users','totalStudents')); //take the $users and throw it into the view, var must match the same var in the fn

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

public function suspendUser($id){

    $userToBeSuspended = User::findorfail($id);
    $userToBeSuspended->status = 'suspended';
    $userToBeSuspended->save(); // save no need to make status $fillable

    $totalStudents = User::count();

    $users = User::all();
    return view('admin.adminUserData', compact('users','totalStudents'));

    

}

public function deleteUser($id){
    $userToBeDeleted = User::findorfail($id);
    $userToBeDeleted->delete();

     $totalStudents = User::count();

    $user = User::all();
    return view('admin.adminUserData', compact('users','totalStudents'));
}

public function activateUser($id){
    $userToBeActivated = User::findorfail($id);

    $userToBeActivated->status = 'active';
    $userToBeActivated->save();

    $totalStudents = User::count();

    $users = User::all();
    return view('admin.adminUserData', compact('users','totalStudents'));

}

public function promoteUser($id){
    $userToBePromoted = User::findorfail($id);

    $userToBeActivated->role = 'admin';
    $userToBeActivated->save();

    $totalStudents = User::count();

    $users = User::all();
    return view('admin.adminUserData', compact('users','totalStudents'));

}

    // =====================
    // REWARDS (STORE ITEMS)
    // =====================

    public function rewardsIndex()
    {
        $items = StoreItem::latest()->get();
        return view('admin.adminManageStore', compact('items'));
    }

    public function rewardsCreate()
    {
        return view('admin.adminAddReward'); // create this blade file
    }

        public function rewardsStore(Request $request)
    {
        // ✅ 1) Validate input
        // If validation fails:
        // - normal request => redirect back with errors
        // - AJAX request (expectsJson) => returns 422 with JSON errors
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'points_cost' => 'required|integer|min:1',
            'stock'       => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ 2) If image is uploaded, store it in /storage/app/public/rewards
        // and save path into DB (image_path)
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('rewards', 'public');
        }

        // ✅ 3) Checkbox handling:
        // If checked => true, if not checked => false
        $validated['is_active'] = $request->boolean('is_active');

        // ✅ 4) Create reward item
        $item = StoreItem::create($validated);

        // ✅ 5) If request is AJAX, return JSON instead of redirect
        // Our JS sends: Accept: application/json
        if ($request->expectsJson()) {
            return response()->json([
                'message'  => 'Reward added successfully!',
                'redirect' => route('admin.rewards.index'),
                'item'     => $item, // optional: can use if you want dynamic UI update
            ]);
        }

        // ✅ 6) Normal fallback (non-AJAX submit)
        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Reward added successfully!');
    }


    public function rewardsEdit(StoreItem $item)
    {
        return view('admin.adminEditReward', compact('item'));
    }

    public function rewardsUpdate(Request $request, $id)
{
    $item = StoreItem::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'points_cost' => 'required|integer|min:1',
        'stock' => 'nullable|integer|min:0',
        'description' => 'nullable|string',
        'is_active' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    if ($request->hasFile('image')) {
        $validated['image_path'] = $request->file('image')->store('rewards', 'public');
    }

    $item->update($validated);

    // ✅ If AJAX, return JSON
    if ($request->expectsJson()) {
        return response()->json([
            'message'  => 'Reward updated successfully!',
            'redirect' => route('admin.rewards.index'),
            'item'     => $item,
        ]);
    }

    return redirect()->route('admin.rewards.index')->with('success', 'Reward updated!');
}
    public function rewardsDestroy(StoreItem $item)
    {
        $item->delete();
        return redirect()->route('admin.rewards.index')->with('success', 'Reward deleted!');
    }

    public function rewardsToggle(StoreItem $item)
    {
        $item->update(['is_active' => ! $item->is_active]);
        return back()->with('success', 'Reward status updated!');
    }

    // +1 stock (ignore if Unlimited)
    public function stockInc(StoreItem $item)
    {
        if ($item->stock === null) {
            return back()->with('success', 'Unlimited stock - no change.');
        }

        $item->increment('stock');
        return back()->with('success', 'Stock increased!');
    }

    // -1 stock (min 0, ignore if Unlimited)
    public function stockDec(StoreItem $item)
    {
        if ($item->stock === null) {
            return back()->with('success', 'Unlimited stock - no change.');
        }

        if ($item->stock <= 0) {
            return back()->with('success', 'Stock already at 0.');
        }

        $item->decrement('stock');
        return back()->with('success', 'Stock decreased!');
    }

    public function create()
    {
        return view('admin.adminAddReward');
    }

}
?>