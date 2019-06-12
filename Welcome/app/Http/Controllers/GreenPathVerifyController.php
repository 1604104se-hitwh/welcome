<?php

namespace App\Http\Controllers;

use Barryvdh\Debugbar\Facade;
use Illuminate\Support\Facades\DB;
use App\Models\StudentsHelp;
use Illuminate\Http\Request;

// 绿色通道审核控制块
class GreenPathVerifyController extends Controller
{
    // 前端页面展示
    public function index(Request $request){

        $greenPathLists=StudentsHelp::orderBy('verify','asc')
            ->leftJoin('t_student','t_student_help.student_id','t_student.id')
            ->leftJoin('t_major','t_major.major_num',DB::raw('SUBSTRING(t_student.stu_num,3,3)'))
            ->select([
                't_student.stu_name as name','t_student_help.id as id',
                DB::raw('IF(t_student_help.verify=2,
                "申请未通过",IF(t_student_help.verify=0,
                "申请未审核",IF(t_student_help.verify=1,
                "已通过申请","暂未申请"))) as verify'),
                't_major.major_name as major'
            ])->paginate(10);
        $applyTotal = StudentsHelp::count();
        $needVerify = StudentsHelp::where('verify',0)->count();
        return view('admin.greenPathVerify', [
            'sysType'               => "管理员",
            'user'                  => session("name"),
            'userImg'               => "/avatar",
            'toInformationURL'      => "/admin/personalInfo",
            'needVerify'            => $needVerify,
            'applyTotal'            => $applyTotal,
            'greenPathLists'        => $greenPathLists,
            'getGreenPathInfo'      => '/admin/getGreenPathInfo',               // 获取个人申请信息URL
            'commitVerifyInfo'      => '/admin/commitVerifyInfo',               // 提交审核信息URL

            'toLogoutURL'           => "/logout",                               // 退出登录
        ]);
    }

    // 获取个人信息
    public function getGreenPathInfo(Request $request){
        if($request->has('target')){
            // 个人信息获取
            $data = StudentsHelp::where('t_student_help.id',$request->post('target'))
                ->leftJoin('t_student','t_student.id','t_student_help.student_id')
                ->leftJoin('t_student_info','t_student.id','t_student_info.student_id')
                ->leftJoin('t_major','t_major.major_num',DB::raw('SUBSTRING(stu_num,3,3)'))
                ->leftJoin('t_department','t_department.id','t_major.dept_id')
                ->first([
                    'stu_name as name','stu_num as schoolID',DB::raw('IF(stu_gen="0","男","女") as gender'),
                    't_student.id as id','stu_cid as cid','dept_name as dept',
                    'major_name as major','nation','party','verify','verify_info as verifyInfo',
                    'verify_info','home_addr as homeLocation','files'
                ]);
            // 文件信息获取

            if($data){
                $array=array(
                    "code"  => 200,
                    "msg"   => "Get data successfully!",
                    "data"  => $data,
                );
            }else{
                $array=array(
                    "code"  => 404,
                    "msg"   => "Cannot find the student's apply!",
                    "data"  => "未找到申请！",
                );
            }
        }else{
            $array = array(
                "code"  => 401,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    // 提交审核信息
    public function commitVerifyInfo(Request $request){
        if($request->has(['target','verify'])){
            $get = StudentsHelp::find($request->post('target'));
            if($get){
                $get->verify = $request->post('verify');
                $get->verify_info = $request->post('verifyInfo');
                $get->save();
                $array=array(
                    "code"  => 200,
                    "msg"   => "Save data successfully!",
                    "data"  => "已成功保存信息！",
                );
            }else{
                $array=array(
                    "code"  => 404,
                    "msg"   => "Cannot find the student's apply!",
                    "data"  => "未找到申请！",
                );
            }
        }else{
            $array = array(
                "code"  => 401,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

}
