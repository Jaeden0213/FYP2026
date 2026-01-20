<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Check if user is admin
        // Adjust this based on your User model structure
        if (auth()->user()->role === 'admin') {
            return $next($request);
        }
        
        // For API requests
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // For web requests
        abort(403, 'Unauthorized access, YOU ARE NOT AN ADMIN LOL');
    }
}