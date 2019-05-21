<?php

    namespace App\Http\Controllers;

    use App\Models\Department;
    use App\Models\Major;
    use App\Models\Students;
    use App\Models\Admin;
    use App\Models\Permission;
    use App\Models\EnrollCfg;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;


    class AdminController extends Controller
    {
        public function __construct()
        {
            // $this->middleware('checkAuth');
        }

        // 管理员-首页

        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function index()
        {
            $res = Students::where([
                ["stu_status", "PREPARE"]
            ])->count();
            $enroll = Students::where([
                ["stu_status", "ENROLL"]
            ])->count();
            $current = Students::where([
                ["stu_status", "CURRENT"]
            ])->count();
            // 报到配置信息
            $enrollcfg = EnrollCfg::all()->first();
            $enrollTime = ($enrollcfg) ? $enrollcfg['enrl_begin_time'] : "暂无信息";
            // 院系信息统计
            $deptInfos = Department::all();
            // 按照院系
            foreach ($deptInfos as $deptInfo){
                $girl = 0;$boy = 0;
                $enrolled = 0;
                // 得到每个专业
                foreach ($deptInfo->major as $major){
                    $majorGets = Students::where([
                        ['stu_degree','UG'],
                        ['stu_num','like','__'.$major->major_num.'%'],
                    ])->whereIn('stu_status',[
                        'PREPARE',
                        'ENROLL',
                    ])->get();
                    // 有这个专业的学生
                    if(count($majorGets)){ // 不为空才能继续
                        foreach ($majorGets as $majorGet){
                            if($majorGet->stu_status === 'ENROLL'){
                                ++$enrolled;
                            }
                            if($majorGet->stu_gen === 0){
                                ++$boy;
                            }else{
                                ++$girl;
                            }
                        }
                    }
                }
                // 计算男女比例
                if($girl != 0 && $boy != 0){
                    $deptInfo->genderRate = round($boy/$girl,2);
                }else{
                    if($girl === 0)
                        $deptInfo->genderRate = 'All Boys';
                    if($boy === 0)
                        $deptInfo->genderRate = 'All Girls';
                    if($boy === $girl && $boy === 0)
                        $deptInfo->genderRate = '没有学生';
                }

                $deptInfo->hasReportNumber = $enrolled;
                $deptInfo->stuNumber = $boy + $girl;

                /* 仪表盘信息 */
                $newImport = ($res + $enroll === 0)?"未导入":"已导入，人数为".($res + $enroll)."人";
                if(!Major::count() && !Department::count()){
                    $deptImport = "未导入";
                }else{
                    if( !Major::count() || !Department::count()){
                        $deptImport = "部分导入";
                    }else{
                        $deptImport = "已导入";
                    }
                    $deptImport .= "，院系".Major::count()."个，".
                        "专业".Department::count()."个";
                }
            }
            return view('admin.index', [
                'sysType' => "管理员",  // 系统运行模式，新生，在校生，管理员
                'user' => session("name"), // 用户名
                'userImg' => "userImg",// 用户头像链接 url(site)
                'toInformationURL' => "toInformationURL", // 更多消息url
                'toSettingURL' => "toSettingURL", // 个人设置
                'newStuNumber' => $res, // 新生人数
                'oldStuNumber' => $current, // 在校生人数
                'hasReportNumber' => $enroll, // 已报到人数
                'stuReportTime' => $enrollTime, // 报到时间
                'schoolInfo' => $enrollcfg->school_info, // 学校信息 可以html
                'toSetSchoolInfoURL' => "/admin/manageSchoolInfo", // 设置学校信息URL
                'schoolStatistics' => $deptInfos, // 院系状态
                'systemStatus' => array( // 系统状态
                    'newsStatus' => $newImport, // 新生状态
                    'deptStatus' => $deptImport, // 院系状态
                    'reportStatus' => $enrollcfg->enrl_permission?
                        "开始报道": "等待开始报到", // 报到状态
                ),

                'toLogoutURL' => "/logout",      // 退出登录
            ]);
        }

        // 管理员-学校信息录入
        public function manageSchoolInfo()
        {
            $res = Students::where([
                ["stu_status", "PREPARE"]
            ])->count();
            $enroll = Students::where([
                ["stu_status", "ENROLL"]
            ])->count();
            $current = Students::where([
                ["stu_status", "CURRENT"]
            ])->count();
            // 报到配置
            $enrollcfg = EnrollCfg::all()->first();
            $enrollTime = ($enrollcfg) ? $enrollcfg['enrl_begin_time'] : "暂无信息";
            // 专业信息
            $majorInfos = Major::orderBy('major_num', 'asc')->get();

            return view('admin.insertSchoolInfo', [
                'sysType' => "管理员",  // 系统运行模式，新生，在校生，管理员
                'user' => session("name"), // 用户名
                'userImg' => "userImg",// 用户头像链接 url(site)
                'toInformationURL' => "toInformationURL", // 个人设置url
                'toSettingURL' => "toSettingURL", // 个人设置
                'newStuNumber' => $res, // 新生人数
                'oldStuNumber' => $current, // 在校生人数
                'hasReportNumber' => $enroll, // 已报到人数
                'stuReportTime' => $enrollTime, // 报到时间
                'schoolInfo' => $enrollcfg->school_info, // 设置学校信息
                'majorInfos' => $majorInfos, // 专业信息
                'schoolInfoPostURL' => "/admin/schoolInfoPost", // 学校信息提交URL
                'majorInfoPostURL' => "/admin/majorInfoUpload", // 专业信息提交URL

                'toLogoutURL' => "/logout",      // 退出登录
            ]);
        }

        // 管理员-新生信息录入
        public function manageNewsInfo()
        {
            $res = Students::where([
                ["stu_status", "PREPARE"]
            ])->count();
            $enroll = Students::where([
                ["stu_status", "ENROLL"]
            ])->count();
            $current = Students::where([
                ["stu_status", "CURRENT"]
            ])->count();
            $enrollcfg = EnrollCfg::all()->first();
            $enrollTime = ($enrollcfg) ? $enrollcfg['enrl_begin_time'] : "暂无信息";
            /* 按照院系显示院系人数 */
            // 院系信息统计
            $deptInfos = Department::all();
            // 按照院系
            foreach ($deptInfos as $deptInfo) {
                $girl = 0;
                $boy = 0;
                // 得到每个专业
                foreach ($deptInfo->major as $major) {
                    $majorGets = Students::where([
                        ['stu_degree', 'UG'],
                        ['stu_num', 'like', '__' . $major->major_num . '%'],
                    ])->whereIn('stu_status', [
                        'PREPARE',
                        'ENROLL',
                    ])->get();
                    // 有这个专业的学生
                    if (count($majorGets)) { // 不为空才能继续
                        foreach ($majorGets as $majorGet) {
                            if ($majorGet->stu_gen === 0) {
                                ++$boy;
                            } else {
                                ++$girl;
                            }
                        }
                    }
                }
                $deptInfo->deptGirlsNumber = $girl;
                $deptInfo->deptBoysNumber = $boy;
                $deptInfo->deptNewsNumber = $girl + $boy;
            }
            return view('admin.newStudentManage', [
                'sysType' => "管理员",  // 系统运行模式，新生，在校生，管理员
                'user' => session("name"), // 用户名
                'userImg' => "userImg",// 用户头像链接 url(site)
                'toInformationURL' => "toInformationURL", // 个人设置url
                'toSettingURL' => "toSettingURL", // 个人设置
                'newStuNumber' => $res, // 新生人数
                'oldStuNumber' => $current, // 在校生人数
                'hasReportNumber' => $enroll, // 已报到人数
                'stuReportTime' => $enrollTime, // 报到时间
                'majorInfos' => $deptInfos, // 专业新生情况
                'newsInfoPostURL' => "/admin/stuInfoUpload", // 新生信息提交URL

                'toLogoutURL' => "/logout",      // 退出登录
            ]);
        }

        // 管理员-工作人员信息
        public function manageAdminInfo()
        {
            $adminList = Admin::paginate(10);
            $adminTotal = count($adminList);
            return view('admin.manageAdmin', [
                'sysType' => "管理员",
                'user' => session("name"),
                'userImg' => "userImg",
                'toInformationURL' => "toInformationURL",
                'toSettingURL' => "toSettingURL",
                'adminTotal' => $adminTotal,
                'adminList' => $adminList,
                'getAdminURL' => '/admin/getAdmin',
                'modifyAdminURL' => '/admin/modifyAdmin',
                'deleteAdminURL' => '/admin/deleteAdmin',
                'addAdminURL' => '/admin/addAdmin',
                'toLogoutURL' => "/logout",      // 退出登录
            ]);
        }

        // 工作人员信息-post响应函数
        public function addAdmin(Request $request) 
        {
            if (!$request->ajax()) {
                return back();
            }
            if(Admin::where('adm_name', $request->post("adm_name"))) {
                $array=array(
                    "code" => 500,
                    "msg" => "username collision!",
                    "data" => "用户名已存在！",
                    "exception" => "用户名已存在！"
                );
                return response()->jsonp($request->input('callback'),$array);
            }
            try{
                //DB::beginTransaction();
                $admin = new Admin();
                $admin->adm_name = $request->post("adm_name", "worker");
                $admin->adm_password = $request->post("adm_password", "1234");
                $admin->save();
                //DB::commit();
                $array=array(
                    "code" => 200,
                    "msg" => "Saved!"
                );
                return response()->jsonp($request->input('callback'),$array);
            }catch (\Exception $e){
                //DB::rollBack();
                $array=array(
                    "code" => 500,
                    "msg" => "The programing process error! Please call administrator for help!",
                    "data" => "程序内部错误，请告知管理员处理！",
                    "exception" => $e->getMessage()
                );
                return response()->jsonp($request->input('callback'),$array);
            }
        }


        public function deleteAdmin(Request $request)
        {
            if ($request->has('deleteID')) {
                $deleteAdminId = $request->post('deleteID');
                Admin::destroy($deleteAdminId);
                $array = array(
                    "code" => 200,
                    "msg" => "Delete successfully!",
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

        public function getAdmin(Request $request)
        {
            if ($request->has('requestID')) {
                $id = $request->post('requestID');
                //$get = Admin::find($id);
                if (1) {
                    $array = array(
                        "code" => 200,
                        "msg" => "Data get successfully!",
                        "data" => array(
                            "name" => '$get->adm_name'
                        )
                    );
                } else {
                    $array = array(
                        "code" => 404,
                        "msg" => "Cannot get the data!",
                        "data" => "不存在这个数据"
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

        public function modifyAdmin(Request $request)
        {
            if ($request->has(['modifyID', 'title', 'context', 'readAgain'])) {
                $id = $request->post('modifyID');
                $get = Post::find($id);
                if ($get) {
                    $get->post_title = $request->post('title');
                    $get->post_content = $request->post('context');
                    $get->post_timestamp = Carbon::now();
                    $get->save();
                    // 是否需要再次提醒阅读
                    if ($request->post('readAgain')) {
                        PostRead::where('post_id', $id)->delete();
                    }
                    $array = array(
                        "code" => 200,
                        "msg" => "Data saved successfully!",
                        "data" => "成功保存"
                    );
                } else {
                    $array = array(
                        "code" => 404,
                        "msg" => "Cannot get the data!",
                        "data" => "不存在这个数据"
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
    }
