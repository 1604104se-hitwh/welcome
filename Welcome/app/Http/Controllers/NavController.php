<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../include.php';

use App\Models\EnrollCfg;
use App\Models\Post;
use App\Models\ShtlPort;
use App\Models\ShtlRecord;
use App\Models\Shuttle;
use Barryvdh\Debugbar\Facade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NavController extends Controller
{
    private $showMessages;
    private $unReadPosts;

    public function index()
    {
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

        $enrollCfg = EnrollCfg::find(1);
        $enrollTime = ($enrollCfg) ?
            $enrollCfg['enrl_begin_time'] : "暂无信息";

        // 站点信息
        $stationInfos = ShtlPort::all();
        // 预约信息
        $appointments = ShtlRecord::where('t_shtl_record.stu_id',session('id'))
            ->leftJoin('t_shtl_port','t_shtl_port.id','t_shtl_record.shtl_id')
            ->get([
                DB::raw("DATE_FORMAT(`record_time`,'%m月%d日 %H:%i') as time"),
                'port_name as station',
                't_shtl_record.id as id'
            ]);

        if (session("Auth") === "new") {
            $sysType = "新生";
        } else if (session("Auth") === "old") {
            $sysType = "在校生";
        } else if (session("Auth") === "admin") {
            $sysType = "管理员";
        }
        return view('stu.new.nav', [
            'sysType'           => $sysType,  // 系统运行模式，新生，在校生，管理员
            'messages'          => array(
                'unreadNum'     => $this->unReadPosts->count(), // 未读信息数量
                'showMessage'   => $this->showMessages,
                'moreInfoUrl'   => "/stu/posts", // 更多信息跳转

            ), // 信息
            'user'              => session('stu_name'), // 用户名
            'stuID'             => session('stu_num'), // 学号
            'stuReportTime'     => $enrollTime, // 报到时间
            'appointments'      => $appointments,
            'userImg'           => "/avatar", // 用户头像链接 url(site)
            'toInfomationURL'   => "/stu/personalInfo", // 个人设置url
            'getNavTime'        => "stu/getNavTime",    // 获取站点信息
            'submitBook'        => "stu/submitBook",    // 提交预约信息
            'deleteBook'        => "stu/deleteBook",    // 删除预约

            'stationInfos'      => $stationInfos,  // 到站信息
            'toLogoutURL'       => "/logout",      // 退出登录
        ]);
    }

    public function getNavTime(Request $request){
        if($request->has('target')){
            $data = Shuttle::where('port_id',$request->post('target'))
                ->first('shtl_time');
            if($data){
                $data = json_decode($data->shtl_time);
            }
            $array=array(
                "code"  => 200,
                "msg"   => "Get data successfully!",
                "data"  => $data,
            );
        }else{
            $array = array(
                "code"  => 401,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    public function submitBook(Request $request){
        if($request->has(['bookPort','bookTime'])){
            $bookPort = (int)$request->post('bookPort');
            $bookTime = (int)$request->post('bookTime');
            $stuid = session('id');
            $get = ShtlRecord::where('stu_id',$stuid)->count();
            if($get){
                $array=array(
                    "code"  => 403,
                    "msg"   => "You already has booked!",
                    "data"  => "一个人只能预约一个哦！",
                );
            }else{
                ShtlRecord::create([
                    'stu_id'        => $stuid,
                    'shtl_id'       => $bookPort,
                    'record_time'   => DB::raw('FROM_UNIXTIME('.$bookTime.')')
                ]);
                $array=array(
                    "code"  => 200,
                    "msg"   => "Get data successfully!",
                    "data"  => "成功保存！",
                );
            }
        }else{
            $array = array(
                "code"  => 401,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    public function deleteBook(Request $request){
        if($request->has('target')){
            $id = $request->post('target');
            $get = ShtlRecord::find($id);
            if($get){
                $get->delete();
                $array=array(
                    "code"  => 200,
                    "msg"   => "Delete data successfully!",
                    "data"  => "成功删除！",
                );
            }else{
                $array = array(
                    "code"  => 404,
                    "msg"   => "Cannot find this id record!",
                    "data"  => "找不到这条记录！"
                );
            }
        }else{
            $array = array(
                "code"  => 401,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }
}
