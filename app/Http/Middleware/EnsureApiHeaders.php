<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiHeaders
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if Accept header is present
        if (!$request->header('Accept')) {
            return $this->unprocessableResponse([], 'Accept header is required');
        }

        // Check if Content-Type header is present
        if (!$request->header('Content-Type')) {
            return $this->unprocessableResponse([], 'Content-Type header is required');
        }

        return $next($request);

    }
}
