<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated based on your custom login logic
        if (!$request->session()->has('user')) {
            return redirect('/student-login'); // Redirect to login if not authenticated
        }

        return $next($request);
    }
}
