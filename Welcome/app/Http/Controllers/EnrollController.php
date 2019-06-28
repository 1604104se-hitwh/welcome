<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../include.php';

use App\Models\Enroll;
use App\Models\EnrollCfg;
use App\Models\Post;

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

    public function enrollInfo()
    {
        $enrollCft = EnrollCfg::first(['enrl_info','enrl_begin_time']);
        $enrollParagraph = $enrollCft->enrl_info;
        if(empty($enrollParagraph)) $enrollParagraph = "<p>暂时未有消息</p>";
        return view('stu.new.enrollInfo', [
            'sysType' => "新生",  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->unReadPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
                'moreInfoUrl' => "/stu/posts", // 更多信息跳转

            ), // 信息
            'user' => session('stu_name'), // 用户名
            'stuID' => session('stu_num'), // 学号
            'stuReportTime' => $enrollCft->enrl_begin_time, // 报到时间
            'userImg' => "/avatar", // 用户头像链接 url(site)
            'toInfomationURL' => "toInfomationURL", // 个人设置url
            'toLogoutURL' => "/logout",      // 退出登录
            'enrollParagraph' => $enrollParagraph,   //给出介绍性的一大段文章
        ]);
    }

    public function enrollGuide()
    {
        $enrollTime = EnrollCfg::first('enrl_begin_time')->enrl_begin_time;
        $reportInfoLists = Enroll::orderBy('enrl_rank','asc')->get([
            'id','enrl_title','enrl_info','enrl_location'
        ]);
        return view('stu.new.enrollGuide', [
            'sysType' => "新生",  // 系统运行模式，新生，在校生，管理员
            'messages' => array(
                'unreadNum' => $this->unReadPosts->count(), // 未读信息数量
                'showMessage' => $this->showMessages,
                'moreInfoUrl' => "/stu/posts", // 更多信息跳转

            ), // 信息
            'user' => session('stu_name'), // 用户名
            'stuID' => session('stu_num'), // 学号
            'stuReportTime' => $enrollTime, // 报到时间
            'userImg' => "/avatar", // 用户头像链接 url(site)
            'toInfomationURL' => "toInfomationURL", // 个人设置url
            'reportInfoLists' => $reportInfoLists,

            'toLogoutURL' => "/logout",      // 退出登录
        ]);
    }
}
