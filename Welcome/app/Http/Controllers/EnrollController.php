<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../include.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Jxlwqq\IdValidator\IdValidator;

class EnrollController extends Controller
{
    private $idValidator;

    public function __construct() {
        // 身份证获取
        $this->idValidator = new IdValidator();
    }

    public function enrollInfo()
    {
        return view('stu.new.enrollInfo', [
            'sysType' => "新生",  // 系统运行模式，新生，在校生，管理员
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
