<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSuspended
{
    public function handle(Request $request, Closure $next): Response
    {
        // If not logged in, go to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If user is active, allow access
        if (Auth::user()->status === 'active') {
            return $next($request);
        }

        // 🚨 USER IS SUSPENDED — LOG THEM OUT
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // API response
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Account suspended'], 403);
        }

        // Web response
        return response()->view('error.suspendedUser', [], 403);
    }
}
