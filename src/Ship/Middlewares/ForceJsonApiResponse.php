<?php

namespace AdminKit\Core\Ship\Middlewares;

use Closure;
use Illuminate\Http\Request;

class ForceJsonApiResponse
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
