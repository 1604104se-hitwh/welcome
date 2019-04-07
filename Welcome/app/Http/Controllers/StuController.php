<?php

    namespace App\Http\Controllers;

    require_once __DIR__ . '/../../include.php';

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    use Jxlwqq\IdValidator\IdValidator;
// use models
    use App\Models\Students as Student;

    class StuController extends Controller
    {
        private $idValidator;

        public function __construct()
        {
            // 身份证获取
            $this->idValidator = new IdValidator();
        }

        /**
         * 首页 控制器
         */
        public function index()
        {
            $stu_class_str = substr(session('stu_num'), 0, 7);  //学号digit0~digit6
            //获得同班同学信息
            $classmates_array = Student::where('stu_num', 'like', $stu_class_str . '%')
                ->orderBy('stu_num', 'asc')
                ->get();
            //性别比例
            $class_male_num = 0;
            $class_female_num = 0;
            foreach ($classmates_array as $classmate) {
                if ($classmate->stu_gen) $class_male_num++;
                else $class_female_num++;
            }
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

            arsort($classmates_addr_prov_cnt);  //按照值降序排序
            $classmates_addr_prov_cnt = array_slice($classmates_addr_prov_cnt, 0, 4); //取前五个

            $top4_num = 0;
            $vals = array_values($classmates_addr_prov_cnt);
            for ($i = 0; $i < count($classmates_addr_prov_cnt); ++$i) {
                $top4_num += $vals[$i];
            }
            if (0 != $restNumber = $class_male_num + $class_female_num - $top4_num)
                $classmates_addr_prov_cnt['其他'] = $restNumber;

            $cid = session('stu_cid');
            $res = $this->idValidator->getInfo($cid);

            /*室友统计 */
            $dorm_str = substr(session('stu_dorm_str'), 0, str_n_pos(session('stu_dorm_str'), '-', 2));   // 切割宿舍信息
            $roommates_array = Student::where([
                ['stu_dorm_str', 'like', $dorm_str . '%'],
                ['stu_cid', '<>', $cid]
            ])->orderBy('stu_dorm_str', 'asc')
                ->get();

            foreach ($roommates_array as $roommate) {
                $roommate->address = $this->idValidator->getInfo($roommate->stu_cid)['address'];
            }
            /*老乡统计 */
            $stu_prov_city_str = substr(session('stu_cid'), 0, 5);
            $country_folk_array = Student::where([
                ['stu_cid', 'like', $stu_prov_city_str . '%'],
                ['stu_cid', '<>', $cid]
            ])->orderBy('stu_cid', 'asc')
                ->get();

            return view('stu.new.index', [
                'sysType' => "新生",  // 系统运行模式，新生，老生，管理员
                'messages' => array(
                    'unreadNum' => 3, // 未读信息数量
                    'showMessage' => array( // 选的信息
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
                'stuID' => session('stu_num'), // 学号
                'user' => session('stu_name'), // 用户名
                'userImg' => "userImg", // 用户头像链接 url(site)
                'toInformationURL' => "toInformationURL", // 更多信息url
                'toSettingURL' => "toSettingURL", // 个人设置
                'stuDept' => "计算机",
                'stuDormitory' => session('stu_dorm_str'),
                'stuReportTime' => "9月1日", // 报到时间
                'schoolInfo' => "<div class=\"text-center\"><img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"width: 25rem;\" src=\"img/undraw_posting_photo.svg\" alt=\"\"></div><p>
            哈尔滨工业大学（以下简称哈工大）是一所有着近百年历史、世界知名的工科强校，2017年入选国家“双一流”建设A类高校，是我国首批入选国家“985工程”重点建设的大学，拥有以38位院士为带头人的雄厚师资，有9个国家一级重点学科，10个学科名列全国前五名，其中，名列前茅的工科类重点学科数量位居全国第二，工程学在全球排名第六。</p>", // 学校信息 可以html
                'toSchoolInfoURL' => "toSchoolInfoURL",
                'toAllStuURL' => "/stu/queryClass", // 所有同学信息url
                'dormStus' => $roommates_array, // 室友
                'deptInfo' => "deptInfo", // 专业信息
                'toDeptInfoURL' => "toDeptInfoURL",
                'domInfo' => "domInfo", // 宿舍信息
                'toDormInfoURL' => "/stu/queryDorm",
                'localFolks' => $country_folk_array, // 老乡
                'toLocalFolkURL' => "/stu/queryCountryFolk", // 查看老乡信息url
                'toLogoutURL' => "/logout",      // 退出登录
                //饼图
                'yourStuChartBoyGirl' => array($class_male_num, $class_female_num), // 男女比例，先男后女
                'yourStuChartProName' => array_keys($classmates_addr_prov_cnt), // 省份名字
                'yourStuChartProData' => array_values($classmates_addr_prov_cnt), // 每个信息
            ]);

        }

        /**
         * 同班同学 控制器
         */
        public function queryClass()
        {
            $stu_class_str = substr(session('stu_num'), 0, 7);  //学号digit0~digit6
            //获得同班同学信息
            $classmates_array = Student::where('stu_num', 'like', $stu_class_str . '%')
                ->orderBy('stu_num', 'asc')
                ->get();

            foreach ($classmates_array as $classmate) {
                $classmate->address = $this->idValidator->getInfo($classmate->stu_cid)['address'];
            }
            return view('stu.new.yourClass', [
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
                'stuID' => session('stu_num'), // 学号
                'user' => session('stu_name'), // 用户名
                'userImg' => "userImg", // 用户头像链接 url(site)
                'toInformationURL' => "toInformationURL", // 个人设置url
                'toSettingURL' => "toSettingURL", // 个人设置
                'stuDept' => "计算机",
                'stuDormitory' => session('stu_dorm_str'),
                'stuReportTime' => "9月1日",
                'classmates' => $classmates_array, // 你的同学
                'toLogoutURL' => "/logout",      // 退出登录
            ]);

        }

        /**
         * 室友信息 控制器
         */
        public function queryDorm()
        {
            $dorm_str = substr(session('stu_dorm_str'), 0, str_n_pos(session('stu_dorm_str'), '-', 2));   // 切割宿舍信息
            $roommates_array = Student::where([
                ['stu_dorm_str', 'like', $dorm_str . '%'],
                ['stu_cid', '<>', session('stu_cid')]
            ])->orderBy('stu_dorm_str', 'asc')
                ->get();

            foreach ($roommates_array as $roommate) {
                $roommate->address = $this->idValidator->getInfo($roommate->stu_cid)['address'];
            }

            return view('stu.new.yourDom', [
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
                'stuID' => session('stu_num'), // 学号
                'user' => session('stu_name'), // 用户名
                'userImg' => "userImg", // 用户头像链接 url(site)
                'toInformationURL' => "toInformationURL", // 个人设置url
                'toSettingURL' => "toSettingURL", // 个人设置
                'stuDept' => "计算机",
                'stuDormitory' => session('stu_dorm_str'), // 宿舍
                'stuReportTime' => "9月1日", // 报到时间
                'domInfo' => "domInfo", // 宿舍介绍
                'yourDoms' => $roommates_array,
                'domLocal' => array( // 宿舍位置（定位）
                    'PX' => array(122.080098, 37.532806),
                    'title' => "七公寓"
                ),
                'toLogoutURL' => "/logout",      // 退出登录
            ]);
        }

        /**
         * 老乡信息 控制器
         */
        public function queryCountryFolk()
        {
            $cid = session('stu_cid');
            $res = $this->idValidator->getInfo($cid);
            $localNumber = substr($cid, 0, 5);
            // 查询数据库
            $localStudents = Student::where([
                ['stu_cid', 'like', $localNumber . '%'],
                ['stu_cid', '<>', session('stu_cid')]
            ])->orderBy('stu_cid', 'asc')
                ->get();

            $fromSchool = session('stu_from_school');
            $sameSchools = [];

            foreach ($localStudents as $localStudent) {
                if ($localStudent->stu_from_school == $fromSchool)
                    array_push($sameSchools, $localStudent);
            }

            return view('stu.new.yourCountryFolk', [
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
                'stuID' => session('stu_num'), // 学号
                'user' => session('stu_name'), // 用户名
                'userImg' => "userImg", // 用户头像链接 url(site)
                'toInformationURL' => "toInformationURL", // 个人设置url
                'toSettingURL' => "toSettingURL", // 个人设置
                'IDnumber' => session("stu_cid"), // 身份证号码
                'stuLocal' => $res['address'], // 识别地区
                'stuPreSchool' => $fromSchool, // 毕业院校
                'countymens' => $localStudents, // 老乡信息
                'sameSchools' => $sameSchools, // 同校信息

                'toLogoutURL' => "/logout",      // 退出登录
            ]);
        }
    }
