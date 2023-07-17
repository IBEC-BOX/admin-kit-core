<?php

namespace AdminKit\Core\Middlewares;

use Closure;
use Illuminate\Http\Request;

class ForceJsonApiResponse
{
    public function handle(Request $request, Closure $next)
    {
        /**
         * Force JSON Response
         */
        if ($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');
        }

        $response = $next($request);

        /**
         * Returns Cyrillic characters in Response
         */
        if ($request->is('api/*')) {
            $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }
}
