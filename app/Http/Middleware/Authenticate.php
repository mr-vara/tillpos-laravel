<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle the invalid token provider
     * 
     * @param \Illuminate\Http\Request  $request
     * @param Closure $next
     * @param string|null $guard
     * 
     * @return string|null
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('Authorization');
        if ($token == null) {
            return response()->json(['error' => 'Invalid Token!'], 401);
        } else {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            } else {
                return response()->json(['error' => 'Invalid Token!'], 401);
            }
        }
    }
}
