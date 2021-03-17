<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param Team $team
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->team) {
            return redirect('/teams');
        }
        return $next($request);
    }
}
