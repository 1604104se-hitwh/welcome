<?php

    namespace App\Http\Controllers;

    require_once __DIR__ . '/../../include.php';

    use App\Models\Dormitory;
    use App\Models\EnrollCfg;
    use App\Models\Major;
    use App\Models\Students as Student;
    use App\Models\Post;

    use App\Models\SysInfo;
    use Jxlwqq\IdValidator\IdValidator;

    /* 新生控制器 */
    class StuController extends Controller
    {
        private $idValidator;
        private $showMessages;  // 全局message的信息
        private $unReadPosts;

        public function __construct() {
            // 身份证获取
            $this->idValidator = new IdValidator();
            $this->middleware(function ($request, $next) { // 加入中间件，获取session
                /**
                 * 右上方显示的是全部信息前5条；
                 * 小红点的数据是未读通知的条数；
                 * 通知数据库中消息要按时间排序，新的通知在最上方
                 */
                $this->showMessages = array();
                $showPosts = Post::orderBy('post_timestamp','desc')->limit(5)->get();
                $this->unReadPosts = Post::whereNotIn('id',function($query){
                    $query->select("post_id")->from("t_post_read")->where("stu_id", session('id'));
                })->get();
                foreach ($showPosts as $post) {
                    $this->showMessages[] = array(
                        "title"     => $post->post_title,
                        "context"   => mb_strlen($post->post_content,"UTF-8") > 12 ?
                            mb_substr($post->post_content,0,10,"UTF-8")."...":$post->post_content ,
                        "toURL"     => "/stu/posts/".$post->id,
                        "readed"    => $this->unReadPosts->where('id',$post->id)->isEmpty()
                    );
                }
                return $next($request);
            });
        }

        /**
         * 首页 控制器
         */
        public function index()
        {
            $stu_class_str = substr(session('stu_num'), 0, 7);  //学号digit0~digit6
            /* 获得同班同学信息 */
            $classmates_array = Student::where('stu_num',
                'like', $stu_class_str . '%')
                ->orderBy('stu_num', 'asc')
                ->get();
            /* 图表性别比例 */
            $class_male_num = 0;
            $class_female_num = 0;
            foreach ($classmates_array as $classmate) {
                if ($classmate->stu_gen) $class_female_num++;
                else $class_male_num++;
            }
            /* 老乡信息 */
            //地区分布，需要做桶排序
            $classmates_addr_prov_cnt = array();
            foreach ($classmates_array as $classmate) {
                $classmate_addr_info = $this->idValidator->getInfo($classmate->stu_cid);
                // 错误的不要
                if ($classmate_addr_info == false) continue;
                $classmate->address = $classmate_addr_info['address'];
                if (array_key_exists($classmate_addr_info['addressTree'][0], $classmates_addr_prov_cnt)) {
                    $classmates_addr_prov_cnt[$classmate_addr_info['addressTree'][0]] += 1;
                } else {
                    $classmates_addr_prov_cnt[$classmate_addr_info['addressTree'][0]] = 1;
                }
            }
            /* 老乡图表 */
            //按照值降序排序
            arsort($classmates_addr_prov_cnt);
            //取前五个
            $classmates_addr_prov_cnt = array_slice($classmates_addr_prov_cnt, 0, 4);
            // 选取前四位
            $top4_num = 0;
            $vals = array_values($classmates_addr_prov_cnt);
            for ($i = 0; $i < count($classmates_addr_prov_cnt); ++$i) {
                $top4_num += $vals[$i];
            }
            if (0 != $restNumber = $class_male_num + $class_female_num - $top4_num)
                $classmates_addr_prov_cnt['其他'] = $restNumber;
            /* 报到配置信息 */
            $enrollcfg = EnrollCfg::find(1);
            $enrollcfg->school_info = SysInfo::find(1,'school_info')->school_info;
            $enrollTime = ($enrollcfg) ? $enrollcfg['enrl_begin_time'] : "暂无信息";
            /*室友统计 */
            // 切割宿舍信息
            $dorm_str = substr(session('stu_dorm_str'),
                0, str_n_pos(session('stu_dorm_str'), '-', 2));
            $roommates_array = Student::where([
                ['stu_dorm_str', 'like', $dorm_str . '%'],
                ['stu_cid', '<>', session('stu_cid')]
            ])->orderBy('stu_dorm_str', 'asc')
                ->get();
            // 取到地址信息
            foreach ($roommates_array as $roommate) {
                $roommate->address = $this->idValidator
                    ->getInfo($roommate->stu_cid)['address'];
            }
            /*老乡统计 */
            $stu_prov_city_str = substr(session('stu_cid'), 0, 5);
            $country_folk_array = Student::where([
                ['stu_cid', 'like', $stu_prov_city_str . '%'],
                ['stu_cid', '<>', session('stu_cid')]
            ])->orderBy('stu_cid', 'asc')
                ->get();
            /* 获取院系 */
            if(session()->exists('stu_num')){
                $majorNum = substr(session('stu_num'),2,3);
                $majorRes = Major::where([
                    ['major_num',$majorNum],
                ])->first();
                if($majorRes){
                    $major = $majorRes->dept->dept_name;
                }else{
                    $major = "暂无院系信息";
                }
            }else{
                $major = "暂无信息";
            }

            return view('stu.new.index', [
                'sysType'                   => "新生",                          // 系统运行模式，新生，在校生，管理员
                'messages'                  => array(
                    'unreadNum'             => $this->unReadPosts->count(),     // 未读信息数量
                    'showMessage'           => $this->showMessages,
                    'moreInfoUrl'           => "/stu/posts",                    // 更多信息跳转
                ), // 信息
                'stuID'                     => session('stu_num'),          // 学号
                'user'                      => session('stu_name'),         // 用户名
                'userImg'                   => "/avatar",                       // 用户头像链接 url(site)
                'toInformationURL'          => "/stu/personalInfo",             // 个人信息url

                'stuDept'                   => $major,
                'stuDormitory'              => session('stu_dorm_str'),
                'stuReportTime'             => $enrollTime,                     // 报到时间
                'schoolInfo'                => $enrollcfg->school_info,         // 学校信息 可以html
                'toAllStuURL'               => "/stu/queryClass",               // 所有同学信息url
                'dormStus'                  => $roommates_array,                // 室友

                'toDormInfoURL'             => "/stu/queryDorm",
                'localFolks'                => $country_folk_array,             // 老乡
                'toLocalFolkURL'            => "/stu/queryCountryFolk",         // 查看老乡信息url
                'toLogoutURL'               => "/logout",                       // 退出登录
                //饼图
                'yourStuChartBoyGirl'       => array($class_male_num, $class_female_num),       // 男女比例，先男后女
                'yourStuChartProName'       => array_keys($classmates_addr_prov_cnt),           // 省份名字
                'yourStuChartProData'       => array_values($classmates_addr_prov_cnt),         // 每个信息
            ]);

        }

        /**
         * 同班同学 控制器
         */
        public function queryClass()
        {
            $stu_class_str = substr(session('stu_num'),
                0, 7);  //学号digit0~digit6
            /* 获得同班同学信息 */
            $classmates_array = Student::where('stu_num',
                'like', $stu_class_str . '%')
                ->orderBy('stu_num', 'asc')
                ->get();
            foreach ($classmates_array as $classmate) {
                $classmate->address = $this->idValidator
                    ->getInfo($classmate->stu_cid)['address'];
            }
            /* 报到配置信息 */
            $enrollcfg = EnrollCfg::find(1);
            $enrollTime = ($enrollcfg) ?
                $enrollcfg['enrl_begin_time'] : "暂无信息";
            /* 获取院系 */
            if(session()->exists('stu_num')){
                $majorNum = substr(session('stu_num'),2,3);
                $majorRes = Major::where([
                    ['major_num',$majorNum],
                ])->first();
                if($majorRes){
                    $major = $majorRes->dept->dept_name;
                }else{
                    $major = "暂无院系信息";
                }
            }else{
                $major = "暂无信息";
            }

            return view('stu.new.yourClass', [
                'sysType'                       => "新生",                        // 系统运行模式，新生，在校生，管理员
                'messages'                      => array(
                    'unreadNum'                 => $this->unReadPosts->count(), // 未读信息
                    'showMessage'               => $this->showMessages,
                    'moreInfoUrl'               => "/stu/post",                 // 更多信息跳转
                ), // 信息
                'stuID'                         => session('stu_num'),      // 学号
                'user'                          => session('stu_name'),     // 用户名
                'userImg'                       => "/avatar",                   // 用户头像链接 url(site)
                'toInformationURL'              => "/stu/personalInfo",         // 个人信息url

                'stuDept'                       => $major,
                'stuDormitory'                  => session('stu_dorm_str'),
                'stuReportTime'                 => $enrollTime,
                'classmates'                    => $classmates_array,           // 你的同学
                'toLogoutURL'                   => "/logout",                   // 退出登录
            ]);

        }

        /**
         * 室友信息 控制器
         */
        public function queryDorm()
        {
            // 切割宿舍信息
            $dorm_str = substr(session('stu_dorm_str'),
                0, str_n_pos(session('stu_dorm_str'), '-', 2));
            /* 获取室友 */
            $roommates_array = Student::where([
                ['stu_dorm_str', 'like', $dorm_str . '%'],
                ['stu_cid', '<>', session('stu_cid')]
            ])->orderBy('stu_dorm_str', 'asc')
                ->get();
            // 室友来自
            foreach ($roommates_array as $roommate) {
                $roommate->address = $this->idValidator
                    ->getInfo($roommate->stu_cid)['address'];
            }
            /* 公寓信息 */
            $dorm_building_str = substr(session('stu_dorm_str'),
                0, str_n_pos(session('stu_dorm_str'), '-', 1));
            $dorm_res = Dormitory::where([
                    ['dorm_tag',$dorm_building_str],
            ])->first();

            /* 报到配置信息 */
            $enrollcfg = EnrollCfg::find(1);
            $enrollTime = ($enrollcfg) ?
                $enrollcfg['enrl_begin_time'] : "暂无信息";
            /* 获取院系 */
            if(session()->exists('stu_num')){
                $majorNum = substr(session('stu_num'),2,3);
                $majorRes = Major::where([
                    ['major_num',$majorNum],
                ])->first();
                if($majorRes){
                    $major = $majorRes->dept->dept_name;
                }else{
                    $major = "暂无院系信息";
                }
            }else{
                $major = "暂无信息";
            }


            return view('stu.new.yourDom', [
                'sysType'                       => "新生",                        // 系统运行模式，新生，在校生，管理员
                'messages'                      => array(
                    'unreadNum'                 => $this->unReadPosts->count(), // 未读信息
                    'showMessage'               => $this->showMessages,
                    'moreInfoUrl'               => "/stu/posts",                // 更多信息跳转

                ), // 信息
                'stuID'                         => session('stu_num'),      // 学号
                'user'                          => session('stu_name'),     // 用户名
                'userImg'                       => "/avatar",                   // 用户头像链接 url(site)
                'toInformationURL'              => "/stu/personalInfo",         // 个人信息url

                'stuDept'                       => $major,
                'stuDormitory'                  => session('stu_dorm_str'), // 宿舍
                'stuReportTime'                 => $enrollTime,                 // 报到时间
                'domInfo'                       => "domInfo",                   // 宿舍介绍
                'yourDoms'                      => $roommates_array,
                'domLocal'                      => array(                       // 宿舍位置（定位）
                    'PX'                        => array($dorm_res->dorm_position_x
                                                    , $dorm_res->dorm_position_y),
                    'title'                     => $dorm_res->dorm_name
                ),
                'toLogoutURL'                   => "/logout",                   // 退出登录
            ]);
        }


        /**
         * 老乡信息 控制器
         */
        public function queryCountryFolk()
        {
            $cid = session('stu_cid');
            /* 识别你来自 */
            $cid_res = $this->idValidator->getInfo($cid);
            /* 查询老乡 */
            $localNumber = substr($cid, 0, 5);
            // 查询数据库
            $localStudents = Student::where([
                ['stu_cid', 'like', $localNumber . '%'],
                ['stu_cid', '<>', session('stu_cid')]
            ])->orderBy('stu_cid', 'asc')
                ->get();
            /* 来自同一个学校 */
            $fromSchool = session('stu_from_school');
            $sameSchools = [];
            foreach ($localStudents as $localStudent) {
                if ($localStudent->stu_from_school == $fromSchool)
                    array_push($sameSchools, $localStudent);
            }

            return view('stu.new.yourCountryFolk', [
                'sysType'                       => "新生",                    // 系统运行模式，新生，在校生，管理员
                'messages'                      => array(
                    'unreadNum'                 => $this->unReadPosts->count(), // 未读信息
                    'showMessage'               => $this->showMessages,
                    'moreInfoUrl'               => "/stu/posts",            // 更多信息跳转

                ), // 信息
                'stuID'                         => session('stu_num'),  // 学号
                'user'                          => session('stu_name'), // 用户名
                'userImg'                       => "/avatar",               // 用户头像链接 url(site)
                'toInformationURL'              => "/stu/personalInfo",     // 个人信息url
                'IDnumber'                      => session("stu_cid"), // 身份证号码
                'stuLocal'                      => $cid_res['address'],     // 识别地区
                'stuPreSchool'                  => $fromSchool,             // 毕业院校
                'countymens'                    => $localStudents,          // 老乡信息
                'sameSchools'                   => $sameSchools,            // 同校信息

                'toLogoutURL'                   => "/logout",               // 退出登录
            ]);
        }
    }
