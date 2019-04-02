<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct() {
        // $this->middleware('checkAuth');
    }
    // 管理员-首页
    public function index(){
        $res = DB::select('SELECT * FROM `t_student` WHERE `stu_status`="PREPARE"');
        $enroll = DB::select('SELECT * FROM `t_student` WHERE `stu_status`="ENROLL"');
        $current = DB::select('SELECT * FROM `t_student` WHERE `stu_status`="CURRENT"');
        return view('admin.index',[
            'sysType'=>"管理员",  // 系统运行模式，新生，老生，管理员
            'user'=>"user", // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", // 个人设置url
            'toSettingURL'=>"toSettingURL", // 个人设置
            'newStuNumber'=>count($res), // 新生人数
            'oldStuNumber'=>count($current), // 老生人数
            'hasReportNumber'=>count($enroll), // 已报到人数
            'stuReportTime'=>"9月1日", // 报到时间
            'schoolInfo'=>"<div class=\"text-center\"><img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"width: 25rem;\" src=\"img/undraw_posting_photo.svg\" alt=\"\"></div><p>
            哈尔滨工业大学（以下简称哈工大）是一所有着近百年历史、世界知名的工科强校，2017年入选国家“双一流”建设A类高校，是我国首批入选国家“985工程”重点建设的大学，拥有以38位院士为带头人的雄厚师资，有9个国家一级重点学科，10个学科名列全国前五名，其中，名列前茅的工科类重点学科数量位居全国第二，工程学在全球排名第六。</p>", // 学校信息 可以html
            'toSetSchoolInfoURL'=>"toSetSchoolInfoURL", // 设置学校信息URL
            'schoolStatistics'=>array(), // 院系状态
            'systemStatus'=>array( // 系统状态
                'newsStatus'=>"未导入", // 新生状态
                'deptStatus'=>"已导入，共23个系", // 院系状态
                'reportStatus'=>"等待开始报到", // 报到状态
            ), 

            'toLogoutURL'=>"toLogoutURL",      // 退出登录
        ]);
    }

    // 管理员-学校信息录入
    public function manageSchoolInfo(){
        return view('admin.insertSchoolInfo',[
            'sysType'=>"管理员",  // 系统运行模式，新生，老生，管理员
            'user'=>"user", // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", // 个人设置url
            'toSettingURL'=>"toSettingURL", // 个人设置
            'newStuNumber'=>2000, // 新生人数
            'oldStuNumber'=>10000, // 老生人数
            'hasReportNumber'=>5, // 已报到人数
            'stuReportTime'=>"9月1日", // 报到时间
            'schoolInfo'=>"<p>学校信息在这里更改</p>", // 设置学校信息
            'deptInfos'=>array(), // 院系信息
            'majorInfos'=>array(), // 专业信息
            'schoolInfoPostURL'=>"", // 学校信息提交URL
            'deptInfoPostURL'=>"", // 院系信息提交URL

            'toLogoutURL'=>"toLogoutURL",      // 退出登录
        ]);
    }

    // 管理员-新生信息录入
    public function manageNewsInfo(){
        return view('admin.newStudentManage',[
            'sysType'=>"管理员",  // 系统运行模式，新生，老生，管理员
            'user'=>"user", // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", // 个人设置url
            'toSettingURL'=>"toSettingURL", // 个人设置
            'newStuNumber'=>2000, // 新生人数
            'oldStuNumber'=>10000, // 老生人数
            'hasReportNumber'=>5, // 已报到人数
            'stuReportTime'=>"9月1日", // 报到时间
            'majorInfos'=>array(), // 专业新生情况
            'newsInfoPostURL'=>"", // 新生信息提交URL


            'toLogoutURL'=>"toLogoutURL",      // 退出登录
        ]);
    }


}
