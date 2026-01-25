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
            'description' => 'required|string|max:1000',
        ]);

        // Prevent multiple pending appeals
      //  $existingAppeal = Appeal::where('user_id', Auth::id())
      //      ->where('status', 'pending')
      //      ->first();

      //  if ($existingAppeal) {
       //     return back()->with('error', 'You already have a pending appeal.');
      //  }

        // Store appeal

       //$userId = Auth::id();

        $userId = Auth::id();
    
    // Add these logs
    \Log::info('Appeal submission attempt', [
        'user_id' => $userId,
        'description' => $request->description,
        'status' => 'pending',
        'is_authenticated' => Auth::check(),
        'session_user' => Auth::user() ? Auth::user()->id : 'none',
    ]);
    
    // Then proceed to create...
    $appeal = Appeal::create([
        'user_id' => $userId,
        'description' => $request->description,
        'status' => 'pending',
    ]);
    
    \Log::info('Appeal created', ['appeal_id' => $appeal->id ?? 'failed']);

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return back()->with('success', 'Your appeal has been submitted and is under review.');

    }
}
