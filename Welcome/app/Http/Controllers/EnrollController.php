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
        $test = new \stdClass();
//        $test->enrl_title =
        return view('stu.new.enrollInfo', [
            'sysType' => "新生",  // 系统运行模式，新生，老生，管理员
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
            'enrollInfos' => array(),
            'enrl_location' => array(),
        ]);
    }

    public function enrollGuide()
    {
        return view('stu.new.enrollInfo', [
            'sysType' => "新生",  // 系统运行模式，新生，老生，管理员
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
            'enrollInfos' => array()
        ]);

    }
}
