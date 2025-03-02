<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('management')->check()) {
            return redirect('/management-login')->with('error', 'Access denied!');
        }

        return $next($request);
    }
}
