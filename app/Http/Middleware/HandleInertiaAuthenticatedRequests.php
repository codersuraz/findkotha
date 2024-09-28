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
                session()->put('intended', $request->url());
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            // if the request is inertia stop the request and show the login modal

            if(!$request->header('X-Inertia')) {
                session()->flash('showModal', true);
                session()->flash('modalType', 'login');
                session()->put('intended', $request->url());
                session()->flash('message', 'You must be logged in to access this page.');
                return Inertia::location('/');
            }
        }
        
        return $next($request);
    }
}
