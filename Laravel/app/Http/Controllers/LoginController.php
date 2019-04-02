<?php

namespace App\Http\Controllers;
require_once __DIR__.'/../../include.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jxlwqq\IdValidator\IdValidator;

class LoginController extends Controller
{
    public function logout(Request $request) {
        $request->session()->flush();
        return redirect("/");
    }

    /**
     * XXX：这里有待改进
     * app\Request下有一个人继承自Request的LoginPost，
     * 但是将Request替换为LoginPost时，会将连接的数据库表替换为名叫posts的表，
     * 修改这个配置的方法目前还没找到；
     * 解决该问题后可以使用validated方法对post的数据进行初步验证
     */
    public function postLogin(Request $request) {      
        // 获取通过验证的数据...
        // $validated = $request->validated(); 
        if ($request->input('loginType', "default") === "new") {   
            $stu_eid = $request->input("examId", "default");
            $stu_cid = $request->input("perId", "default");
            $this->idValidator = new IdValidator();
            $res_obj_array = DB::select('SELECT * FROM t_student WHERE stu_cid = :stu_cid AND stu_eid = :stu_eid',
                                        ["stu_cid" => $stu_cid,"stu_eid" => $stu_eid]);
            /* 判断该名新生是否存在 */
            if ($res_obj_array) {
                session(["id" => $res_obj_array[0]->id]);
                session(["stu_status" => $res_obj_array[0]->stu_status]);
                session(["stu_degree" => $res_obj_array[0]->stu_degree]);
                session(["stu_num" => $res_obj_array[0]->stu_num]);
                session(["stu_name" => $res_obj_array[0]->stu_name]);
                session(["stu_gen" => $res_obj_array[0]->stu_gen]);
                session(["stu_cid" => $res_obj_array[0]->stu_cid]);
                session(["stu_eid" => $res_obj_array[0]->stu_eid]);
                session(["class_id" => $res_obj_array[0]->class_id]);
                session(["stu_dorm_str" => $res_obj_array[0]->stu_dorm_str]);
                session(["stu_fromSchool" => $res_obj_array[0]->stu_fromSchool]);

                // $request->session()->put("usr", $request->input("stu_cid"));
                return redirect()->intended("/stu");
            }
            return redirect("/");
        }
        return redirect("/");
    }
}
