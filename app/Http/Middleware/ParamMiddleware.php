<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ParamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $key, $status)
    {
        $api_key = $request->header('API_KEY');
        return $api_key === $key ? $next($request) : response("Access Denied", $status);
    }
}
