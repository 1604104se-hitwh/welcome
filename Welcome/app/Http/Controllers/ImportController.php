<?php

namespace App\Http\Controllers;

use App\Imports\MajorImport;
use App\Imports\StudentsImport;
use App\Models\EnrollCfg;
use App\Models\Post;
use App\Models\Students;
use App\Models\SysInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function studentExcelImport(Request $request){
        // 产生提交，注意开始清除原有数据
        try{
            DB::beginTransaction();
            if(EnrollCfg::first()->enrl_permission){
                // 准许核验，不能上传
                $array=array(
                    "code" => 401,
                    "msg" => "Is in enroll process, Import is denied!",
                    "data" => "正在核验过程，不能进行修改操作！"
                );
                DB::rollBack();
                return response()->jsonp($request->input('callback'),$array);
            }
            // 第一步，如果有，ENROLLING转成CURRENT
            Students::where('stu_status','ENROLLING')->update(['stu_status'=>'CURRENT']);
            // 第二步，清除全部的PREPARE
            Students::where('stu_status','PREPARE')->delete();
            if($request->hasFile('newsInfo') && $request->file('newsInfo')->isValid()){
                try{
                    Excel::import(new StudentsImport, $request->file('newsInfo'));
                }catch (\Exception $e){
                    DB::rollBack();
                    $array=array(
                        "code" => 501,
                        "msg" => "The file may has some error!",
                        "data" => "上传的文件可能有误！",
                        "exception" => $e->getMessage()
                    );
                    return response()->jsonp($request->input('callback'),$array);
                }
                DB::commit();
                $array=array(
                    "code" => 200,
                    "msg" => "Saved!",
                    "data" => "已成功保存！"
                );
                return response()->jsonp($request->input('callback'),$array);
            }
            // 文件出错
            DB::rollBack();
            $array=array(
                "code" => 404,
                "msg" => "The files has something error!",
                "data" => "文件上传出错！"
            );
            return response()->jsonp($request->input('callback'),$array);
        }catch (\Exception $e){
            DB::rollBack();
            $array=array(
                "code" => 500,
                "msg" => "The programing process error! Please call administrator for help!",
                "data" => "程序内部错误，请告知管理员处理！",
                "exception" => $e->getMessage()
            );
            return response()->jsonp($request->input('callback'),$array);
        }

    }

    public function majorExcelImport(Request $request){
        try{
            DB::beginTransaction();
            // 开始需要去除所有的信息
            DB::table('t_department')->delete();
            DB::table('t_major')->delete();
            if($request->hasFile('majorInfo') && $request->file('majorInfo')->isValid()){
                try{
                    Excel::import(new MajorImport, $request->file('majorInfo'));
                }catch (\Exception $e){
                    DB::rollBack();
                    $array=array(
                        "code" => 501,
                        "msg" => "The file may has some error!",
                        "data" => "上传的文件可能有误！",
                        "exception" => $e->getMessage()
                    );
                    return response()->jsonp($request->input('callback'),$array);
                }
                DB::commit();
                $array=array(
                    "code" => 200,
                    "msg" => "Saved!",
                    "data" => "已成功保存！"
                );
                return response()->jsonp($request->input('callback'),$array);
            }
            // 文件出错
            DB::rollBack();
            $array=array(
                "code" => 404,
                "msg" => "The files has something error!",
                "data" => "文件上传出错！"
            );
            return response()->jsonp($request->input('callback'),$array);
        }catch (\Exception $e){
            DB::rollBack();
            $array=array(
                "code" => 500,
                "msg" => "The programing process error! Please call administrator for help!",
                "data" => "程序内部错误，请告知管理员处理！",
                "exception" => $e->getMessage()
            );
            return response()->jsonp($request->input('callback'),$array);
        }
    }

    public function schoolInfoPost(Request $request) {
        try{
            DB::beginTransaction();
            $enrollcfg = SysInfo::find(1);
            if($enrollcfg){
                $enrollcfg->school_info = $request->post('schoolInfo');
                $enrollcfg->save();
            }else{
                SysInfo::create(['school_info' => $request->post('schoolInfo')]);
            }
            DB::commit();
            $array=array(
                "code" => 200,
                "msg" => "Saved!"
            );
            return response()->jsonp($request->input('callback'),$array);
        }catch (\Exception $e){
            DB::rollBack();
            $array=array(
                "code" => 500,
                "msg" => "The programing process error! Please call administrator for help!",
                "data" => "程序内部错误，请告知管理员处理！",
                "exception" => $e->getMessage()
            );

            return response()->jsonp($request->input('callback'),$array);
        }
    }

}
