<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Barryvdh\Debugbar\Facade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportCheckController extends Controller
{
    // 页面展示控制块
    public function index(Request $request){

        return view('admin.reportCheck',[
            'sysType'                   =>'管理员',
            'user'                      => session("name"),            // 用户名
            'userImg'                   => "/avatar",                       // 用户头像链接 url(site)
            'toInformationURL'          => "/admin/personalInfo",           // 个人设置url
            'confirmReportInfoURL'      => "/admin/confirmReportInfo",      // 确认信息提交url
            'getStudentInfoURL'         => "/admin/getStudentInfo",         // 获取学生信息url

            'toLogoutURL'               => "/logout",                       // 退出登录
        ]);
    }

    public function getStudentInfo(Request $request){

        if($request->has('studentID')){
            $get = Students::where('stu_num',$request->post('studentID'))
                ->leftJoin('t_student_info','t_student.id','t_student_info.student_id')
                ->leftJoin('t_student_help','t_student.id','t_student_help.student_id')
                ->leftJoin('t_major','t_major.major_num',DB::raw('SUBSTRING(stu_num,3,3)'))
                ->leftJoin('t_department','t_department.id','t_major.dept_id')->first(array(
                    'stu_name as name','stu_num as schoolID',DB::raw('IF(stu_gen="0","男","女") as gender'),
                    't_student.id as id','stu_cid as cid','stu_eid as eid','dept_name as dept',
                    'major_name as major','nation','phone_num as phone',
                    'stu_dorm_str as dorm','party','relate as relation',
                    DB::raw('IF(verify=2,"未通过",IF(verify=0,"未审核",IF(verify=1,"已通过","未申请"))) as greenPath'),
                    'home_addr as homeLocation',
                    DB::raw('IF(stu_status="PREPARE",true,false) as needVerify'),
                    DB::raw('SUBSTRING(stu_num,3,3)')
                ));
            if($get){
                $array = array(
                    "code"  => 200,
                    "msg"   => "Get information successfully!",
                    "data"  => $get
                );
            }else{
                $array = array(
                    "code"  => 404,
                    "msg"   => "Cannot get the student!",
                    "data"  => "找不到这名学生！"
                );
            }
        }else{
            $array = array(
                "code"  => 500,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    public function confirmReportInfo(Request $request){
        if($request->has('confirmID')){
            $get = Students::find($request->post('confirmID'));
            if($get->stu_status==='PREPARE'){
                $get->stu_status="ENROLL";
                $get->save();
                $array = array(
                    "code"  => 200,
                    "msg"   => "Saved!",
                    "data"  => "成功确认！"
                );
            }else if($get->stu_status==='ENROLL'){
                $array = array(
                    "code"  => 405,
                    "msg"   => "Do not confirm again!",
                    "data"  => "已经确认过了，无需重复确认！"
                );
            }else{
                $array = array(
                    "code"  => 404,
                    "msg"   => "Cannot find the information!",
                    "data"  => "找不到信息，可能是老生或者信息错误！"
                );
            }

        }else{
            $array = array(
                "code"  => 500,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }
}
