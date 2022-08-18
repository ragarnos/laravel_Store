<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!isAdmin($request->user())) {
            return redirect('/')->with('warn', 'You don\'t have permissions for this page.');
        }

        return $next($request);
    }
}
