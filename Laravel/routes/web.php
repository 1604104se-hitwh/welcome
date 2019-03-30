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

Route::get('/', function () {
    return view('auth.login');
});

//STUDENT
Route::get('/stu', '\App\Http\Controllers\StuController@index');

Route::get('/stu/queryClass', '\App\Http\Controllers\StuController@queryClass');

Route::get('/stu/queryDorm', '\App\Http\Controllers\StuController@queryDorm');

Route::get('/stu/queryContryFolk', '\App\Http\Controllers\StuController@queryContryFolk');

Route::get('/stu/posts', '\App\Http\Controllers\PostController@index');

Route::get('/stu/posts/{postId}', '\App\Http\Controllers\PostController@show');

Route::get('/stu/nav', '\App\Http\Controllers\NavController@index');

Route::get('/stu/enrollInfo', '\App\Http\Controllers\EnrollController@enrollInfo');

Route::get('/stu/enrollGuide', '\App\Http\Controllers\EnrollController@enrollGuide');

Route::get('/stu/survey', '\App\Http\Controllers\SurveyController@index');

Route::get('/stu/survey/{surveyId}', '\App\Http\Controllers\SurveyController@index');



//ADMIN

//...

Route::get('/adm/posts', '\App\Http\Controllers\PostController@index');

Route::get('/adm/posts/{post}', '\App\Http\Controllers\PostController@show');

Route::get('/adm/posts/create', '\App\Http\Controllers\PostController@create');

