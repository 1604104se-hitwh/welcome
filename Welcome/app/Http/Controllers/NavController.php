<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../include.php';

use App\Models\Post;
use App\Models\StudentsHelp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Jxlwqq\IdValidator\IdValidator;

class NavController extends Controller
{
    private $idValidator;
    private $showMessages;
    private $unReadPosts;

    public function __construct() {
        // 身份证获取
        $this->idValidator = new IdValidator();

        $this->middleware(function ($request, $next) { // 加入中间件，获取session
            $showPosts = Post::orderBy('post_timestamp', 'desc')->limit(5)->get();
            $this->unReadPosts = Post::whereNotIn('id', function ($query) {
                $query->select("post_id")->from("t_post_read")->where("stu_id", session("id"));
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

    public function index()
    {
        if (session("Auth") === "new") {
            $sysType = "新生";
        } else if (session("Auth") === "old") {
            $sysType = "在校生";
        } else if (session("Auth") === "admin") {
            $sysType = "管理员";
        }
        return view('stu.new.nav', [
            'sysType' => $sysType,  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->unReadPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
                'moreInfoUrl' => "/stu/posts", // 更多信息跳转

            ), // 信息
            'user' => session('stu_name'), // 用户名
            'stuID' => session('stu_num'), // 学号
            'stuReportTime' => "9月1日", // 报到时间
            'appointments' => array(),
            'userImg' => "/avatar", // 用户头像链接 url(site)
            'toInfomationURL' => "toInfomationURL", // 个人设置url

            'stationInfos' => array(), // 到站信息
            'toLogoutURL' => "/logout",      // 退出登录
        ]);
    }
}
