# 模块url命名

### 总体
| 模块 | 路由URL | 路由目的函数           |
| ---- | ------- | ---------------------- |
| 登录 | /       | LoginController@login  |
| 退出 | /logout | LoginController@logout |

#### 新生
| 模块                   | 路由URL                | 路由目的函数                  |
| ---------------------- | ---------------------- | ----------------------------- |
| 新生-首页              | /stu                   | StuController@index           |
| 新生-信息查询-你的班级 | /stu/queryClass        | StuController@queryClass      |
| 新生-信息查询-你的宿舍 | /stu/queryDorm         | StuController@queryDorm       |
| 新生-信息查询-你的老乡 | /stu/queryContryFolk   | StuController@queryContryFolk |
| 新生-通知公告          | /stu/posts             | PostController@index          |
| 新生-通知公告-通知详情 | /stu/posts/{postId}    | PostController@show           |
| 新生-到站信息          | /stu/nav               | NavController@index           |
| 新生-报到流程-报到说明 | /stu/enrollInfo        | EnrollController@enrollInfo   |
| 新生-报到流程-开始报到 | /stu/enrollGuide       | EnrollController@enrollGuide  |
| 新生-问卷系统          | /stu/survey            | SurveyController@index        |
| 新生-问卷系统-填写问卷 | /stu/survey/{surveyId} | SurveyController@show         |



#### 在校生
| 模块                   | 路由URL                 | 路由目的函数                     |
| ---------------------- | ----------------------- | -------------------------------- |
| 在校生-首页              | /senior                 | SeniorController@index           |
| 在校生-信息查询-老乡查询 | /senior/queryContryFolk | SeniorController@queryContryFolk |
| 在校生-所有通知          | /senior/posts           | SeniorController@posts           |

#### 管理员

| 模块                               | 路由URL                    | 路由目的函数                     |
| ---------------------------------- | -------------------------- | -------------------------------- |
| 管理员-首页                        | /admin/index               | AdminController@index            |
| 管理员-个人信息                    | /admin/personalInfo        | AdminController@info             |
| 管理员-学校信息录入                | /admin/manageSchoolInfo    | AdminController@manageSchoolInfo |
| 管理员-新生管理                    | /admin/manageNewsInfo      | AdminController@manageNewsInfo   |
| 管理员-管理员管理                  | /admin/manageAdminInfo     | AdminController@manageAdminInfo  |
| 管理员新建通知存储                 | POST /admin/storePost      | ImportController@storePost       |
| 管理员-通知管理-通知详情           | /admin/posts/{postId}      | PostController@show              |
| 管理员-通知管理-通知编辑           | /admin/posts/edit/{postId} | PostController@edit              |
| 管理员-通知管理-查看通知并发布通知 | /admin/posts/create        | PostController@create            |
| 管理员-到站信息                    | /admin/nav                 | NavController@index              |
| 管理员-问卷系统（问卷列表）        | /admin/survey              | SurveyController@index           |
| 管理员-问卷系统-编辑问卷           | /admin/survey/{surveyId}   | SurveyController@show            |
| 管理员-报到流程-报到说明（编辑）   | /admin/reportInfo          | ReportController@reportInfo      |
| 管理员-报到流程-开始报到（编辑）   | /admin/reportGuide         | ReportController@reportGuide     |
| 管理员-迎新核验                    | /admin/reportCheck         | ReportController@reportCheck     |

| 模块                             | 路由URL                    | 路由目的函数                                         |
| -------------------------------- | -------------------------- | ---------------------------------------------------- |
|新生信息上传|/admin/stuInfoUpload|ImportController@studentExcelImport|
|院系信息上传|/admin/majorInfoUpload|ImportController@majorExcelImport|
|学校信息提交|/admin/schoolInfoPost|ImportController@schoolInfoPost|

注：

- 以上路由安排尚不完善，后期依照需要调整；
- 期望将新生/在校生业务使用同一套逻辑，添加的字段可以区分；
- 完之后感觉路由具体起什么名其实用处不大，/stu/和/admin/没什么作用；
- 个人感觉路由是用来起控制作用的，通过将路由与控制器绑定，在控制器和中间件里通过路由重定向来实现功能间的组合；