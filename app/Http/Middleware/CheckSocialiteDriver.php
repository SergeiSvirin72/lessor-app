<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSocialiteDriver
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->driver, ['google', 'yandex'])) {
            abort(404, 'Driver ['.$request->driver.'] is not supported.');
        }
        return $next($request);
    }
}
