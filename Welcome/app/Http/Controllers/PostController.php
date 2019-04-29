<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostRead;

class PostController extends Controller {   
    private $sysType;
    private $showMessages;
    private $unReadPosts;

    public function __construct() {
        if (session("Auth") === "new") {
            $this->sysType = "新生";
        } else if (session("Auth") === "old") {
            $this->sysType = "在校生";
        } else if (session("Auth") === "admin") {
            $this->sysType = "管理员";
        }

        $this->showMessages = array();
        $this->middleware(function ($request, $next) { // 加入中间件，获取session
            /* 从所有通知中选择当前登录用户未读的信息 */
            $showPosts = Post::orderBy('post_timestamp', 'desc')->limit(5)->get();
            $this->unReadPosts = Post::whereNotIn('id', function ($query) {
                $query->select("post_id")->from("t_post_read")->where("stu_id", session("stu_num"));
            })->get();
            foreach ($showPosts as $post) {
                $this->showMessages[] = array(
                    "title" => $post->post_title,
                    "context" => mb_strlen($post->post_content, "UTF-8") > 12 ?
                        mb_substr($post->post_content, 0, 10, "UTF-8") . "..." : $post->post_content,
                    "toURL" => "/stu/posts/" . $post->id,
                    "readed" => $this->unReadPosts->where('id', $post->id)->isEmpty()
                );
            }
            return $next($request);
        });
    }

    public function index() {
        /* 通知分页显示，但此时是将所有通知一次都取出？ */
        $posts = Post::paginate(10);
        return view('stu.posts', [
            'sysType' => $this->sysType,  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->unReadPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
                'moreInfoUrl' => "/stu/posts", // 更多信息跳转
            ), // 信息
            'stuID' => session('stu_num'), // 学号
            'user' => session('stu_name'), // 用户名
            'userImg' => "userImg", // 用户头像链接 url(site)
            'toInformationURL' => "toInformationURL", // 个人信息url
            'toSettingURL' => "toSettingURL", // 个人设置
            'posts' => $posts, // 所有通知，已读和未读的都包括
            'toLogoutURL' => "/logout"      // 退出登录
        ]);
    }

    public function show($id) {
        $post = Post::where([
            ['id',$id],
        ])->first();
        if(!$post || count($post) == 0){
            abort("404","找不到相应的内容");
        }
        // 确定已读
        PostRead::firstOrCreate(
           ['post_id'=>$id], ['stu_id'=>session('stu_num', 'null')]
        );
        return view('stu.show', [
            'sysType' => $this->sysType,  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->unReadPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
                'moreInfoUrl' => "/stu/posts", // 更多信息跳转
            ), // 信息
            'stuID' => session('stu_num'), // 学号
            'user' => session('stu_name'), // 用户名
            'userImg' => "userImg", // 用户头像链接 url(site)
            'toInformationURL' => "toInformationURL", // 个人信息url
            'toSettingURL' => "toSettingURL", // 个人设置
            'post' => $post, // 当前的一个通知
            'toLogoutURL' => "/logout"      // 退出登录
        ]);
    }

    public function create() {
        /** 
         * 该方法只针对管理员 
         * 未读消息功能对管理员不设置 
         */
        $posts = Post::all();
        return view("admin.createPost", [
            "sysType" => "管理员",
            "user" => session("name", "管理员"),
            "userImg" => "userImg",
            "toInformationURL" => "toInformationURL", // 个人信息url
            "toSettingURL" => "toSettingURL", // 个人设置
            "posts" => $posts,
            "storePostURL" => "/admin/storePost",
            "deletePostURL" => "/admin/deletePost",
            "modifyPostURL" => "/admin/editPost",
            "toLogoutURL" => "/logout"
        ]);
    }
}
