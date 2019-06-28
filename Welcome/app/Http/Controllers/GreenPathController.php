<?php

namespace App\Http\Controllers;

use App\Models\EnrollCfg;
use App\Models\Major;
use App\Models\Post;
use App\Models\Students;
use App\Models\StudentsHelp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facade;
use Illuminate\Http\Request;

// 新生绿色通道申请块
class GreenPathController extends Controller
{
    public function index(Request $request){
        $showMessages = array();
        $showPosts = Post::orderBy('post_timestamp','desc')->limit(5)->get();
        $unReadPosts = Post::whereNotIn('id',function($query){
            $query->select("post_id")->from("t_post_read")->where("stu_id", session('id'));
        })->get();
        foreach ($showPosts as $post) {
            $showMessages[] = array(
                "title"     => $post->post_title,
                "context"   => mb_strlen($post->post_content,"UTF-8") > 12 ?
                    mb_substr($post->post_content,0,10,"UTF-8")."...":$post->post_content ,
                "toURL"     => "/stu/posts/".$post->id,
                "readed"    => $unReadPosts->where('id',$post->id)->isEmpty()
            );
        }
        /* 报到配置信息 */
        $enrollCfg = EnrollCfg::find(1);
        $enrollTime = ($enrollCfg) ?
            $enrollCfg['enrl_begin_time'] : "暂无信息";
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
        /*个人信息获取*/
        $stuInfo =  Students::where('t_student.id',session('id'))
            ->leftJoin('t_student_info','t_student.id','t_student_info.student_id')
            ->leftJoin('t_student_help','t_student.id','t_student_help.student_id')
            ->leftJoin('t_major','t_major.major_num',DB::raw('SUBSTRING(stu_num,3,3)'))
            ->leftJoin('t_department','t_department.id','t_major.dept_id')->first(array(
                'stu_name as name','stu_num as schoolID',DB::raw('IF(stu_gen="0","男","女") as gender'),
                't_student.id as id','stu_cid as cid','dept_name as dept',
                'major_name as major','nation','party',
                DB::raw('IF(verify=2,"申请未通过",IF(verify=0,"申请未审核",IF(verify=1,"已通过申请","暂未申请"))) as greenPath'),
                'verify_info','home_addr as homeLocation','verify',
                DB::raw('IF(stu_status="PREPARE",true,false) as needVerify'), 'stu_status'
            ));
        return view('stu.new.greenPath', [
            'sysType'                       => "新生",                        // 系统运行模式，新生，在校生，管理员
            'messages'                      => array(
                'unreadNum'                 => $unReadPosts->count(),       // 未读信息
                'showMessage'               => $showMessages,
                'moreInfoUrl'               => "/stu/post",                 // 更多信息跳转
            ), // 信息
            'stuID'                         => session('stu_num'),      // 学号
            'user'                          => session('stu_name'),     // 用户名
            'userImg'                       => "/avatar",                   // 用户头像链接 url(site)
            'toInformationURL'              => "/stu/personalInfo",         // 个人信息url
            'stuInfo'                       => $stuInfo,
            'verifyResult'                  => $stuInfo->greenPath,
            'verifyResultbool'              => $stuInfo->verify,
            'verifyReason'                  => $stuInfo->verify_info?$stuInfo->verify_info:"暂无信息",

            'stuDept'                       => $major,
            'stuDormitory'                  => session('stu_dorm_str'),
            'stuReportTime'                 => $enrollTime,
            'toLogoutURL'                   => "/logout",                   // 退出登录
        ]);
    }

    public function uploadFiles(Request $request){
        $get = StudentsHelp::firstOrNew(['student_id'=>session('id')]);
        if($get->verify == 1){
            $error = ['error'=>'文件上传已经关闭！'];
            return json_encode($error);
        }else{
            $get->verify = 0;   // 设置未审核
        }
        $files = json_decode($get->files);
        foreach ($request->file('input-files') as $file){
            if($file->isValid()){
                $md5 = md5($file->get().new Carbon());
                $getUrl = $file->storeAs('/greenPath/'.session('id'),$md5);
                $config[] = [
                    'caption'       => $file->getClientOriginalName(),
                    'size'          => $file->getSize(),
                    'downloadUrl'   => url($getUrl),
                    'url'           => url('stu/greenPath/delete'),
                    'key'           => $md5,
                ];
                $preview[]=url($getUrl);
                $files[] = [
                    'file'          => $getUrl,
                    'name'          => $file->getClientOriginalName(),
                    'md5'           => $md5,
                    'size'          => $file->getSize(),
                    'type'          => $file->getClientOriginalExtension()
                ];
            }else{
                $error = ['error'=>'Upload error！Reason:'.$file->getErrorMessage()];
            }

        }
        $get->files = json_encode($files);
        $get->save();

        $out =isset($error)?$error : ['initialPreview' => $preview,'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
        return json_encode($out);
    }

    // 获取已经上传的文件信息
    public function getGreenPathFiles(Request $request){
        $get = StudentsHelp::where(['student_id'=>session('id')])->first('files');
        if($get){
            $data = $get->files;
            Facade::info($data);
            $array=array(
                "code" => 200,
                "msg" => "Get data",
                "data" => $data
            );
        }else{
            $array=array(
                "code" => 404,
                "msg" => "Have no record!",
                "data" => "没有数据！"
            );
        }
        return response()->jsonp($request->input('callback'),$array);
    }

    // 获取文件
    public function getFiles(Request $request,$id,$files){
        $file = json_decode(StudentsHelp::where('student_id',$id)->first('files')->files);
        $name = $files;
        foreach ($file as $key=>$value){
            if($value->md5 == $files){
                $name = $value->name;
                break;
            }
        }
        if(session('Auth')==="admin"){
            if(Storage::exists('/greenPath/'.$id.'/'.$files)){
                return Storage::download('/greenPath/'.$id.'/'.$files,$name);
            }else{
                return response("文件不存在",404);
            }
        }else{
            if($id == session('id')){
                if(Storage::exists('/greenPath/'.$id.'/'.$files)){
                    return Storage::download('/greenPath/'.$id.'/'.$files,$name);
                }else{
                    return response("文件不存在",404);
                }
            }else{
                return response("你没有权限",403);
            }
        }

    }

    // 删除文件
    public function deleteFile(Request $request){
        if($request->has('key')){
            $keys = $request->post('key');
            if(session('Auth')=="new"){
                $get = StudentsHelp::where('student_id',session('id'))->first(['verify','files']);
                if($get->verify == 1){
                    return response("文件删除功能已关闭！",403);
                }
                $file = json_decode($get->files);
                foreach ($file as $key=>$value){
                    if($value->md5 == $keys){
                        if(is_array($file))
                            array_splice($file,$key,1);
                        else
                            $file = array();
                        break;
                    }
                }
                StudentsHelp::where('student_id',session('id'))->update(['files'=>json_encode($file)]);
                Storage::delete('/greenPath/'.session('id').'/'.$keys);
                $array=array(
                    "code" => 200,
                    "msg" => "Delete successfully",
                    "data" => "成功删除"
                );
                return json_encode($array);
            }
        }else{
            return response("参数不合要求",403);
        }
    }
}
