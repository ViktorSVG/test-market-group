<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!\App\Models\Permissions::access($request->route()->getName())) {
            if ($request->ajax()) {
                return response('ACCESS_DENIED', 404);
            }
            abort(404);
        }
        return $next($request);
    }
}
