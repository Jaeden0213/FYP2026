<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appeal;

class AppealController extends Controller
{
    public function store(Request $request)
    {
        // Safety: only logged-in users
        //if (!Auth::check()) {
       //     return redirect()->route('login');
      //  }

        // Validate input
        $request->validate([
            'description' => 'required|string|min:10|max:1000',
        ]);

        // Prevent multiple pending appeals
      //  $existingAppeal = Appeal::where('user_id', Auth::id())
      //      ->where('status', 'pending')
      //      ->first();

      //  if ($existingAppeal) {
       //     return back()->with('error', 'You already have a pending appeal.');
      //  }

        // Store appeal

        $userId = Auth::id();

        $appeal = Appeal::create([
            //'user_id' => Auth::id(),
            'user_id' => $userId,
            'description'  => $request->description,
            'status'  => 'pending',
        ]);

        dd($userId);

        return back()->with('success', 'Your appeal has been submitted and is under review.');
    }
}
