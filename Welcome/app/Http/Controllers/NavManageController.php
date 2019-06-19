<?php

namespace App\Http\Controllers;
date_default_timezone_set('PRC');

use App\Exports\portBookExport;
use App\Models\EnrollCfg;
use App\Models\ShtlPort;
use App\Models\ShtlRecord;
use App\Models\Shuttle;
use App\Models\Students;
use Barryvdh\Debugbar\Facade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

// 到站信息管理控制器
class NavManageController extends Controller
{
    //到站信息-展示
    public function index(Request $request){

        $res = Students::where([
            ["stu_status", "PREPARE"]
        ])->count();
        $reserveStuNumber = ShtlRecord::count();
        // 报到配置
        $enrollcfg = EnrollCfg::first(['enrl_begin_time']);
        $port = ShtlPort::leftJoin('t_shuttle','t_shuttle.port_id','t_shtl_port.id')
        ->get([
            't_shtl_port.id as id','t_shtl_port.port_name as portName',
            DB::raw("IFNULL(JSON_LENGTH(`shtl_time`),0) as setReserveTime"),
            'shtl_time'
        ]);

        /*
        DB::raw("SELECT
        JSON_UNQUOTE(JSON_EXTRACT(
            @json,
        concat( '$[', @i, ']' ))) as `shtl_time`,
        @i := @i + 1 as `id` ,@info as port_id
        FROM
        information_schema.COLUMNS a,
        ( SELECT @i := 0, @json := ( SELECT t_shuttle.shtl_time FROM t_shuttle ), @max_id := JSON_LENGTH( @json ), @info := (SELECT port_id FROM t_shuttle) ) json 
        WHERE
        @i < @max_id;");
        */
        foreach ($port as $item) {
            $times = json_decode($item->shtl_time);
            $item->time = array();
            $item->stuNumber = array();
            if(is_array($times)) {
                $tmptime = array();
                $tmpstuNumber = array();
                foreach ($times as $time) {

                    array_push($tmptime, date("m月d日 H:i",$time));
                    $getNumber = ShtlRecord::where(
                        'shtl_id', $item->id
                    )->whereRaw('UNIX_TIMESTAMP(record_time) = '.(int)$time)->count();
                    array_push($tmpstuNumber, $getNumber);
                }
                $item->time = $tmptime;
                $item->stuNumber = $tmpstuNumber;
            }
        }
        return view("admin.navManage", [
            'sysType'                   => "管理员",                        // 系统运行模式，新生，在校生，管理员
            'user'                      => session("name"),                 // 用户名
            'userImg'                   => "/avatar",                       // 用户头像链接 url(site)
            'toInformationURL'          => "/admin/personalInfo",           // 个人设置url
            'newStuNumber'              => $res,                            // 新生人数
            'reserveStuNumber'          => $reserveStuNumber,               // 预约新生人数
            'stuReportTime'             => $enrollcfg->enrl_begin_time,     // 报到时间
            'getNavInfoURL'             => "/admin/getPortInfo",            // 获取站点信息URL
            'saveInfoURL'               => "/admin/savePortInfo",           // 保存站点信息URL
            'deletePortInfoURL'         => '/admin/deletePort',             // 删除信息URL
            'portInfoLists'             => $port,                           // 列表
            'saveEnrollConfig'          => '/admin/saveEnrollConfig',       // 配置保存
            'portNumber'                => $port->count(),                  // 站点个数
            'reservationLists'          => $port,                           // 站点预约信息

            'toLogoutURL'               => "/logout",                       // 退出登录
        ]);
    }

    // 获取数据
    public function getPortInfo(Request $request){
        if($request->has('target')){
            $data = ShtlPort::where('t_shtl_port.id',$request->post('target'))
                ->leftJoin('t_shuttle','t_shuttle.port_id','t_shtl_port.id')
                ->first([
                    'port_name','port_info','shtl_time'
                ]);
            Facade::info($data);
            if($data){
                $array = array(
                    "code"  => 200,
                    "msg"   => "Get data successfully!",
                    "data"  => $data
                );
            }else{
                $array = array(
                    "code"  => 404,
                    "msg"   => "Cannot get the data!",
                    "data"  => "无法获取到数据！"
                );
            }
        }else{
            $array = array(
                "code"  => 500,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    // 修改和增加站点信息
    public function savePortInfo(Request $request){
        if($request->has(['title','info'])){
            if($request->post('type')==='modify' &&
                $request->has('target')){
                $get = ShtlPort::find($request->post('target'));
                $get->port_name = $request->post('title');
                $get->port_info = $request->post('info');
                $get->save();
                $getShuttle = Shuttle::FirstOrNew(['port_id'=>$get->id]);
                $getShuttle->shtl_time = $request->has('timestamps')?
                    json_encode($request->post('timestamps')):null;
                $getShuttle->save();
                $array = array(
                    "code"  => 200,
                    "msg"   => "Save successfully!",
                    "data"  => "成功保存！"
                );
            }else if($request->post('type')==='create'){
                $get = ShtlPort::create([
                    'port_name' => $request->post('title'),
                    'port_info' => $request->post('info'),
                ]);
                $getShuttle = Shuttle::FirstOrNew(['port_id'=>$get->id]);
                $getShuttle->shtl_time = $request->has('timestamps')?
                    json_encode($request->post('timestamps')):null;
                $getShuttle->save();
                $array = array(
                    "code"  => 200,
                    "msg"   => "Save successfully!",
                    "data"  => "成功保存！"
                );
            }else{
                $array = array(
                    "code"  => 500,
                    "msg"   => "Missing parameters!",
                    "data"  => "缺失参数！"
                );
            }
        }else{
            $array = array(
                "code"  => 500,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    // 删除站点
    public function deletePort(Request $request){
        if($request->has('deleteID')){
            $get = ShtlPort::find($request->post('deleteID'));
            if($get){
                $get->delete();
                // 丢掉预约的时间
                Shuttle::where('port_id',$request->post('deleteID'))->delete();
                ShtlRecord::where('shtl_id',$request->post('deleteID'))->delete();
                $array = array(
                    "code"  => 200,
                    "msg"   => "Delete successfully!",
                    "data"  => "成功删除！"
                );
            }else{
                $array = array(
                    "code"  => 404,
                    "msg"   => "Cannot find the port ID!",
                    "data"  => "无法找到需要删除的！"
                );
            }
        }else{
            $array = array(
                "code"  => 500,
                "msg"   => "Missing parameters!",
                "data"  => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    public function exportExcel(Request $request){
        return Excel::download(new portBookExport, 'export.xlsx');
    }

}
