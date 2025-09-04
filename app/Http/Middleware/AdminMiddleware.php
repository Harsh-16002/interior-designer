<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in AND role is 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // If it's an AJAX request, return JSON instead of redirect
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            return redirect('/admin/login');
        }

        return $next($request);
    }
}
