<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AuthMiddle
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
        if ($request->session()->has("id")) {
            return $next($request);
        }
        return redirect()->guest("/");
    }
}
