<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{   
    private $sysType;
    private $showMessages;
    private $showPosts;

    public function __construct() {
        if (session("Auth") === "new") {
            $this->sysType = "新生";
        } else if (session("Auth") === "old") {
            $this->sysType = "在校生";
        } else if (session("Auth") === "admin") {
            $this->sysType = "管理员";
        }

        // $this->posts = Post::all();
        $this->showMessages = array();
        // $showPosts = Post::all()->take(5);

        /* 从所有通知中选择当前登录用户未读的信息 */
        $this->showPosts = Post::all()->whereNotIn("id", function($query) {
            $query->select("post_id")->from("t_post_read")->where("stu_id", session("stu_num"));
        })->take(5);
        foreach ($this->showPosts as $post) {
            $this->showMessages[] = array(
                "title" => $post->post_title,
                "context" => $post->post_content,
                "readed" => false
            );
        }
    }

    public function index() {       
        $posts = Post::get();
        return view('stu.posts', [
            'sysType' => $this->sysType,  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->showPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
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
            'posts' => $this->posts, // 所有通知，已读和未读的都包括
            'toLogoutURL' => "/logout"      // 退出登录
        ]);
    }

    public function show($id) {
        $post = Post::where([
            ['id',$id],
        ])->get()->first();
        return view('stu.show', [
            'sysType' => $this->sysType,  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->posts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
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
            'post' => $post, // 当前的一个通知
            'toLogoutURL' => "/logout"      // 退出登录
        ]);
    }

    public function create()
    {
        return '发布通知';
    }
}
