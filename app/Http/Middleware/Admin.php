<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {

            return redirect('/');
        }

        if (!auth()->user()->hasRole('Admin')) {
            
            abort('401');
        }

        return $next($request);
    }
}
