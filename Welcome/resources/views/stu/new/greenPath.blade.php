<!DOCTYPE html>
<html lang="zh">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>迎新系统-哈尔滨工业大学（威海）</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.7.2/css/all.min.css"
          integrity="sha256-nAmazAk6vS34Xqo0BSrTb+abbtFlgsFK7NKSi6o7Y78="
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.3/css/fileinput.min.css"
          integrity="sha256-wB5fOxF9Sm0mGhft46OVh4gehcDAzvpNFIZUmCHZzSo=" crossorigin="anonymous">

    <!-- Smallpop -->
    <link href="https://cdn.jsdelivr.net/gh/RioHsc/Smallpop/dist/spop.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">迎新系统 <sup id="user-type">{{$sysType}}</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('/stu')}}">
                <i class="fas fa-fw fa-home"></i>
                <span>首页</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            信息查询
        </div>

        <!-- Nav Item - Information Query -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInfo"
               aria-expanded="true" aria-controls="collapseInfo">
                <i class="fas fa-fw fa-laptop"></i>
                <span>信息查询</span>
            </a>
            <div id="collapseInfo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">你可以查看：</h6>
                    <a class="collapse-item" href="{{url('/stu/queryClass')}}">你的班级</a>
                    <a class="collapse-item" href="{{url('/stu/queryDorm')}}">你的宿舍</a>
                    <a class="collapse-item" href="{{url('/stu/queryCountryFolk')}}">你的老乡</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Arrived -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('/stu/nav')}}">
                <i class="fas fa-fw fa-plane-arrival"></i>
                <span>到站信息</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            通知服务
        </div>

        <!-- Nav Item - Notice -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('/stu/posts')}}">
                <i class="fas fa-fw fa-bell"></i>
                <span>所有通知</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            迎新服务
        </div>

        <!-- Nav Item - welcome -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWel"
               aria-expanded="true" aria-controls="collapseWel">
                <i class="fas fa-fw fa-route"></i>
                <span>报到流程</span>
            </a>
            <div id="collapseWel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">你可以查看：</h6>
                    <a class="collapse-item" href="{{url('/stu/enrollInfo')}}">报到说明</a>
                    <a class="collapse-item" href="{{url('/stu/enrollGuide')}}">开始报到</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Heading -->
        <div class="sidebar-heading">
            信息填报
        </div>

        <!-- Nav Item - selfInfo -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('/stu/personalInfo')}}">
                <i class="fas fa-fw fa-info"></i>
                <span>个人信息</span></a>
        </li>

        <!-- Nav Item - GreenPath -->
        <li class="nav-item active">
            <a class="nav-link" href="{{url('/stu/greenPath')}}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>绿色通道</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            @if($messages['unreadNum'] > 0)
                                <span class="badge badge-danger badge-counter">{{$messages['unreadNum']}}</span>
                            @endif
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                消息中心
                            </h6>
                            @if(count($messages['showMessage'])!=0) @foreach ($messages['showMessage'] as $message)
                                <a class="dropdown-item d-flex align-items-center" href="{{url($message['toURL'])}}">
                                    <div @if ($message['readed'] == false) class="font-weight-bold" @endif>
                                        <div class="text-truncate">{{$message['title']}}</div>
                                        <div class="small text-gray-500">{{$message['context']}}</div>
                                    </div>
                                </a>
                            @endforeach
                            @else
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div>
                                        <div class="text-truncate">暂时没有消息哦~</div>
                                    </div>
                                </a>
                            @endif
                            <a class="dropdown-item text-center small text-gray-500"
                               href="{{url($messages['moreInfoUrl'])}}">更多信息...</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">您好，{{$user}}</span>
                            <img class="img-profile rounded-circle"
                                 src="{{url($userImg)}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{url($toInformationURL)}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> 个人信息
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> 登出
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">绿色通道</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Infomation Card ID number -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">您的学号
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stuID}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-id-card fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Infomation Card shcool -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">所在院系
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stuDept}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Infomation Card department -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">宿舍</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    {{$stuDormitory}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Infomation Card report time -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">报到时间
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stuReportTime}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">“绿色通道”申请说明</h4>
                        <hr />
                        <p>如果同学需要申请困难补助，请核对以下个人信息并且上传<b>家庭情况调查表</b>以及其他证明材料。</p>
                        <p>个人信息有误请到<a href="{{url("/stu/personalInfo")}}">个人信息</a>页面修改。</p>
                    </div>
                    <div class="card border-left-warning mb-2 mt-2">
                        <div class="row p-2">
                            <div class="m-auto col-6">
                                <i class="fas fa-fw fa-columns"></i> 个人信息确认
                            </div>
                            <div class="m-auto col-6 text-right">
                                <a href="{{url('stu/personalInfo')}}" target="_blank"
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit fa-columns"></i>
                                    修改信息
                                </a>
                            </div>
                        </div>

                    </div>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>姓名</th>
                            <td>{{$stuInfo->name}}</td>
                            <th>学号</th>
                            <td>{{$stuInfo->schoolID}}</td>
                            <th>性别</th>
                            <td>{{$stuInfo->gender}}</td>
                        </tr>
                        <tr>
                            <th>身份证</th>
                            <td colspan="2">{{$stuInfo->cid}}</td>
                            <th>政治面貌</th>
                            <td colspan="2">{{$stuInfo->party}}</td>
                        </tr>
                        <tr>
                            <th>学院</th>
                            <td>{{$stuInfo->dept}}</td>
                            <th>专业</th>
                            <td>{{$stuInfo->major}}</td>
                            <th>民族</th>
                            <td>{{$stuInfo->nation}}</td>
                        </tr>
                        <tr>
                            <th>家庭住址</th>
                            <td colspan="5">
                                {{$stuInfo->homeLocation}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card border-left-warning mb-2 mt-2">
                    <div class="p-2">
                        <i class="fas fa-fw fa-comment"></i> 审核结果
                    </div>
                </div>
                <div class="card">
                    <div class="card-header
                    @if($verifyResultbool===1)
                        bg-success text-white
                    @elseif($verifyResultbool===2)
                        bg-warning text-white
                    @endif
                    ">
                        {{$verifyResult}}
                    </div>
                    <div class="card-body">
                        {{$verifyReason}}
                    </div>
                </div>
                <div class="card border-left-warning mb-2 mt-2">
                    <div class="p-2">
                        <i class="fas fa-fw fa-cloud-upload-alt"></i> 申请材料上传
                        @if($verifyResultbool === 1)
                            <span class="text-danger">已通过审核，材料上传通道关闭</span>
                        @endif
                    </div>
                </div>
                <div class="file-loading">
                    <input id="input-files" name="input-files[]" type="file" multiple>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Harbin Institute of Technology , Weihai</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">确认退出？</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">选择“退出”退出登录</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                <a class="btn btn-primary" href="{{url($toLogoutURL)}}">退出</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.js"
        integrity="sha256-pVreZ67fRaATygHF6T+gQtF1NI700W9kzeAivu6au9U="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"
        integrity="sha256-H3cjtrm/ztDeuhCN9I4yh4iN2Ybx/y1RM7rMmAesA0k=" crossorigin="anonymous"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<!-- Smallpop -->
<script src="https://cdn.jsdelivr.net/gh/RioHsc/Smallpop/dist/spop.min.js"></script>

<!-- bootstrap-fileinput -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.3/js/fileinput.min.js"
        integrity="sha256-MDfQRKo8050L0tbYEInUuY0IRR1rQ7yFCZg7DI1hDgk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.3/themes/fas/theme.min.js"
        integrity="sha256-D1oLj4NNXxgt0/xo2KLOX6YQ0dO/KWI4+lDy0oxsj4k=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput@5.0.3/js/locales/zh.js"
        integrity="sha256-CSMmMd7U2z4bweRFWMhz0qwzPVoNADZvKzlHbZPBBK4=" crossorigin="anonymous"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(document).ready(function () {
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url('/stu/greenPath/getGreenPathFiles')}}",
            success: function (data) {
                if (data.code === 200) {
                    let initialPreview = new Array();
                    let initialPreviewConfig = new Array();
                    let datas = $.parseJSON(data.data);
                    $.each(datas,function (index,val) {
                        let image = ['jpg','jpeg','png','gif'];
                        let text = ['txt','ini','csv','java','php','js','css'];
                        let type = (val.type==='pdf')?'pdf':
                            ($.inArray(val.type,image)!==-1)?'image':
                            ($.inArray(val.type,text)!==-1)?'text':'object';
                        console.log(type)
                        initialPreviewConfig.push({
                            caption: val.name,
                            url: '{{url('stu/greenPath/delete')}}',
                            key: val.md5,
                            size:val.size,
                            downloadUrl: '{{url('/')}}'+'/'+val.file,
                            type: type
                        });
                        initialPreview.push('{{url('/')}}'+'/'+val.file);
                    });
                    initUploader(initialPreview,initialPreviewConfig);
                } else if(data.code === 404){
                    initUploader();
                }else {
                    spop({
                        template: "<h4>获取失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "getFiles",
                    });
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                // 状态码
                console.log("status:" + XMLHttpRequest.status + "\n");
                // 状态
                console.log("readyState:" + XMLHttpRequest.readyState + "\n");
                // 错误信息
                console.log("textStatus:" + textStatus + "\n");
                spop({
                    template: "请求失败（" + XMLHttpRequest.status + "）",
                    style: 'error',
                    autoclose: false,
                    position: 'bottom-right',
                    icon: true,
                    group: "getFiles",
                });
            }
        });
    });

    function initUploader(initialPreview,initialPreviewConfig) {
        $("#input-files").fileinput({
            language: "zh",
            theme: "fas",
            uploadUrl: "{{url('/stu/uploadGreenPathFiles')}}",
            allowedFileExtensions: ['pdf', 'doc', 'docx','zip','rar','tar','gzip','gz','7z','jpg','jpeg','png'],   //接收的文件后缀
            initialPreviewAsData: true,
            overwriteInitial: false,
            maxFileCount: 5,
            maxFileSize:10000,          //单位为kb，如果为0表示不限制文件大小
            preferIconicPreview: true,
            enctype: "multipart/form-data",
            initialPreview:initialPreview,
            initialPreviewConfig:initialPreviewConfig,
            previewFileIconSettings: {  // configure your icon file extensions
                'doc': '<i class="fas fa-file-word text-primary"></i>',
                'xls': '<i class="fas fa-file-excel text-success"></i>',
                'ppt': '<i class="fas fa-file-powerpoint text-danger"></i>',
                'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
                'zip': '<i class="fas fa-file-archive text-muted"></i>',
                'htm': '<i class="fas fa-file-code text-info"></i>',
                'txt': '<i class="fas fa-file-alt text-info"></i>',
                'mov': '<i class="fas fa-file-video text-warning"></i>',
                'mp3': '<i class="fas fa-file-audio text-warning"></i>',
                // note for these file types below no extension determination logic
                // has been configured (the keys itself will be used as extensions)
                'jpg': '<i class="fas fa-file-image text-danger"></i>',
                'gif': '<i class="fas fa-file-image text-muted"></i>',
                'png': '<i class="fas fa-file-image text-primary"></i>'
            },
            previewFileExtSettings: { // configure the logic for determining icon file extensions
                'doc': function(ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'xls': function(ext) {
                    return ext.match(/(xls|xlsx)$/i);
                },
                'ppt': function(ext) {
                    return ext.match(/(ppt|pptx)$/i);
                },
                'zip': function(ext) {
                    return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                },
                'htm': function(ext) {
                    return ext.match(/(htm|html)$/i);
                },
                'txt': function(ext) {
                    return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                },
                'mov': function(ext) {
                    return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                },
                'mp3': function(ext) {
                    return ext.match(/(mp3|wav)$/i);
                },
                'jpg': function (ext) {
                    return ext.match(/(jpg|jpeg)$/i);
                }
            },
        }).on("filepredelete", function(jqXHR) {
            var abort = true;
            if (confirm("确定删除吗？")) {
                abort = false;
            }
            return abort;
        }).fileinput('{{($verifyResultbool === 1)?"disable":"enable"}}');
    }

</script>

</body>
</html>