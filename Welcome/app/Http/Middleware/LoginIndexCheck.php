<?php

namespace App\Http\Middleware;

use Closure;

class LoginIndexCheck
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
        if($request->session()->exists('Auth')){
            switch (session('Auth')){
                case 'new':
                    return redirect('/stu');
                    break;
                case 'old':
                    return redirect('/senior');
                    break;
                case 'admin':
                    return redirect('/admin');
                    break;
            }
        }
        return $next($request);
    }
}
