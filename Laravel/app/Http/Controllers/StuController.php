<?php

namespace App\Http\Controllers;

require_once __DIR__.'/../../include.php';
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Jxlwqq\IdValidator\IdValidator;
use App\Http\Requests\LoginPost;

function str_n_pos($str,$find,$n) {
    $pos_val = 0;
    for ($i=1;$i<=$n;$i++){
        $pos = strpos($str,$find);
        $str = substr($str,$pos+1);
        $pos_val=$pos+$pos_val+1;
    }
    return $pos_val-1;
}

class StuController extends Controller
{
    private $idValidator;

    /**
     * TODO: 
     * 登录时将相关数据写入session，然后存入stu_data数组，
     * 方便在index中使用
     */

    //  example: $data['first'] = 'Zhang'; $value = session("key", "default");
    private static $stu_data = [];

    public function index() {
        
        /*班级情况统计*/
        $stu_class_str = substr(session('stu_num'), 0, 7);  //学号digit0~digit6
        //获得同班同学信息
        $classmates_array = DB::select("SELECT * FROM `t_student` WHERE `stu_num` LIKE '$stu_class_str%'");
        //性别比例
        $class_male_num = 0;
        $class_fmle_num = 0;
        foreach($classmates_array as $classmate) {
            if($classmate->stu_gen) $class_male_num++;
            else $class_fmle_num++;
        }
        //地区分布，需要做桶排序

        $classmates_addr_prov_cnt = array();
        foreach($classmates_array as $classmate) {
            $classmate_addr_info = $this->idValidator->getInfo($classmate->stu_cid);
            $classmate->address = $classmate_addr_info['address'];
            if(array_key_exists($classmate_addr_info['addressTree'][0], $classmates_addr_prov_cnt)) {
                $classmates_addr_prov_cnt[$classmate_addr_info['addressTree'][0]] += 1;
            } else {
                $classmates_addr_prov_cnt[$classmate_addr_info['addressTree'][0]] = 1;
            }
        }
        arsort($classmates_addr_prov_cnt);  //按照值降序排序
        $classmates_addr_prov_cnt = array_slice($classmates_addr_prov_cnt,0,4); //取前五个
        $top4_num = 0;
        $vals = array_values($classmates_addr_prov_cnt);
        for($i = 0; $i<4; ++$i) {
           $top4_num += $vals[$i];
        }
        $classmates_addr_prov_cnt['其他'] = $class_male_num + $class_fmle_num - $top4_num;

        $cid = session('stu_cid');
        $res = $this->idValidator->getInfo($cid);

        /*室友统计 */
        $dorm_str = substr(session('stu_dorm_str'), 0, str_n_pos(session('stu_dorm_str'), '-', 2));   // 切割宿舍信息
        $roommates_array = DB::select("SELECT * FROM `t_student` WHERE `stu_dorm_str` LIKE '$dorm_str%' AND `stu_cid`<> :cid",["cid" => $cid]);
        foreach($roommates_array as $roommate) {
            $roommate->address = $this->idValidator->getInfo($roommate->stu_cid)['address'];
        }
        /*老乡统计 */
        $stu_prov_city_str = substr(session('stu_cid'), 0, 6);
        $contry_folk_array = DB::select("SELECT * FROM `t_student` WHERE `stu_cid` LIKE '$stu_prov_city_str%' AND `stu_cid`<> :cid",["cid" => $cid]);

        return view('stu.new.index',[
            'sysType'=>"新生",  // 系统运行模式，新生，老生，管理员
            'messages'=>array(
                'unreadNum'=>3, // 未读信息数量
                'showMessage'=>array( // 选的信息
                    array(
                        'title'=>"111",
                        'context'=>"111",
                        'readed'=>false,
                    ),
                    array(
                        'title'=>"222",
                        'context'=>"222",
                        'readed'=>true,
                    ),
                ),
                'moreInfoUrl'=>"/message", // 更多信息跳转
    
            ), // 信息
            'stuID'=>session('stu_num'), // 学号
            'user'=> session('stu_name'), // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", // 更多信息url
            'toSettingURL'=>"toSettingURL", // 个人设置
            'stuDept'=>"计算机",
            'stuDomitory'=>session('stu_dorm_str'),
            'stuReportTime'=>"9月1日", // 报到时间
            'schoolInfo'=>"<div class=\"text-center\"><img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"width: 25rem;\" src=\"img/undraw_posting_photo.svg\" alt=\"\"></div><p>
            哈尔滨工业大学（以下简称哈工大）是一所有着近百年历史、世界知名的工科强校，2017年入选国家“双一流”建设A类高校，是我国首批入选国家“985工程”重点建设的大学，拥有以38位院士为带头人的雄厚师资，有9个国家一级重点学科，10个学科名列全国前五名，其中，名列前茅的工科类重点学科数量位居全国第二，工程学在全球排名第六。</p>", // 学校信息 可以html
            'toSchoolInfoURL'=>"toSchoolInfoURL",
            'toAllStuURL'=>"toAllStuURL", // 所有同学信息url
            'domStus'=>$roommates_array, // 室友
            'deptInfo'=>"deptInfo", // 专业信息
            'toDeptInfoURL'=>"toDeptInfoURL",
            'domInfo'=>"domInfo", // 宿舍信息
            'toDomInfoURL'=>"toDomInfoURL",
            'localFolks'=>$contry_folk_array, // 老乡
            'toLocalFolkURL'=>"toLocalFolksURL", // 查看老乡信息url
            'toLogoutURL'=>"/logout",      // 退出登录
            //饼图
            'yourStuChartBoyGirl'=>array($class_male_num, $class_fmle_num), // 男女比例，先男后女
            'yourStuChartProName'=>array_keys($classmates_addr_prov_cnt), // 省份名字
            'yourStuChartProData'=>array_values($classmates_addr_prov_cnt), // 每个信息
            ]);
//        return view('stu.old.index',[
//            'sysType'=>"老生",  // 系统运行模式，新生，老生，管理员
//            'messages'=>array(
//                'unreadNum'=>3, // 未读信息数量
//                'showMessage'=>array( // 选的信息
//                    array(
//                        'title'=>"111",
//                        'context'=>"111",
//                        'readed'=>false,
//                    ),
//                    array(
//                        'title'=>"222",
//                        'context'=>"222",
//                        'readed'=>true,
//                    ),
//                ),
//                'moreInfoUrl'=>"/message", // 更多信息跳转
//
//            ), // 信息
//            'stuID'=>$res_obj_array[0]->stu_num, // 学号
//            'user'=> $res_obj_array[0]->stu_name, // 用户名
//            'userImg'=> "userImg",// 用户头像链接 url(site)
//            'toInfomationURL'=>"toInfomationURL", // 个人设置url
//            'toSettingURL'=>"toSettingURL", // 个人设置
//            'stuDept'=>"计算机",
//            'stuDomitory'=>$res_obj_array[0]->stu_dorm_str,
//            'stuReportTime'=>"9月1日", // 报到时间
//            'schoolInfo'=>"<div class=\"text-center\"><img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"width: 25rem;\" src=\"img/undraw_posting_photo.svg\" alt=\"\"></div><p>
//            哈尔滨工业大学（以下简称哈工大）是一所有着近百年历史、世界知名的工科强校，2017年入选国家“双一流”建设A类高校，是我国首批入选国家“985工程”重点建设的大学，拥有以38位院士为带头人的雄厚师资，有9个国家一级重点学科，10个学科名列全国前五名，其中，名列前茅的工科类重点学科数量位居全国第二，工程学在全球排名第六。</p>", // 学校信息 可以html
//            'toSchoolInfoURL'=>"toSchoolInfoURL",
//            'toAllStuURL'=>"toAllStuURL", // 所有同学信息url
//            'domStus'=>$roommates_array, // 室友
//            'deptInfo'=>"deptInfo", // 专业信息
//            'toDeptInfoURL'=>"toDeptInfoURL",
//            'domInfo'=>"domInfo", // 宿舍信息
//            'toDomInfoURL'=>"toDomInfoURL",
//            'localFolks'=>$contry_folk_array, // 老乡
//            'toLocalFolkURL'=>"toLocalFolksURL", // 查看老乡信息url
//            'toLogoutURL'=>"toLogoutURL",      // 退出登录
//            //饼图
//            'yourStuChartBoyGirl'=>array($class_male_num, $class_fmle_num), // 男女比例，先男后女
//            'yourStuChartProName'=>array_keys($classmates_addr_prov_cnt), // 省份名字
//            'yourStuChartProData'=>array_values($classmates_addr_prov_cnt) // 每个信息
//        ]);
    }

    public function queryClass()
    {
        

        $res_obj_array = DB::select('SELECT * FROM `t_student` WHERE `stu_cid`= :stu_cid',["stu_cid" => session('stu_cid')]);
        /*班级情况统计*/
        $stu_class_str = substr(session('stu_num'), 0, 7);  //学号digit0~digit6
        $classmates_array = DB::select("SELECT * FROM `t_student` WHERE `stu_num` LIKE '$stu_class_str%'");//获得同班同学信息

        foreach($classmates_array as $classmate) {
            $classmate->address = $this->idValidator->getInfo($classmate->stu_cid)['address'];
        }
        return view('stu.new.yourClass',[
            'sysType'=>"新生",  // 系统运行模式，新生，老生，管理员
            'messages'=>array(
                'unreadNum'=>3, // 未读信息
                'showMessage'=>array(   // 选的信息
                    array(
                        'title'=>"111",
                        'context'=>"111",
                        'readed'=>false,
                    ),
                    array(
                        'title'=>"222",
                        'context'=>"222",
                        'readed'=>true,
                    ),
                ),
                'moreInfoUrl'=>"/message", // 更多信息跳转
    
            ), // 信息
            'stuID'=>session('stu_num'), // 学号
            'user'=>session('stu_name'), // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", // 个人设置url
            'toSettingURL'=>"toSettingURL", // 个人设置
            'stuDept'=>"计算机",
            'stuDomitory'=>session('stu_dorm_str'),
            'stuReportTime'=>"9月1日",
            'classmates'=>$classmates_array, // 你的同学
            'toLogoutURL'=>"/logout",      // 退出登录
            ]);
//        return view('stu.old.yourClass',[
//            'sysType'=>"老生",  // 系统运行模式，新生，老生，管理员
//            'messages'=>array(
//                'unreadNum'=>3, // 未读信息
//                'showMessage'=>array(   // 选的信息
//                    array(
//                        'title'=>"111",
//                        'context'=>"111",
//                        'readed'=>false,
//                    ),
//                    array(
//                        'title'=>"222",
//                        'context'=>"222",
//                        'readed'=>true,
//                    ),
//                ),
//                'moreInfoUrl'=>"/message", // 更多信息跳转
//
//            ), // 信息
//            'stuID'=>$res_obj_array[0]->stu_num, // 学号
//            'stuDept'=>"计算机",
//            'classID'=>$res_obj_array[0]->class_id,
//            'classmates'=>$classmates_array, // 你的同学
//            'user'=>$res_obj_array[0]->stu_name, // 用户名?
//            'userImg'=> "userImg",// 用户头像链接 url(site)?
//            'toInfomationURL'=>"toInfomationURL", // 个人设置url
//            'toSettingURL'=>"toSettingURL", // 个人设置
//            'toLogoutURL'=>"toLogoutURL",      // 退出登录
//        ]);
    }

    public function queryDorm()
    {
        /*室友统计 */
        $dorm_str = substr(session('stu_dorm_str'), 0, str_n_pos(session('stu_dorm_str'), '-', 2));   // 切割宿舍信息
        $roommates_array = DB::select("SELECT * FROM `t_student` WHERE `stu_dorm_str` LIKE '$dorm_str%' AND `stu_cid`<> :cid",
                    ["cid" => session('stu_cid')]);
        
        foreach($roommates_array as $roommate) {
            $roommate->address = $this->idValidator->getInfo($roommate->stu_cid)['address'];
        }

        return view('stu.new.yourDom',[
            'sysType'=>"新生",  // 系统运行模式，新生，老生，管理员
            'messages'=>array(
                'unreadNum'=>3, // 未读信息
                'showMessage'=>array(   // 选的信息
                    array(
                        'title'=>"111",
                        'context'=>"111",
                        'readed'=>false,
                    ),
                    array(
                        'title'=>"222",
                        'context'=>"222",
                        'readed'=>true,
                    ),
                ),
                'moreInfoUrl'=>"/message", // 更多信息跳转
    
            ), // 信息
            'stuID'=>session('stu_num'), // 学号
            'user'=>session('stu_name'), // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", // 个人设置url
            'toSettingURL'=>"toSettingURL", // 个人设置
            'stuDept'=>"计算机",
            'stuDomitory'=>session('stu_dorm_str'), // 宿舍
            'stuReportTime'=>"9月1日", // 报到时间
            'domInfo'=>"domInfo", // 宿舍介绍
            'yourDoms'=>$roommates_array,
            'domLocal'=>array( // 宿舍位置（定位）
                'PX'=>array(122.080098,37.532806),
                'title'=>"七公寓"
            ),


            'toLogoutURL'=>"/logout",      // 退出登录
            ]);
//        return view('stu.old.yourDom',[
//            'sysType'=>"老生",  // 系统运行模式，新生，老生，管理员
//            'messages'=>array(
//                'unreadNum'=>3, // 未读信息
//                'showMessage'=>array(   // 选的信息
//                    array(
//                        'title'=>"111",
//                        'context'=>"111",
//                        'readed'=>false,
//                    ),
//                    array(
//                        'title'=>"222",
//                        'context'=>"222",
//                        'readed'=>true,
//                    ),
//                ),
//                'moreInfoUrl'=>"/message", // 更多信息跳转
//
//            ), // 信息
//            'user'=>"user", // 用户名
//            'userImg'=> "userImg",// 用户头像链接 url(site)
//            'stuID'=>"stuID", // 学号
//            'stuDept'=>"计算机",
//            'stuDomitory'=>"stuDomitory", // 宿舍
//            'domInfo'=>"domInfo", // 宿舍介绍
//            'yourDoms'=>array(),
//            'domLocal'=>array( // 宿舍位置（定位）
//                'PX'=>array(122.080098,37.532806),
//                'title'=>"七公寓"
//            ),
//            'toInfomationURL'=>"toInfomationURL", // 个人设置url
//            'toSettingURL'=>"toSettingURL", // 个人设置
//            'toLogoutURL'=>"toLogoutURL",      // 退出登录
//        ]);
    }

    public function queryCountryFolk()
    {
        $cid = session('stu_cid');
        $res = $this->idValidator->getInfo($cid);
        $localNumber = substr($cid,0,5);

        $localStudents = DB::table('t_student')->where('stu_cid','like', $localNumber.'%')->get();
        $fromSchool = session('stu_fromSchool');
        $sameSchools = [];
        
        foreach($localStudents as $localStudent){
            if($localStudent->stu_fromSchool == $fromSchool)
            array_push($sameSchools,$localStudent);
        }
        
        
        return view('stu.new.yourCountryFolk',[
            'sysType'=>"新生",  // 系统运行模式，新生，老生，管理员
            'messages'=>array(
                'unreadNum'=>3, // 未读信息
                'showMessage'=>array(   // 选的信息
                    array(
                        'title'=>"111",
                        'context'=>"111",
                        'readed'=>false,
                    ),
                    array(
                        'title'=>"222",
                        'context'=>"222",
                        'readed'=>true,
                    ),
                ),
                'moreInfoUrl'=>"/message", // 更多信息跳转
    
            ), // 信息
            'stuID'=>session('stu_num'), // 学号
            'user'=>session('stu_name'), // 用户名
            'userImg'=> "userImg",// 用户头像链接 url(site)
            'toInfomationURL'=>"toInfomationURL", // 个人设置url
            'toSettingURL'=>"toSettingURL", // 个人设置
            'IDnumber'=>session("stu_cid"), // 身份证号码
            'stuLocal'=>$res['address'], // 识别地区
            'stuPreSchool'=>$fromSchool, // 毕业院校
            'countymens'=>$localStudents, // 老乡信息
            'sameSchools'=>$sameSchools, // 同校信息

            'toLogoutURL'=>"/logout",      // 退出登录
            ]);
//        return view('stu.old.yourCountryFolk',[
//            'sysType'=>"老生",  // 系统运行模式，新生，老生，管理员
//            'messages'=>array(
//                'unreadNum'=>3, // 未读信息
//                'showMessage'=>array(   // 选的信息
//                    array(
//                        'title'=>"111",
//                        'context'=>"111",
//                        'readed'=>false,
//                    ),
//                    array(
//                        'title'=>"222",
//                        'context'=>"222",
//                        'readed'=>true,
//                    ),
//                ),
//                'moreInfoUrl'=>"/message", // 更多信息跳转
//
//            ), // 信息
//            'stuID'=>"stuID", // 学号
//            'user'=>"user", // 用户名
//            'userImg'=> "userImg",// 用户头像链接 url(site)
//            'toInfomationURL'=>"toInfomationURL", // 个人设置url
//            'toSettingURL'=>"toSettingURL", // 个人设置
//            'IDnumber'=>"111111", // 身份证号码
//            'stuLocal'=>"stuLocal", // 识别地区
//            'stuPreSchool'=>"stuPreSchool", // 毕业院校
//            'countymens'=>array(), // 老乡信息
//            'sameSchools'=>array(), // 同校信息
//            'toLogoutURL'=>"toLogoutURL",      // 退出登录
//        ]);
    }

    public function __construct() {
        // $this->middleware('checkAuth');
        // 身份证获取
        $this->idValidator = new IdValidator();
    }
}
