<?php

namespace App\Http\Middleware;

use Closure;

class Writer
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {

            return redirect('/');
        }

        if (!auth()->user()->hasRole('Writer')) {

            abort('401');
        }

        return $next($request);
    }
}
