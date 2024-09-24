<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class HandleInertiaAuthenticatedRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() && !$request->expectsJson()) {
            if ($request->header('X-Inertia')) {
                // just return the invalid response and the login modal will be rendered by the header.vue component
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        }
        
        return $next($request);
    }
}
