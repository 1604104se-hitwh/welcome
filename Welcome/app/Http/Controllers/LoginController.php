<?php

    namespace App\Http\Controllers;
    require_once __DIR__ . '/../../include.php';

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use App\Models\Students as Student;
    use App\Models\Admin;

    /**
     * 此为登录控制器，登录分为三种情况：
     * 新生
     * 在校生
     * 管理员
     */
    class LoginController extends Controller
    {
        public function __construct()
        {

        }

        /* 登录总控 */
        public function login(Request $request)
        {
            /* 判断是否是post表单提交 */
            if (!$request->isMethod("POST")) {
                return redirect("/");
            }
            // 获取通过验证的数据...
            // $validated = $request->validated();
            $loginType = $request->input('loginType', "default");
            if ($loginType === "new") {
                $stu_eid = $request->input("examId", "default");
                $stu_cid = $request->input("perId", "default");
                $res_obj = Student::where([
                    ["stu_cid", $stu_cid],
                    ["stu_eid", $stu_eid],
                ])->whereIn("stu_status", ["PREPARE", "ENROLL"])->first();
                /* 判断该名新生是否存在 */
                if ($res_obj) {
                    // 先清空，避免错误
                    $request->session()->flush();
                    session([
                        "id" => $res_obj->id,
                        "stu_status" => $res_obj->stu_status,
                        "stu_num" => $res_obj->stu_num,
                        "stu_name" => $res_obj->stu_name,
                        "stu_gen" => $res_obj->stu_gen,
                        "stu_cid" => $res_obj->stu_cid,
                        "stu_eid" => $res_obj->stu_eid,
                        //"class_id" => $res_obj->class_id,
                        "stu_dorm_str" => $res_obj->stu_dorm_str,
                        "stu_from_school" => $res_obj->stu_from_school,
                        "Auth" => "new",
                    ]);
                    // $request->session()->put("usr", $request->input("stu_cid"));
                    return redirect()->intended("/stu");
                } else {
                    session()->flash('LoginError', '请输入正确的身份证号和考生号');
                    return redirect("/")->withInput()->with(["examId" => $stu_eid]);
                }
            } else if ($loginType === "old") { // 在校生部分
                $name = $request->input("name", "default");
                $perId = $request->input("perId", "default");
                $res_obj = Student::where([
                    ["stu_name", $name],
                    ["stu_cid", $perId],
                    ["stu_status", "CURRENT"]
                ])->first();
                if ($res_obj) {
                    // 先清空，避免错误
                    $request->session()->flush();
                    session([
                        "id" => $res_obj->id,
                        "stu_name" => $name,
                        "stu_num" => $res_obj->stu_num,
                        "stu_gen" => $res_obj->stu_gen,
                        "stu_cid" => $perId,
                        "stu_eid" => $res_obj->stu_eid,
                        //"class_id" => $res_obj->class_id,
                        "stu_dorm_str" => $res_obj->stu_dorm_str,
                        "stu_from_school" => $res_obj->stu_from_school,
                        "Auth" => "old",
                    ]);
                    return redirect()->intended("/senior");
                } else {
                    session()->flash('LoginError', '请输入正确的姓名和身份证号');
                    return redirect("/")->withInput()->with(["name" => $name]);
                }
            } else if ($loginType === "admin") { // 管理员部分
                $userId = $request->input("userId", "default");
                $psw = $request->input("psw", "default");
                $res_obj = Admin::where("adm_name", $userId)->first();
                if ($res_obj && Hash::check($psw, $res_obj->adm_password)) {
                    // 先清空，避免错误
                    $request->session()->flush();
                    session([
                        "id" => $res_obj->id,
                        "name" => $userId,
                        "Auth" => "admin",
                    ]);
                    return redirect()->intended("/admin");
                } else {
                    session()->flash('LoginError', '请输入正确的用户名和密码');
                    return redirect("/")->withInput()->with(["userId" => $userId]);
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
