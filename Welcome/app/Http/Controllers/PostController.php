<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post as Post;

class PostController extends Controller
{
    public function index() 
    {
        if (session("Auth") === "new") {
            $sysType = "新生";
        } else if (session("Auth") === "old") {
            $sysType = "老生";
        } else if (session("Auth") === "admin") {
            $sysType = "管理员";
        }
        $posts = Post::get();
        return view('stu.posts', [
            'sysType' => $sysType,  // 系统运行模式，新生，老生，管理员
            'messages' => array(
                'unreadNum' => 3, // 未读信息
                'showMessage' => array(   // 选的信息
                    array(
                        'title' => "111", 
                        'context' => "111",
                        'readed' => false,
                    ),
                    array(
                        'title' => "222",
                        'context' => "222",
                        'readed' => true,
                    ),
                ),
                'moreInfoUrl' => "/message", // 更多信息跳转

            ), // 信息
            'stuID' => session('stu_num'), // 学号
            'user' => session('stu_name'), // 用户名
            'userImg' => "userImg", // 用户头像链接 url(site)
            'toInformationURL' => "toInformationURL", // 个人信息url
            'toSettingURL' => "toSettingURL", // 个人设置
            'stuDept' => '$major',
            'stuDormitory' => session('stu_dorm_str'),
            'stuReportTime' => '$enrollTime',
            'posts' => $posts, // 所有通知
            'toLogoutURL' => "/logout"      // 退出登录
        ]);
    }

    public function show($id)
    {
        if (session("Auth") === "new") {
            $sysType = "新生";
        } else if (session("Auth") === "old") {
            $sysType = "老生";
        } else if (session("Auth") === "admin") {
            $sysType = "管理员";
        }
        $post = Post::where([
            ['id',$id],
        ])->get()->first();
        return view('stu.show', [
            'sysType' => $sysType,  // 系统运行模式，新生，老生，管理员
            'messages' => array(
                'unreadNum' => 3, // 未读信息
                'showMessage' => array(   // 选的信息
                    array(
                        'title' => "111",
                        'context' => "111",
                        'readed' => false,
                    ),
                    array(
                        'title' => "222",
                        'context' => "222",
                        'readed' => true,
                    ),
                ),
                'moreInfoUrl' => "/message", // 更多信息跳转

            ), // 信息
            'stuID' => session('stu_num'), // 学号
            'user' => session('stu_name'), // 用户名
            'userImg' => "userImg", // 用户头像链接 url(site)
            'toInformationURL' => "toInformationURL", // 个人信息url
            'toSettingURL' => "toSettingURL", // 个人设置
            'stuDept' => '$major',
            'stuDormitory' => session('stu_dorm_str'),
            'stuReportTime' => '$enrollTime',
            'post' => $post, // 当前通知
            'toLogoutURL' => "/logout"      // 退出登录
        ]);
    }

    public function create()
    {
        return '发布通知';
    }
}
