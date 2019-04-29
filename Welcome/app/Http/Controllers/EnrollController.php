<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../include.php';

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Jxlwqq\IdValidator\IdValidator;

class EnrollController extends Controller
{
    private $idValidator;
    private $showMessages;
    private $unReadPosts;

    public function __construct() {
        // 身份证获取
        $this->idValidator = new IdValidator();
        $this->showMessages = array();

        /* 从所有通知中选择当前登录用户未读的信息 */
        $this->middleware(function ($request, $next) {
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

    public function enrollInfo()
    {
        return view('stu.new.enrollInfo', [
            'sysType' => "新生",  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->unReadPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
                'moreInfoUrl' => "/stu/posts", // 更多信息跳转

            ), // 信息
            'user' => session('stu_name'), // 用户名
            'stuID' => session('stu_num'), // 学号
            'stuReportTime' => "9月1日", // 报到时间
            'userImg' => "userImg", // 用户头像链接 url(site)
            'toInfomationURL' => "toInfomationURL", // 个人设置url
            'toSettingURL' => "toSettingURL", // 个人设置
            'toLogoutURL' => "/logout",      // 退出登录
            'toSchoolInfoURL' => "toSchoolInfoURL",
            'enrollParagraph' => "<p style='color: red;'>hello</p>",   //给出介绍性的一大段文章
        ]);
    }

    public function enrollGuide()
    {
        $test = new \stdClass();
        $test->id = 1;
        $test->enrl_title = "test";
        $test->enrl_info = "test";
        $test->PX = array(122.111, 122.222);

        $test1 = new \stdClass();
        $test1->id = 2;
        $test1->enrl_title = "test";
        $test1->enrl_info = "test";
        $test1->PX = array(122.111, 122.222);

        return view('stu.new.enrollGuide', [
            'sysType' => "新生",  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->unReadPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
                'moreInfoUrl' => "/stu/posts", // 更多信息跳转

            ), // 信息
            'user' => session('stu_name'), // 用户名
            'stuID' => session('stu_num'), // 学号
            'stuReportTime' => "9月1日", // 报到时间
            'userImg' => "userImg", // 用户头像链接 url(site)
            'toInfomationURL' => "toInfomationURL", // 个人设置url
            'toSettingURL' => "toSettingURL", // 个人设置
            'toLogoutURL' => "/logout",      // 退出登录
            'toSchoolInfoURL' => "toSchoolInfoURL",
            'enrollInfos' => array($test, $test1),   //给出报到的多个小段信息，每个Info包括id title info location
        ]);
    }
}
