<?php

namespace App\Http\Middleware;

use Closure;

class User
{
    public function handle($request, Closure $next)
    {        
        if (!auth()->check()) {
            return redirect('/');
        }

        if (!auth()->user()->hasRole('User')) {

            abort('401');
        }

        return $next($request);
    }
}
