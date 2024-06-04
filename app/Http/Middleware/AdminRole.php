<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth()->user()->role == 'admin') {
        //     return $next($request);
        // }
        // abort(401);

        switch (Auth()->user()->role) {
            case 'super_admin':
            case 'admin':
                return $next($request);
            default:
                abort(401);
        }
    }
    
}
