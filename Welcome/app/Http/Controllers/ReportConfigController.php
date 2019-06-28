<?php

    namespace App\Http\Controllers;

    use App\Models\Enroll;
    use App\Models\EnrollCfg;
    use App\Models\Students;
    use Barryvdh\Debugbar\Facade;
    use DebugBar\DebugBar;
    use Illuminate\Http\Request;

// 管理员修改报到流程信息控制器
    class ReportConfigController extends Controller
    {
        // 修改显示控制块
        public function index(Request $request)
        {
            $res = Students::where([
                ["stu_status", "PREPARE"]
            ])->count();
            $current = Students::where([
                ["stu_status", "CURRENT"]
            ])->count();
            // 报到配置
            $enrollcfg = EnrollCfg::first(['enrl_begin_time', 'enrl_info', 'enrl_permission']);
            $reportInfoLists = Enroll::orderBy('enrl_rank', 'asc')->get(['id', 'enrl_title', 'enrl_rank']);
            return view("admin.reportConfig", [
                'sysType'                   => "管理员",                        // 系统运行模式，新生，在校生，管理员
                'user'                      => session("name"),            // 用户名
                'userImg'                   => "/avatar",                       // 用户头像链接 url(site)
                'toInformationURL'          => "/admin/personalInfo",              // 个人设置url
                'newStuNumber'              => $res,                            // 新生人数
                'oldStuNumber'              => $current,                        // 在校生人数
                'stuReportTime'             => $enrollcfg->enrl_begin_time,     // 报到时间
                'reportInfo'                => $enrollcfg->enrl_info,           // 设置学校信息
                'reportInfoPostURL'         => "/admin/storeReportInfo",        // 流程信息提交URL
                'getReportInfoURL'          => "/admin/getReportInfo",          // 获取流程信息URL
                'saveInfoURL'               => "/admin/saveReportInfo",         // 保存流程信息URL
                'deleteReportInfoURL'       => '/admin/deleteReportInfo',       // 删除信息URL
                'reportInfoLists'           => $reportInfoLists,                // 列表
                'reportData'                => $enrollcfg->enrl_begin_time,     // 报到日期
                'check'                     => $enrollcfg->enrl_permission,     // 是否开始报到
                'saveEnrollConfig'          => '/admin/saveEnrollConfig',       // 配置保存

                'toLogoutURL'               => "/logout",                       // 退出登录
            ]);
        }

        // 提交报到通知控制块
        public function postReportInfo(Request $request)
        {
            if ($request->has('reportInfo')) {
                $get = EnrollCfg::first();
                $get->enrl_info = $request->post('reportInfo');
                $get->save();
                $array = array(
                    "code" => 200,
                    "msg" => "Saved!"
                );
            } else {
                $array = array(
                    "code" => 500,
                    "msg" => "Missing parameters!",
                    "data" => "缺失参数！"
                );
            }
            return response()->jsonp($request->input('callback'), $array);
        }

        // 获取报到流程详细信息
        public function getReportInfo(Request $request)
        {
            if ($request->has('target')) {
                $get = Enroll::find($request->post('target'));
                $array = array(
                    "code" => 200,
                    "msg" => "Get data successful!",
                    "data" => $get
                );
            } else {
                $array = array(
                    "code" => 500,
                    "msg" => "Missing parameters!",
                    "data" => "缺失参数！"
                );
            }
            return response()->jsonp($request->input('callback'), $array);
        }

        // 保存信息
        public function saveReportInfo(Request $request)
        {
            if ($request->has(['type', 'title', 'info', 'location'])) {
                if ($request->post('type') == "modify" && $request->has('target')) { // 修改模式
                    if ($modify = Enroll::find($request->post('target'))) {
                        $modify->enrl_title = $request->post('title');
                        $modify->enrl_info = $request->post('info');
                        $modify->enrl_location = $request->post('location');
                        $modify->save();
                        $array = array(
                            "code" => 200,
                            "msg" => "Save successfully!",
                            "data" => "成功保存！"
                        );
                    } else {
                        $array = array(
                            "code" => 404,
                            "msg" => "Can't find the user!",
                            "data" => "找不到这个用户！"
                        );
                    }
                } else if ($request->post('type') == "create") { // 添加模式
                    $rank = Enroll::max('enrl_rank');
                    Enroll::create([
                        'enrl_title' => $request->post('title'),
                        'enrl_info' => $request->post('info'),
                        'enrl_location' => $request->post('location'),
                        'enrl_rank' => $rank + 1
                    ]);
                    $array = array(
                        "code" => 200,
                        "msg" => "Save successfully!",
                        "data" => "成功保存！"
                    );
                } else {
                    $array = array(
                        "code" => 501,
                        "msg" => "Error parameters!",
                        "data" => "参数错误！"
                    );
                }
            } else {
                $array = array(
                    "code" => 500,
                    "msg" => "Missing parameters!",
                    "data" => "缺失参数！"
                );
            }
            return response()->jsonp($request->input('callback'), $array);
        }

        // 删除信息
        public function deleteReportInfo(Request $request)
        {
            if ($request->has('deleteID')) {
                Enroll::destroy($request->post('deleteID'));
                // 需要重新排序
                $get = Enroll::orderBy('id','asc')->get();
                $enrl_rank = 0;
                foreach($get as $p){
                    $enrl_rank++;
                    if($p->enrl_rank === $enrl_rank) continue;
                    $p->enrl_rank = $enrl_rank;
                    $p->save();
                }
                $array = array(
                    "code" => 200,
                    "msg" => "Get data successful!",
                    "data" => "成功删除！"
                );
            } else {
                $array = array(
                    "code" => 500,
                    "msg" => "Missing parameters!",
                    "data" => "缺失参数！"
                );
            }
            return response()->jsonp($request->input('callback'), $array);
        }

        // 保存报到配置
        public function saveEnrollConfig(Request $request)
        {
            if ($request->has(['reportDate', 'beginReport'])) {
                $get = EnrollCfg::findOrNew('1');
                $get->enrl_begin_time = $request->post('reportDate');
                $get->enrl_permission = $request->post('beginReport') === "true" ? 1 : 0;
                $get->save();
                Facade::info(EnrollCfg::first('enrl_permission'));
                $array = array(
                    "code" => 200,
                    "msg" => "Get data successful!",
                    "data" => "成功删除！"
                );
            } else {
                $array = array(
                    "code" => 500,
                    "msg" => "Missing parameters!",
                    "data" => "缺失参数！"
                );
            }
            return response()->jsonp($request->input('callback'), $array);
        }
    }
