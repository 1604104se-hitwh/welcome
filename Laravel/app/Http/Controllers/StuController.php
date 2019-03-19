<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StuController extends Controller
{
    public function index() 
    {
        return view('stu.index',[
            'sysType'=>"新生",  // 系统运行模式，新生，老生，管理员
            'messages'=>array(
                'unreadNum'=>3,
                'showMessage'=>array(
                    array(
                        'title'=>"111",
                        'context'=>"111",
                        'readed'=>false,
                    ),
                    array(
                        'title'=>"222",
                        'context'=>"222",
                        'readed'=>true,
                    ),
                ),
                'moreInfoUrl'=>"/message",
    
            ), // 信息
            'stuID'=>160820321, // 学号
            'user'=> 'spc', // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", //
            'toSettingURL'=>"toSettingURL", // 个人设置
            'stuDept'=>"计算机",
            'stuDomitory'=>"9公寓",
            'stuReportTime'=>"9月1日",
            'schoolInfo'=>"<div class=\"text-center\"><img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"width: 25rem;\" src=\"img/undraw_posting_photo.svg\" alt=\"\"></div><p>
            哈尔滨工业大学（以下简称哈工大）是一所有着近百年历史、世界知名的工科强校，2017年入选国家“双一流”建设A类高校，是我国首批入选国家“985工程”重点建设的大学，拥有以38位院士为带头人的雄厚师资，有9个国家一级重点学科，10个学科名列全国前五名，其中，名列前茅的工科类重点学科数量位居全国第二，工程学在全球排名第六。</p>", // 学校信息 可以html
            'toSchoolInfoURL'=>"toSchoolInfoURL",
            'toAllStuURL'=>"toAllStuURL", // 所有同学信息url
            'domStus'=>array(),
            'deptInfo'=>"deptInfo", // 专业信息
            'toDeptInfoURL'=>"toDeptInfoURL",
            'domInfo'=>"domInfo", // 宿舍信息
            'toDomInfoURL'=>"toDomInfoURL",
            'localStus'=>array(),
            'toLocalStuURL'=>"toLocalStuURL",
            'toLogoutURL'=>"toLogoutURL",      // 退出登录
            ]);
    }

    public function quiryClass()
    {
        return 'class';
    }

    public function quiryDorm()
    {
        return 'dorm';
    }

    public function quiryContryFolk()
    {
        return view('stu.quiryContryFolk');
    }
}
