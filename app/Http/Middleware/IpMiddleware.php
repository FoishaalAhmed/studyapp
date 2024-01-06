<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (
            settings('admin_security') == 'On' && 
            !in_array($request->ip(), explode(',', settings('ip_address')))
        ) {
            auth()->logout();
            return redirect('/');
        }

        return $next($request);
    }
}
