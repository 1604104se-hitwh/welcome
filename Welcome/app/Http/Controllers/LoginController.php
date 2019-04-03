<?php

namespace App\Http\Controllers;
require_once __DIR__ . '/../../include.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginPost;

/**
 * 此为登录控制器，登录分为三种情况：
 * 新生
 * 老生
 * 管理员
 */
class LoginController extends Controller
{
    /**
     * XXX：这里有待改进
     * app\Request下有一个人继承自Request的LoginPost，
     * 但是将Request替换为LoginPost时，会将连接的数据库表替换为名叫posts的表，
     * 修改这个配置的方法目前还没找到；
     * 解决该问题后可以使用validated方法对post的数据进行初步验证
     */

    /* 登录总控 */
    public function login(Request $request)
    {
        // 获取通过验证的数据...
        // $validated = $request->validated(); 
        $loginType = $request->input('loginType', "default");
        if ($loginType === "new") {
            $stu_eid = $request->input("examId", "default");
            $stu_cid = $request->input("perId", "default");
            // $this->idValidator = new IdValidator();
            $res_obj_array = DB::select('SELECT * FROM t_student WHERE 
                                        stu_cid = :stu_cid AND stu_eid = :stu_eid',
                ["stu_cid" => $stu_cid, "stu_eid" => $stu_eid]);
            /* 判断该名新生是否存在 */
            if ($res_obj_array) {
                session([
                    "id" => $res_obj_array[0]->id,
                    "stu_status" => $res_obj_array[0]->stu_status,
                    "stu_num" => $res_obj_array[0]->stu_num,
                    "stu_name" => $res_obj_array[0]->stu_name,
                    "stu_gen" => $res_obj_array[0]->stu_gen,
                    "stu_cid" => $res_obj_array[0]->stu_cid,
                    "stu_eid" => $res_obj_array[0]->stu_eid,
                    "class_id" => $res_obj_array[0]->class_id,
                    "stu_dorm_str" => $res_obj_array[0]->stu_dorm_str,
                    "stu_fromSchool" => $res_obj_array[0]->stu_fromSchool,
                    "Auth" => "new",
                ]);

                // $request->session()->put("usr", $request->input("stu_cid"));
                return redirect()->intended("/stu");
            }
        } else if ($loginType === "old") { // 老生部分
            $name = $request->input("name", "default");
            $perId = $request->input("perId", "default");
            $res_obj_array = DB::select('SELECT * FROM t_student WHERE stu_name = :name 
                                        AND stu_cid = :perId',
                ["name" => $name, "perId" => $perId]);
            if ($res_obj_array) {
                session([
                    "id" => $res_obj_array[0]->id,
                    "stu_name" => $name,
                    "stu_gen" => $res_obj_array[0]->stu_gen,
                    "stu_cid" => $perId,
                    "stu_eid" => $res_obj_array[0]->stu_eid,
                    "class_id" => $res_obj_array[0]->class_id,
                    "stu_dorm_str" => $res_obj_array[0]->stu_dorm_str,
                    "stu_fromSchool" => $res_obj_array[0]->stu_fromSchool,
                    "Auth" => "old",
                ]);
                return redirect()->intended("/senior");
            }
        } else if ($loginType === "admin") { // 管理员部分
            $userId = $request->input("userId", "default");
            $psw = $request->input("psw", "default");
            $res_obj_array = DB::select('SELECT * FROM t_admin WHERE adm_name = :userId 
                                        AND adm_password = :psw',
                ["userId" => $userId, "psw" => $psw]);

                if ($res_obj_array) {
                session([
                    "id" => $res_obj_array[0]->id,
                    "name" => $userId,
                    "Auth" => "admin",
                ]);
                return redirect()->intended("/admin");
            }
        }
        return redirect("/");
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
