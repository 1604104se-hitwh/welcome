<?php

namespace App\Http\Controllers;

use App\Models\EnrollCfg;
use App\Models\Major;
use App\Models\Post;
use App\Models\Students;
use App\Models\StudentsInfo;
use Barryvdh\Debugbar\Facade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// 学生个人信息控制器
class StuInfoController extends Controller
{
    // 信息展示块
    public function index(Request $request){
        $showMessages = array();
        $showPosts = Post::orderBy('post_timestamp','desc')->limit(5)->get();
        $unReadPosts = Post::whereNotIn('id',function($query){
            $query->select("post_id")->from("t_post_read")->where("stu_id", session('id'));
        })->get();
        foreach ($showPosts as $post) {
            $showMessages[] = array(
                "title"     => $post->post_title,
                "context"   => mb_strlen($post->post_content,"UTF-8") > 12 ?
                    mb_substr($post->post_content,0,10,"UTF-8")."...":$post->post_content ,
                "toURL"     => "/stu/posts/".$post->id,
                "readed"    => $unReadPosts->where('id',$post->id)->isEmpty()
            );
        }
        /* 报到配置信息 */
        $enrollCfg = EnrollCfg::find(1);
        $enrollTime = ($enrollCfg) ?
            $enrollCfg['enrl_begin_time'] : "暂无信息";
        /* 获取院系 */
        if(session()->exists('stu_num')){
            $majorNum = substr(session('stu_num'),2,3);
            $majorRes = Major::where([
                ['major_num',$majorNum],
            ])->first();
            if($majorRes){
                $major = $majorRes->dept->dept_name;
            }else{
                $major = "暂无院系信息";
            }
        }else{
            $major = "暂无信息";
        }
        /*个人信息获取*/
        $stuInfo =  Students::where('t_student.id',session('id'))
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
                DB::raw('IF(stu_status="PREPARE",true,false) as needVerify'),'stu_status'
            ));
        if($stuInfo->stu_status === "PREPARE"){
            $needCommit = true;
        }else{
            $needCommit = false;
        }

        return view('stu.new.selfInfoManage', [
            'sysType'                       => "新生",                        // 系统运行模式，新生，在校生，管理员
            'messages'                      => array(
                'unreadNum'                 => $unReadPosts->count(), // 未读信息
                'showMessage'               => $showMessages,
                'moreInfoUrl'               => "/stu/post",                 // 更多信息跳转
            ), // 信息
            'stuID'                         => session('stu_num'),      // 学号
            'user'                          => session('stu_name'),     // 用户名
            'userImg'                       => "/avatar",                   // 用户头像链接 url(site)
            'toInformationURL'              => "/stu/personalInfo",         // 个人信息url
            'stuInfo'                       => $stuInfo,                    // 学生个人信息
            'commitInfoURL'                 => "/stu/commitInfo",           // 提交URL
            'needCommit'                    => $needCommit,                      // 是否需要提交

            'stuDept'                       => $major,
            'stuDormitory'                  => session('stu_dorm_str'),
            'stuReportTime'                 => $enrollTime,
            'toLogoutURL'                   => "/logout",                   // 退出登录
        ]);
    }

    // 信息提交
    public function commitInfo(Request $request){
        if($request->has(['target'])){
            $id = $request->post('target');
            Facade::info(Students::where('stu_status','PREPARE')->find($id));
            if(Students::where('stu_status','PREPARE')->find($id)){
                $get = StudentsInfo::firstOrNew(['student_id' => $id]);
                $get->home_addr= $request->post('homeLocation');
                $get->phone_num= $request->post('phone');
                $get->relate= $request->post('relation');
                $get->nation= $request->post('nation');
                $get->party = $request->post('party');
                $get->save();
                $array=array(
                    "code" => 200,
                    "msg" => "Save successfully!",
                    "data" => "成功保存",
                );
            }else{
                $array=array(
                    "code" => 404,
                    "msg" => "Cannot find the students!",
                    "data" => "找不到学生或已经核验完成",
                );
            }
        }else{
            $array=array(
                "code" => 401,
                "msg" => "Missing parameters!",
                "data" => "缺失参数",
            );
        }
        return response()->jsonp($request->input('callback'),$array);
    }
}
