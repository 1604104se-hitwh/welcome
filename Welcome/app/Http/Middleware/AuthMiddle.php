<?php

namespace App\Http\Middleware;

use Closure;

/* 用来控制非法访问，只有session中有Auth项才能正常访问 */
class AuthMiddle {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  \String  $role
     * @return mixed
     *
     * 修改了中间件的服务对象
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->session()->has("Auth")) {
            if(session("Auth") == $role)
                return $next($request);
            else
                return abort(403,"未经授权");
        }
        return redirect()->guest("/");
    }
}
