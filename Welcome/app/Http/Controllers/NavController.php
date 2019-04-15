<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../include.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Jxlwqq\IdValidator\IdValidator;

use App\Models\ShtlPort;
use App\Models\ShtlRecord;
use App\Models\Shuttle;

class NavController extends Controller
{
    private $idValidator;

    public function __construct() {
        // 身份证获取
        $this->idValidator = new IdValidator();
    }

    public function index()
    {
        $appointments = ShtlRecord::where(
            [
                ['stu_id', session('id')]
            ]
        )->get();
        if (session("Auth") === "new") {
            $sysType = "新生";
        } else if (session("Auth") === "old") {
            $sysType = "在校生";
        } else if (session("Auth") === "admin") {
            $sysType = "管理员";
        }
        $ports = ShtlPort::all();
        $stationInfos = Shuttle::all();
        return view('stu.new.nav', [
            'sysType' => $sysType,  // 系统运行模式，新生，在校生，管理员
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
            'appointments' => $appointments,
            'userImg' => "userImg", // 用户头像链接 url(site)
            'toInfomationURL' => "toInfomationURL", // 个人设置url
            'toSettingURL' => "toSettingURL", // 个人设置
            'stationInfos' => $stationInfos, // 到站信息
            'toLogoutURL' => "/logout",      // 退出登录
            'toSchoolInfoURL' => "toSchoolInfoURL",
            'ports' => $ports,
        ]);
    }
    
    public function catcher(Request $req) 
    {
        var_dump($req);
        $array = array('req'=>'ok','status'=>'true');
        return json_encode($array);
    }
}
