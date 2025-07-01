<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role_id !== 1) {
            abort(403, 'Access denied. Admin only area.');
        }

        return $next($request);
    }
}
