<?php

    namespace App\Http\Controllers;

    use App\Models\Department;
    use App\Models\Major;
    use App\Models\Students;
    use App\Models\Admin;
    use App\Models\Permission;
    use App\Models\EnrollCfg;
    use App\Http\Controllers\Controller;
    use App\Models\SysInfo;
    use Barryvdh\Debugbar\Facade;
    use DebugBar\DebugBar;
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
            $enrollcfg = EnrollCfg::find(1);
            $enrollcfg->school_info = SysInfo::find(1,'school_info')->school_info;
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
                    $deptImport .= "，院系".Department::count()."个，".
                        "专业".Major::count()."个";
                }
            }
            return view('admin.index', [
                'sysType' => "管理员",  // 系统运行模式，新生，在校生，管理员
                'user' => session("name"), // 用户名
                'userImg' => "/avatar",// 用户头像链接 url(site)
                'toInformationURL' => "/admin/personalInfo", // 更多消息url

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
            $enrollcfg = EnrollCfg::find(1);
            $enrollcfg->school_info = SysInfo::find(1,'school_info')->school_info;
            $enrollTime = ($enrollcfg) ? $enrollcfg['enrl_begin_time'] : "暂无信息";
            // 专业信息
            $majorInfos = Major::orderBy('major_num', 'asc')->get();

            return view('admin.insertSchoolInfo', [
                'sysType' => "管理员",  // 系统运行模式，新生，在校生，管理员
                'user' => session("name"), // 用户名
                'userImg' => "/avatar",// 用户头像链接 url(site)
                'toInformationURL' => "/admin/personalInfo", // 个人设置url

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
            $enrollcfg = EnrollCfg::find(1);
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
                'userImg' => "/avatar",// 用户头像链接 url(site)
                'toInformationURL' => "/admin/personalInfo", // 个人设置url

                'newStuNumber' => $res, // 新生人数
                'oldStuNumber' => $current, // 在校生人数
                'hasReportNumber' => $enroll, // 已报到人数
                'stuReportTime' => $enrollTime, // 报到时间
                'majorInfos' => $deptInfos, // 专业新生情况
                'newsInfoPostURL' => "/admin/stuInfoUpload", // 新生信息提交URL

                'toLogoutURL' => "/logout",      // 退出登录
            ]);
        }

    }
