<?php

namespace AdminKit\Core\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomCKFinderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        config(['ckfinder.authentication' => function () {
            return true;
        }]);

        return $next($request);
    }
}
