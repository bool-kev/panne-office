<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $role): ?Response
    {
        // dd( $request->user()->hasRole('operateur'));
        if ( !$request->user()->hasRole($role)) {
            return abort(403,"Vous n'avez pas les droits d'acceder a cette page");
        }
        return $next($request);
    }
}
