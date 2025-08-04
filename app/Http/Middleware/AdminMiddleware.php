<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if logged-in user is admin (modify 'is_admin' if using something else)
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
