<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 管理员管理控制器
class AdminManageController extends Controller
{
    // 管理员设定-页面展示
    public function index()
    {
        $adminLists = Admin::paginate(10);
        foreach ($adminLists as $adminList){
            $permissionName = Permission::where('id',$adminList->pms_id)->first('pms_name');
            if($permissionName){
                $adminList->permission = $permissionName->pms_name;
            }
        }
        $adminTotal = Admin::count();
        return view('admin.manageAdmin', [
            'sysType'               => "管理员",
            'user'                  => session("name"),
            'userImg'               => "/avatar",
            'toInformationURL'      => "/admin/personalInfo",
            'adminTotal'            => $adminTotal,
            'adminList'             => $adminLists,
            'getAdminURL'           => '/admin/getAdmin',
            'modifyAdminURL'        => '/admin/modifyAdmin',
            'deleteAdminURL'        => '/admin/deleteAdmin',
            'getPermissionListURL'  => '/admin/getPermissionList',
            'addAdminURL'           => '/admin/addAdmin',
            'toLogoutURL'           => "/logout",      // 退出登录
        ]);
    }

    // 管理员设定-添加管理员
    public function addAdmin(Request $request)
    {
        if (!$request->ajax()) {
            return back();
        }
        if(!$request->has(["adm_name","adm_password","adm_permission"])){
            $array=array(
                "code" => 401,
                "msg" => "Missing parameters!",
                "data" => "缺失参数",
            );
            return response()->jsonp($request->input('callback'),$array);
        }

        if(!Permission::where('id',$request->post("adm_permission"))->first()){
            $array=array(
                "code" => 403,
                "msg" => "Forbidden Permission",
                "data" => "非法权限",
            );
            return response()->jsonp($request->input('callback'),$array);
        }
        if(Admin::where('adm_name', $request->post("adm_name"))->first('id')) {
            $array=array(
                "code" => 400,
                "msg" => "Username collision!",
                "data" => "用户名已存在！",
                "exception" => "用户名已存在！"
            );
            return response()->jsonp($request->input('callback'),$array);
        }
        try{
            $admin = new Admin();
            $admin->adm_name = $request->post("adm_name");
            $admin->adm_password = bcrypt($request->post("adm_password"));
            $admin->pms_id = $request->post("adm_permission");
            $admin->save();
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
    // 管理员设定-删除管理员
    public function deleteAdmin(Request $request)
    {
        if ($request->has('deleteID')) {
            $deleteAdminID = $request->post('deleteID');
            if(session('id') == $deleteAdminID){
                $array = array(
                    "code" => 403,
                    "msg" => "You cannot delete yourselves!",
                    "data" => "不能删除自己！"
                );
            }else if(Admin::where('pms_id',1)->count() === 1
                && Admin::find($deleteAdminID,'pms_id')->pms_id === 1){
                $array = array(
                    "code" => 403,
                    "msg" => "Cannot delete the only administrator!",
                    "data" => "不能删除唯一一个超级管理员！"
                );
            }else {
                Admin::destroy($deleteAdminID);
                $array = array(
                    "code" => 200,
                    "msg" => "Delete successfully!",
                    "data" => "成功删除！"
                );
            }
        } else {
            $array = array(
                "code" => 401,
                "msg" => "Missing parameters!",
                "data" => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }

    // 管理员设定-获取管理员信息
    public function getAdmin(Request $request)
    {
        if ($request->has('requestID')) {
            $id = $request->post('requestID');
            $get = Admin::find($id);
            if ($get) {
                $array = array(
                    "code" => 200,
                    "msg" => "Data get successfully!",
                    "data" => array(
                        "name" => $get->adm_name,
                        "permission" => $get->pms_id,
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
                "code" => 401,
                "msg" => "Missing parameters!",
                "data" => "缺失参数！"
            );
        }
        return response()->jsonp($request->input('callback'), $array);
    }
    // 管理员设定-获取权限表
    public function getPermissionList(Request $request){
        $get = Permission::all('id','pms_name');
        $array = array(
            "code" => 200,
            "msg" => "Data get successfully!",
            "data" => $get
        );
        return response()->jsonp($request->input('callback'), $array);
    }
    // 管理员设定-修改管理员信息
    public function modifyAdmin(Request $request)
    {
        if ($request->has(['modifyID', 'adm_name', 'adm_password', 'adm_permission'])) {
            $id = $request->post('modifyID');
            $get = Admin::find($id);
            if ($get) {
                if(!Permission::where('id',$request->post("adm_permission"))->first()){
                    $array=array(
                        "code" => 403,
                        "msg" => "Forbidden Permission",
                        "data" => "非法权限",
                    );
                    return response()->jsonp($request->input('callback'),$array);
                }
                if(Admin::where([
                    ['id','<>',$id],
                    ['adm_name','like', $request->post('adm_name')]
                ])->first()){
                    $array=array(
                        "code" => 400,
                        "msg" => "Username collision!",
                        "data" => "用户名已存在！"
                    );
                    return response()->jsonp($request->input('callback'),$array);
                }
                $get->adm_name = $request->post('adm_name');
                $get->adm_password = bcrypt($request->post('adm_password'));
                $get->pms_id = $request->post('adm_permission');
                $get->save();
                $array = array(
                    "code" => 200,
                    "msg" => "Data saved successfully!",
                    "data" => "成功保存"
                );
            } else {
                $array = array(
                    "code" => 404,
                    "msg" => "Cannot get the user!",
                    "data" => "不存在这个用户"
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
