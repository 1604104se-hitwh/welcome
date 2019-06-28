<!DOCTYPE html>
<html lang="zh">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>迎新系统-哈尔滨工业大学（威海）</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.7.2/css/all.min.css"
          integrity="sha256-nAmazAk6vS34Xqo0BSrTb+abbtFlgsFK7NKSi6o7Y78=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    <!-- Smallpop -->
    <link href="https://cdn.jsdelivr.net/gh/RioHsc/Smallpop/dist/spop.min.css" rel="stylesheet">
    <link href="{{asset('css/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <style>
        #mapContainer {
            width: 500px;
            height: 200px;
        }
    </style>

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
            <a class="nav-link" href="{{url('/admin/index')}}">
                <i class="fas fa-fw fa-home"></i>
                <span>首页</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            信息管理
        </div>

        <!-- Nav Item - Information set -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInfo"
               aria-expanded="true" aria-controls="collapseInfo">
                <i class="fas fa-fw fa-laptop"></i>
                <span>信息管理</span>
            </a>
            <div id="collapseInfo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">你可以管理：</h6>
                    <a class="collapse-item" href="{{url('/admin/manageSchoolInfo')}}">学校信息</a>
                    <a class="collapse-item" href="{{url('/admin/manageNewsInfo')}}">新生信息</a>
                    <a class="collapse-item" href="{{url('/admin/manageAdminInfo')}}">管理员信息</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - self info -->
        <li class="nav-item">
            <a class="nav-link" href="{{url($toInformationURL)}}">
                <i class="fas fa-fw fa-info"></i>
                <span>个人信息</span>
            </a>
        </li>

        <!-- Nav Item - Arrived -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/navManage')}}">
                <i class="fas fa-fw fa-plane-arrival"></i>
                <span>到站信息</span>
            </a>
        </li>

        <!-- Nav Item - greenPath info -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/greenPathVerify')}}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>绿色通道</span>
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
            <a class="nav-link" href="{{url('/admin/posts/create')}}">
                <i class="fas fa-fw fa-bell"></i>
                <span>发布通知</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            迎新服务
        </div>

        <!-- Nav Item - welcome -->
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWel"
               aria-expanded="true" aria-controls="collapseWel">
                <i class="fas fa-fw fa-route"></i>
                <span>报到流程</span>
            </a>
            <div id="collapseWel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">你可以：</h6>
                    <a class="collapse-item active" href="{{url('/admin/reportInfo')}}">报到信息</a>
                    <a class="collapse-item" href="{{url('/admin/reportCheck')}}">迎新核验</a>
                </div>
            </div>
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

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">您好，{{$user}}</span>
                            <img class="img-profile rounded-circle"
                                 src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
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
                    <h1 class="h3 mb-0 text-gray-800">报到信息</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Infomation Card ID number -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">新生人数
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$newStuNumber}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-luggage-cart fa-2x text-gray-300"></i>
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
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">在校生人数
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$oldStuNumber}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
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

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">报到信息</h6>
                    </div>
                    <div class="card-body">
                        <div id="reportInfoEditor" class="mb-4">
                            {!! $reportInfo !!}
                        </div>
                        <button type="button" class="btn btn-primary" id="submitReportInfo">提交</button>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <h6 class="m-auto font-weight-bold text-primary align-content-center col-6">报到流程</h6>
                            <div class="m-auto text-right col-6">
                                <button type="button" id="addNewItem" class="btn btn-primary btn-sm m-0">
                                    <i class="fas fa-plus"></i>
                                    添加新项目
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>流程</th>
                                <th>标题</th>
                                <th>选项</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($reportInfoLists)==0)
                                <tr role="row">
                                    <td colspan="3">还没有流程</td>
                                </tr>
                            @else @foreach($reportInfoLists as $reportInfoList)
                                <tr>
                                    <td scope="row">{{$reportInfoList->enrl_rank}}</td>
                                    <td>{{$reportInfoList->enrl_title}}</td>
                                    <td>
                                        <button type="button" class="m-1 btn btn-info btn-sm modifyPost"
                                                data-target="{{$reportInfoList->id}}">修改
                                        </button>
                                        <button type="button" class="m-1 btn btn-danger btn-sm deletePost"
                                                data-target="{{$reportInfoList->id}}">删除
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="form-group ml-4">
                                <label for="reportDate">报到日期</label>
                                <input class="form-control form_datetime" id="reportDate"
                                       type="text" value="{{$reportData}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-check abc-checkbox abc-checkbox-info abc-checkbox-circle pb-2 pl-2">
                            <input type="checkbox" class="form-check-input" id="beginReport" {{$check?"checked":""}}>
                            <label class="form-check-label" for="beginReport">开始迎新核验</label>
                        </div>

                        <button type="button" id="saveConfig" class="btn btn-primary">保存配置</button>
                    </div>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
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

<!-- Add report step Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalTitle" data-type="modify">修改流程信息</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3">
                    <input type="text" class="form-control" name="post_title" id="postTitle" placeholder="输入流程标题"
                           required>
                </div>
                <div id="postModifyEditor" class="mb-4">
                </div>
                <label for="positionDiv">确定地点</label>
                <div class="row m-0" id="positionDiv">
                    <div id="mapContainer"></div>
                    <div class="ml-5">
                        <div class="form-group">
                            <label for="x-dig">经度</label>
                            <input type="text" class="form-control" id="x-dig" readonly>
                        </div>
                        <div class="form-group">
                            <label for="y-dig">纬度</label>
                            <input type="text" class="form-control" id="y-dig" readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="saveInfoBtn">保存</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"
        integrity="sha256-H3cjtrm/ztDeuhCN9I4yh4iN2Ybx/y1RM7rMmAesA0k=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.js"
        integrity="sha256-pVreZ67fRaATygHF6T+gQtF1NI700W9kzeAivu6au9U=" crossorigin="anonymous"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<!-- Smallpop -->
<script src="https://cdn.jsdelivr.net/gh/RioHsc/Smallpop/dist/spop.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.0/dist/sweetalert2.all.min.js"
        integrity="sha256-wWhZbmmAXb1JDP1U+ywgt4FHA4XIxzcYyGEFnInYJMQ=" crossorigin="anonymous"></script>



<!-- Custom scripts for Editor -->
<script type="text/javascript" src="https://unpkg.com/wangeditor/release/wangEditor.min.js"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.zh-CN.js')}}"></script>
<script type="text/javascript">
    var E = window.wangEditor;
    var editor1 = new E('#reportInfoEditor');
    editor1.customConfig.uploadImgShowBase64 = true;
    editor1.customConfig.zIndex = 1;
    editor1.create();
    var editor2 = new E('#postModifyEditor');
    editor2.customConfig.uploadImgShowBase64 = true;
    editor2.customConfig.zIndex = 1;
    editor2.create();
</script>

<!--异步加载 高德地图JSAPI ，注意 callback 参数-->
<script src="https://webapi.amap.com/maps?v=1.4.13&key=0a4d80176be0dde936743e7e03a5f237&callback=my_init"></script>

<!--引入UI组件库异步版本main-async.js（1.0版本） -->
<script src="https://webapi.amap.com/ui/1.0/main-async.js"></script>

<script type="text/javascript">
    //JSAPI回调入口
    var positionPicker;
    var AMapUIProtocol = 'https:';
    var map = new AMap.Map('mapContainer', {
        zoom: 15,
        center: [122.083553, 37.533764],
    });

    function my_init() {
        initAMapUI();
        //加载PositionPicker，loadUI的路径参数为模块名中 'ui/' 之后的部分
        AMapUI.loadUI(['misc/PositionPicker'], function (PositionPicker) {
            positionPicker = new PositionPicker({
                mode: 'dragMap',//设定为拖拽地图模式，可选'dragMap'、'dragMarker'，默认为'dragMap'
                map: map//依赖地图对象
            });

            positionPicker.on('success', function (positionResult) {
                $('#x-dig').val(positionResult.position.lng);
                $('#y-dig').val(positionResult.position.lat)
            });
            positionPicker.on('fail', function (positionResult) {
                // 海上或海外无法获得地址信息
                console.log('fail');
            });
            positionPicker.start();
        });

    }
</script>

<!-- Data Picker -->
<script>
    $('.form_datetime').datetimepicker({
        format: "mm月dd日",
        language:"zh-CN",
        todayBtn: "linked",
        todayHighlight: true,
        minView: "month",
        maxView: "year",
        forceParse: 0,
    });
</script>

<!-- ajax post -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submitReportInfo').click(function () {
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($reportInfoPostURL)}}",
            data: {"reportInfo": editor1.txt.html()},

            success: function (data) {
                if (data.code === 200) {
                    spop({
                        template: "<h4>成功保存</h4>" +
                            "<p>信息已经更新，刷新页面就可以看到啦</p>",
                        style: 'success',
                        autoclose: 5000,
                        position: 'bottom-right',
                        icon: true,
                        group: "submitReportInfo",
                    });
                } else {
                    spop({
                        template: "<h4>保存失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "submitReportInfo",
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
                    template: "保存失败（" + XMLHttpRequest.status + "）",
                    style: 'error',
                    autoclose: false,
                    position: 'bottom-right',
                    icon: true,
                    group: "submitReportInfo",
                });
            }
        });
    });

    // 添加新的项目
    $('#addNewItem').click(function () {
        // 初始化
        let title = $('#modifyModalTitle');
        title.text('添加新的流程');
        title.data('type', 'create');
        $('#postTitle').val('');
        editor2.txt.clear();
        positionPicker.start([122.083553, 37.533764]);
        $('#modifyModal').modal('show');
    });

    // 修改项目
    let modifyID = 0;
    $('.modifyPost').click(function () {
        let title = $('#modifyModalTitle');
        title.text('修改流程');
        title.data('type', 'modify');
        modifyID = $(this).data('target');
        // 请求以前内容
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($getReportInfoURL)}}",
            data: {"target": modifyID},

            success: function (data) {
                if (data.code === 200) {
                    let position = JSON.parse(data.data.enrl_location);
                    $('#postTitle').val(data.data.enrl_title);
                    editor2.txt.html(data.data.enrl_info);
                    var pos = new AMap.LngLat(position[0], position[1]);
                    map.setCenter(pos);
                } else {
                    spop({
                        template: "<h4>请求失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "modifyInfo",
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
                    group: "modifyInfo",
                });
            }
        });
        $('#modifyModal').modal('show');
    });

    // 确认修改
    $('#saveInfoBtn').click(function () {
        let type = $('#modifyModalTitle').data('type');
        let title = $('#postTitle').val();
        let info = editor2.txt.text();
        let location = JSON.stringify([parseFloat($('#x-dig').val()), parseFloat($('#y-dig').val())]);
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($saveInfoURL)}}",
            data: {
                "type": type,
                "target": modifyID,
                "title": title,
                "info": info,
                "location": location
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#modifyModal').modal('hide');
                    spop({
                        template: "<h4>成功保存</h4>" +
                            "<p>信息已经更新，刷新页面就可以看到啦</p>",
                        style: 'success',
                        autoclose: 5000,
                        position: 'bottom-right',
                        icon: true,
                        group: "saveInfo",
                    });
                } else {
                    spop({
                        template: "<h4>保存失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "saveInfo",
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
                    group: "saveInfo",
                });
            }
        });
    });

    // 删除项目
    $('.deletePost').click(function () {
        var thisTable = $(this);
        Swal.fire({
            title: '确定要删除吗',
            text: "你将要删除流程\" " + $(this).parent().parent().find('td:eq(1)').text() + " \"",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "确定删除",
            cancelButtonText: "取消",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    async: true,   		//是否为异步请求
                    cache: false,  		//是否缓存结果
                    type: "POST", 		//请求方式
                    dataType: "jsonp", 	//服务器返回的数据是什么类型
                    url: "{{url($deleteReportInfoURL)}}",
                    data: {"deleteID": $(this).data("target")},

                    success: function (data) {
                        if (data.code === 200) {
                            Swal.fire(
                                '成功删除',
                                '已经被成功删除',
                                'success'
                            );
                            thisTable.parent().parent().remove();
                        } else {
                            Swal.fire(
                                '提交失败（' + data.code + '）',
                                data.data,
                                'warning'
                            );
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        // 状态码
                        console.log("status:" + XMLHttpRequest.status + "\n");
                        // 状态
                        console.log("readyState:" + XMLHttpRequest.readyState + "\n");
                        // 错误信息
                        console.log("textStatus:" + textStatus + "\n");
                        Swal.fire(
                            '提交失败（' + XMLHttpRequest.status + '）',
                            textStatus,
                            'error'
                        );
                    }
                });
            }
        })
    });

    // 保存配置
    $('#saveConfig').click(function () {
        let data = $('#reportDate').val();
        let beginCheck = $('#beginReport').prop('checked');
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($saveEnrollConfig)}}",
            data: {
                "reportDate": data,
                "beginReport": beginCheck,
            },
            success: function (data) {
                if (data.code === 200) {
                    $('#modifyModal').modal('hide');
                    spop({
                        template: "<h4>成功保存</h4>" +
                            "<p>信息已经更新，刷新页面就可以看到啦</p>",
                        style: 'success',
                        autoclose: 5000,
                        position: 'bottom-right',
                        icon: true,
                        group: "saveInfo",
                    });
                } else {
                    spop({
                        template: "<h4>保存失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "saveInfo",
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
                    group: "saveInfo",
                });
            }
        });
    });

</script>
</body>

</html>