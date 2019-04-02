<?php

namespace App\Http\Middleware;

// use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Closure;

class CheckMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check == false) {
            return redirect::guest("/");
        }
        return $next($request);
    }
}
