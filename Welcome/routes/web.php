<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* only for test */

// ------------------------------------------------------------------------

Route::get('/', function () {
    return view('auth.login')->with('infoOut',session('LoginError'));
})->middleware('loginIndexCheck');

Route::post("/login", "LoginController@login");

Route::get("/logout", "LoginController@logout");

Route::get("avatar","avatarImageController@avatar");

// 绿色通道文件下载
Route::any("/greenPath/{id}/{filePath}","GreenPathController@getFiles");

Route::group(['prefix'=>'stu','middleware' => ['checkAuth:new']], function () {
    //NEW STUDENT
    Route::get('/', 'StuController@index');

    Route::get('index', 'StuController@index');

    Route::get('queryClass', 'StuController@queryClass');

    Route::get('queryDorm', 'StuController@queryDorm');

    Route::get('queryCountryFolk', 'StuController@queryCountryFolk');

    Route::get('posts', 'PostController@index');

    Route::get('posts/{postId}', 'PostController@show');

    Route::get('nav', 'NavController@index');

    Route::get('enrollInfo', 'EnrollController@enrollInfo');

    Route::get('enrollGuide', 'EnrollController@enrollGuide');

    Route::get('survey', 'SurveyController@index');

    Route::get('survey/{surveyId}', 'SurveyController@index');
    // 个人信息路由
    Route::get("personalInfo","StuInfoController@index");
    // 绿色通道
    Route::get("greenPath","GreenPathController@index");
});

/* 新生提交信息路由块 */
Route::group(['prefix'=>'stu','middleware' => ['checkAuth:new']],function (){
    // 提交个人信息
    Route::post("commitInfo","StuInfoController@commitInfo");
    // 提交绿色通道信息
    Route::post("uploadGreenPathFiles","GreenPathController@uploadFiles");
    // 删除文件
    Route::post("greenPath/delete","GreenPathController@deleteFile");
    // 获取已提交文件信息
    Route::post("greenPath/getGreenPathFiles","GreenPathController@getGreenPathFiles");
    // 获取站点信息
    Route::post("getNavTime","NavController@getNavTime");
    // 提交预约信息
    Route::post("submitBook","NavController@submitBook");
    // 删除预约
    Route::post("deleteBook","NavController@deleteBook");
});

/* SENIOR STUDENT*/
Route::group(['prefix'=>'senior','middleware' => ['checkAuth:old']], function () {
    Route::get("/", "SeniorController@index");

    Route::get('queryCountryFolk', 'SeniorController@queryCountryFolk');
});

/* 管理员信息获取块 */
Route::group(['prefix'=>'admin','middleware' => ['checkAuth:admin']], function () {
    Route::get('/', 'AdminController@index');

    Route::get('index', 'AdminController@index');

    /* /admin/posts/{post}会覆盖掉/admin/posts/create , 删去前者*/
    Route::get('posts/create', 'PostController@create');

    Route::get('manageSchoolInfo', 'AdminController@manageSchoolInfo');

    Route::get('manageNewsInfo', 'AdminController@manageNewsInfo');

    Route::get('manageAdminInfo', 'AdminManageController@index');

    Route::get('posts', 'PostController@index');
    // 管理报道信息
    Route::get("reportInfo","ReportConfigController@index");
    // 信息核验
    Route::get("reportCheck","ReportCheckController@index");
    // 个人信息更改
    Route::get("personalInfo","AdminInfoController@index");
    // 绿色通道审核
    Route::get("greenPathVerify","GreenPathVerifyController@index");
    // 到站服务
    Route::get("navManage","NavManageController@index");
    // 到站表格导出
    Route::get("navExcel","NavManageController@exportExcel");

});

// Excel Import
Route::post('/admin/stuInfoUpload','ImportController@studentExcelImport')
    ->middleware('importAuthCheck:admin');

Route::post('/admin/majorInfoUpload','ImportController@majorExcelImport')
    ->middleware('importAuthCheck:admin');

// School and other Information Import
Route::group(['prefix'=>'admin' ,'middleware' => ['postAuthCheck:admin']], function () {
    Route::post('schoolInfoPost', 'ImportController@schoolInfoPost');

    // 管理新生信息
    Route::post("storePost", "PostController@storePost");

    Route::post("deletePost", "PostController@deletePost");

    Route::post("getPost", "PostController@getPost");

    Route::post("modifyPost", "PostController@modifyPost");

    // 管理工作人员信息
    Route::post("addAdmin", "AdminManageController@addAdmin");

    Route::post("deleteAdmin", "AdminManageController@deleteAdmin");

    Route::post("getAdmin", "AdminManageController@getAdmin");

    Route::post("modifyAdmin", "AdminManageController@modifyAdmin");

    Route::post("getPermissionList", "AdminManageController@getPermissionList");

    // 管理报到流程
    Route::post("storeReportInfo","ReportConfigController@postReportInfo");

    Route::post("getReportInfo","ReportConfigController@getReportInfo");

    Route::post("saveReportInfo","ReportConfigController@saveReportInfo");

    Route::post("deleteReportInfo","ReportConfigController@deleteReportInfo");

    Route::post("saveEnrollConfig","ReportConfigController@saveEnrollConfig");

    // 新生核验部分
    Route::post("getStudentInfo","ReportCheckController@getStudentInfo");
    Route::post("confirmReportInfo","ReportCheckController@confirmReportInfo");
    // 管理员绿色通道审核-信息获取
    Route::post("getGreenPathInfo","GreenPathVerifyController@getGreenPathInfo");
    // 管理员绿色通道审核-审核信息提交
    Route::post("commitVerifyInfo","GreenPathVerifyController@commitVerifyInfo");
    // 接车信息-获取站点设置
    Route::post("getPortInfo","NavManageController@getPortInfo");
    // 接车信息-增加/修改站点信息
    Route::post("savePortInfo","NavManageController@savePortInfo");
    // 接着信息-删除
    Route::post("deletePort","NavManageController@deletePort");

});





