# 模块url命名

### 总体
| 模块 | 路由URL | 路由目的函数 |
| ---- | ------- | ------------ |
| 登录 | /login  |              |

#### 新生
| 模块                   | 路由URL                | 路由目的函数                                        |
| ---------------------- | ---------------------- | --------------------------------------------------- |
| 新生-首页              | /stu                   | \App\Http\Controllers\StuController@index           |
| 新生-信息查询-你的班级 | /stu/queryClass        | \App\Http\Controllers\StuController@queryClass      |
| 新生-信息查询-你的宿舍 | /stu/queryDorm         | \App\Http\Controllers\StuController@queryDorm       |
| 新生-信息查询-你的老乡 | /stu/queryContryFolk   | \App\Http\Controllers\StuController@queryContryFolk |
| 新生-通知公告          | /stu/posts             | \App\Http\Controllers\PostController@index          |
| 新生-通知公告-通知详情 | /stu/posts/{postId}    | \App\Http\Controllers\PostController@show           |
| 新生-到站信息          | /stu/nav               | \App\Http\Controllers\NavController@index           |
| 新生-报到流程-报到说明 | /stu/enrollInfo        | \App\Http\Controllers\EnrollController@enrollInfo   |
| 新生-报到流程-开始报道 | /stu/enrollGuide       | \App\Http\Controllers\EnrollController@enrollGuide  |
| 新生-问卷系统          | /stu/survey            | \App\Http\Controllers\SurveyController@index        |
| 新生-问卷系统-填写问卷 | /stu/survey/{surveyId} | \App\Http\Controllers\SurveyController@show         |



#### 老生
| 模块                   | 路由URL              | 路由目的函数 |
| ---------------------- | -------------------- | ------------ |
| 老生-首页              | /stu                 |              |
| 老生-信息查询-老乡查询 | /stu/queryContryFolk |              |
| 老生-所有通知          | /stu/posts           |              |

#### 管理员

| 模块                             | 路由URL                    | 路由目的函数                                         |
| -------------------------------- | -------------------------- | ---------------------------------------------------- |
| 管理员-首页                      | /admin/index               |\App\Http\Controllers\AdminController@index          |
| 管理员-个人信息                  | /admin/personalInfo        |\App\Http\Controllers\AdminController@info            |
| 管理员-学校信息录入              | /admin/manageSchoolInfo    |\App\Http\Controllers\AdminController@manageSchoolInfo|
| 管理员-新生管理                  | /admin/manageNewsInfo      | \App\Http\Controllers\AdminController@manageNewsInfo |
| 管理员-管理员管理                | /admin/manageAdminInfo     | \App\Http\Controllers\AdminController@manageAdminInfo|
| 管理员-通知管理                  | /admin/posts               | \App\Http\Controllers\PostController@index           |
| 管理员-通知管理-通知详情         | /admin/posts/{postId}      | \App\Http\Controllers\PostController@show            |
| 管理员-通知管理-通知编辑         | /admin/posts/edit/{postId} | \App\Http\Controllers\PostController@edit            |
| 管理员-通知管理-发布通知         | /admin/posts/create        | \App\Http\Controllers\PostController@create          |
| 管理员-到站信息                  | /admin/nav                 | \App\Http\Controllers\NavController@index            |
| 管理员-问卷系统（问卷列表）      | /admin/survey              | \App\Http\Controllers\SurveyController@index         |
| 管理员-问卷系统-编辑问卷         | /admin/survey/{surveyId}   | \App\Http\Controllers\SurveyController@show          |
| 管理员-报到流程-报到说明（编辑） | /admin/reportInfo          | \App\Http\Controllers\ReportController@reportInfo    |
| 管理员-报到流程-开始报到（编辑） | /admin/reportGuide         | \App\Http\Controllers\ReportController@reportGuide   |
| 管理员-迎新核验                  | /admin/reportCheck         | \App\Http\Controllers\ReportController@reportCheck   |

注：
    - 以上路由安排尚不完善，后期依照需要调整；
        - 期望将新生/老生业务使用同一套逻辑，添加的字段可以区分；
        - 写完之后感觉路由具体起什么名其实用处不大，/stu/和/admin/没什么作用；