<?php
use Illuminate\Support\Facades\Hash;
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
    return view('auth.login');
})->middleware('loginIndexCheck');

Route::post("/login", "LoginController@login");

Route::get("/logout", "LoginController@logout");

/* 使用中间件组方式比较灵活 */
Route::group(['middleware' => ['checkAuth:new']], function () {
    //NEW STUDENT

    Route::get('/stu', 'StuController@index');

    Route::get('/stu/index', 'StuController@index');

    Route::get('/stu/queryClass', 'StuController@queryClass');

    Route::get('/stu/queryDorm', 'StuController@queryDorm');

    Route::get('/stu/queryCountryFolk', 'StuController@queryCountryFolk');

    Route::get('/stu/posts', 'PostController@index');

    Route::get('/stu/posts/{postId}', 'PostController@show');

    Route::get('/stu/nav', 'NavController@index');

    Route::get('/stu/enrollInfo', 'EnrollController@enrollInfo');

    Route::get('/stu/enrollGuide', 'EnrollController@enrollGuide');

    Route::get('/stu/survey', 'SurveyController@index');

    Route::get('/stu/survey/{surveyId}', 'SurveyController@index');
});
/* SENIOR STUDENT*/
Route::group(['middleware' => ['checkAuth:old']], function () {
    Route::get("/senior", "SeniorController@index");
    Route::get('/senior/queryClass', 'SeniorController@queryClass');
    Route::get('/senior/queryDorm', 'SeniorController@queryDorm');
    Route::get('/senior/queryCountryFolk', 'SeniorController@queryCountryFolk');
});
//ADMIN
Route::group(['middleware' => ['checkAuth:admin']], function () {
    Route::get('/admin', 'AdminController@index');

    Route::get('/admin/index', 'AdminController@index');

    /* /admin/posts/{post}会覆盖掉/admin/posts/create */
    Route::get('/admin/posts/create', 'PostController@create'); 

    Route::get('/admin/manageSchoolInfo', 'AdminController@manageSchoolInfo');

    Route::get('/admin/manageNewsInfo', 'AdminController@manageNewsInfo');

    Route::get('/admin/posts', 'PostController@index');

    Route::get('/admin/posts/{post}', 'PostController@show');

});

// Excel Import
Route::post('/admin/stuInfoUpload','ImportController@studentExcelImport')
    ->middleware('importAuthCheck:admin');

Route::post('/admin/majorInfoUpload','ImportController@majorExcelImport')
    ->middleware('importAuthCheck:admin');

// School and other Information Import
Route::group(['middleware' => ['postAuthCheck:admin']], function () {
    Route::post('/admin/schoolInfoPost', 'ImportController@schollInfoPost');

    Route::post("/admin/storePost", "ImportController@storePost");

    Route::post("/admin/deletePost", "PostController@deletePost");

    Route::post("/admin/getPost", "PostController@getPost");

    Route::post("/admin/edit", "PostController@editPost");
});





