<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

// 管理员个人信息修改控制器
class AdminInfoController extends Controller
{
    // 管理员个人信息展示块
    public function index(Request $request){
        $role = Admin::leftJoin('t_permission','pms_id','t_permission.id')->where('t_admin.id',session('id'))->first('pms_name')->pms_name;
        return view('admin.selfInfoManage', [
            'sysType'               => "管理员",
            'user'                  => session("name"),
            'userImg'               => "/avatar",
            'toInformationURL'      => "/admin/personalInfo",
            'role'                  => $role,

            'getAdminURL'           => '/admin/getAdmin',
            'modifyAdminURL'        => '/admin/modifyAdmin',
            'deleteAdminURL'        => '/admin/deleteAdmin',
            'getPermissionListURL'  => '/admin/getPermissionList',
            'addAdminURL'           => '/admin/addAdmin',
            'toLogoutURL'           => "/logout",      // 退出登录
        ]);
    }
}
