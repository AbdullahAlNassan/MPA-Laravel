<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Als je niet ingelogd bent of geen admin bent: 403
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Alleen beheerder.');
        }
        return $next($request);
    }
}
