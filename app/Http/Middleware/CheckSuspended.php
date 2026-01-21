<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Check if user is suspended
        // Adjust this based on your User model structure
        if (auth()->user()->status === 'active') {
            return $next($request); // access granted, if not fall through and go abort err 403
        }
        
        // For API requests
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Suspended'], 403);
        }
        
        // For web requests
        abort(403, 'Unauthorized access, YOU ARE SUSPENDED LOL');
    }
}
