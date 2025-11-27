<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSubadmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'subadmin') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
