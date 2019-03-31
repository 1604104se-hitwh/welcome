<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        if($request->input('loginType') == "new"){
            $stu_eid = $request->input("stu_eid");
            $stu_cid = $request->input("stu_cid");
            $res_obj_array = DB::select('SELECT * FROM `t_student` WHERE `stu_eid`="$stu_eid"');
            if ($stu_cid != $res_obj_array[0]->stu_cid) {
                return redirect("/");
            }

            /* 验证当前用户是否拥有session */
            /* $user = User::where('name',$request->input('name'))->first();
            if ($user->is_admin != 1) {
                session()->flash('error','用户名密码错误');
                return redirect('login');
            } */
        }
        return $next($request);
    }
}
