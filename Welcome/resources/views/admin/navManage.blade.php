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
        <li class="nav-item active">
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
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWel"
               aria-expanded="true" aria-controls="collapseWel">
                <i class="fas fa-fw fa-route"></i>
                <span>报到流程</span>
            </a>
            <div id="collapseWel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">你可以：</h6>
                    <a class="collapse-item" href="{{url('/admin/reportInfo')}}">报到信息</a>
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
                    <h1 class="h3 mb-0 text-gray-800">到站信息管理</h1>
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
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">预约人数
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$reserveStuNumber}}</div>
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

                    <!-- Infomation Card port number -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">站点个数
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$portNumber}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <h6 class="m-auto font-weight-bold text-primary align-content-center col-6">站点信息</h6>
                            <div class="m-auto text-right col-6">
                                <button type="button" id="addNewItem" class="btn btn-primary btn-sm m-0">
                                    <i class="fas fa-plus"></i>
                                    添加新站点
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>站点名称</th>
                                <th>可预约时段</th>
                                <th>选项</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($portInfoLists) === 0)
                                <tr role="row">
                                    <td colspan="3">还没有站点</td>
                                </tr>
                            @else @foreach($portInfoLists as $portInfoList)
                                <tr>
                                    <td scope="row">{{$portInfoList->portName}}</td>
                                    <td>{{$portInfoList->setReserveTime}}个</td>
                                    <td>
                                        <button type="button" class="m-0 ml-1 btn btn-info btn-sm modifyPost"
                                                data-target="{{$portInfoList->id}}">修改
                                        </button>
                                        <button type="button" class="m-0 ml-1 btn btn-danger btn-sm deletePost"
                                                data-target="{{$portInfoList->id}}">删除
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <h6 class="m-auto font-weight-bold text-primary align-content-center col-6">预约信息</h6>
                            <div class="m-auto text-right col-6">
                                <button type="button" id="exportInfo" class="btn btn-primary btn-sm m-0">
                                    <i class="fas fa-file-export"></i>
                                    导出预约信息
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($reservationLists) === 0)
                        <div class="alert alert-primary">
                            没有站点
                        </div>
                        @else
                        <div class="table-responsive">
                            @for($i=0; $i<count($reservationLists) / 3; ++$i)
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    @for($j=$i*3; $j<count($reservationLists)
                                    && $j<$i*3 +3; ++$j)
                                    <th colspan="2">{{$reservationLists[$j]->portName}}</th>
                                    @endfor
                                </tr>
                                <tr>
                                    @for($j=$i*3; $j<count($reservationLists)
                                    && $j<$i*3 +3; ++$j)
                                    <th>预约时间</th>
                                    <th>预约人数</th>
                                    @endfor
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    // 计算$max
                                    $first = ($i*3 < count($reservationLists))? 
                                        max(count($reservationLists[$i*3]->time),
                                            count($reservationLists[$i*3]->stuNumber)):0;
                                    $second = ($i*3+ 1 < count($reservationLists))? 
                                        max(count($reservationLists[$i*3+ 1]->time),
                                            count($reservationLists[$i*3+ 1]->stuNumber)):0;
                                    $third = ($i*3+ 2 < count($reservationLists))? 
                                        max(count($reservationLists[$i*3+ 2]->time),
                                            count($reservationLists[$i*3+ 2]->stuNumber)):0;
                                    $max = max($first,$second,$third);
                                @endphp
                                @for($k=0; $k<$max; ++$k)
                                <tr>
                                    @for($j=$i*3; $j<count($reservationLists)
                                    && $j<$i*3 +3; ++$j)
                                    <td>
                                        @if(count($reservationLists[$j]->time) > $k)
                                        {{$reservationLists[$j]->time[$k]}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($reservationLists[$j]->stuNumber) > $k)
                                        {{$reservationLists[$j]->stuNumber[$k]}}
                                        @endif
                                    </td>
                                    @endfor
                                </tr>
                                @endfor
                                </tbody>
                            </table>
                            @endfor
                        </div>
                        @endif
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

<!-- Add/Modify port Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalTitle" data-type="modify">修改站点信息</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3">
                    <input type="text" class="form-control" name="post_title" id="postTitle" placeholder="输入站点名称"
                           required>
                </div>
                <div id="postModifyEditor" class="mb-4">
                </div>
                <label for="selectTime">可选时间</label>
                <div class="border-primary">
                    <div id="selectTime">

                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm"
                                id="modifyTime" data-target="">修改时间信息</button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="saveInfoBtn" data-target="">保存</button>
            </div>
        </div>
    </div>
</div>

<!-- Add/Modify time Modal -->
<div class="modal fade" id="timeModifyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="timeModifyModalTitle" data-type="modify">修改可选时间</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="selectTime">已选择时间</label>
                    <div class="border-primary">
                        <div id="selectedTime">

                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="addTime">添加时间</label>
                    <div class="input-group">
                        <input type="text" id="addTime" class="form-control form_datetime">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" id="addTimeBtn" type="button">选中</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="saveTimeBtn" data-target="">保存</button>
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
<script type="text/javascript">
    var E = window.wangEditor;
    var editor = new E('#postModifyEditor');
    editor.customConfig.uploadImgShowBase64 = true;
    editor.customConfig.zIndex = 1;
    editor.create();
</script>


<!-- Data Picker -->
<script>
    $('.form_datetime').datetimepicker({
        format: "mm月dd日 hh:ii",
        todayBtn: "linked",
        todayHighlight: true,
        forceParse: 0,
    });

    Date.prototype.Format = function (fmt) {
        var o = {
            "M+": this.getMonth() + 1,      //月份
            "d+": this.getDate(),           //日
            "H+": this.getHours(),          //小时
            "m+": this.getMinutes(),        //分
            "s+": this.getSeconds(),        //秒
        };
        if (/(y+)/.test(fmt)) fmt =
            fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt =
                fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ?
                    (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    }

    /**
     * 日期 转换为 Unix时间戳
     * @param <string> 01月01日 20:20:20  日期格式
     * @return <int>        unix时间戳(秒)
     */
    function DateToUnix (string) {
        let f = string.split(' ', 2);
        let d = (f[0] ? f[0] : '').split(/[月日]/, 2);
        let t = (f[1] ? f[1] : '').split(':', 3);
        return (new Date(
            new Date().getFullYear(),
            (parseInt(d[0], 10) || 1) - 1,
            parseInt(d[1], 10) || null,
            parseInt(t[0], 10) || null,
            parseInt(t[1], 10) || null,
            parseInt(t[2], 10) || null
        )).getTime() / 1000;
    }
</script>

<!-- ajax post -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // 添加新的项目
    $('#addNewItem').click(function () {
        // 初始化
        let title = $('#modifyModalTitle');
        title.text('添加新的站点');
        title.data('type', 'create');
        $('#postTitle').val('');
        editor.txt.clear();
        $("#selectTime").html("还没有设置");
        $('#modifyModal').modal('show');
    });

    // 修改项目
    $('.modifyPost').click(function () {
        let title = $('#modifyModalTitle');
        title.text('修改站点信息');
        title.data('type', 'modify');
        let modifyID = $(this).data('target');
        $("#saveInfoBtn").data('target',modifyID);
        $("#modifyTime").data('target',modifyID);
        // 请求以前内容
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($getNavInfoURL)}}",
            data: {"target": modifyID},

            success: function (data) {
                if (data.code === 200) {
                    let times = "";
                    let timeM = "";
                    $.each($.parseJSON(data.data.shtl_time),function (index,val) {
                        times+="<span class=\"badge badge-primary mr-1\"" +
                            " data-timestamp=\""+val+"\">" +
                            (new Date(val*1000)).Format("MM月dd日 HH:mm")+"</span>";
                    });
                    $("#selectTime").html(times===""?"暂无时间段":times);
                    $('#postTitle').val(data.data.port_name);
                    editor.txt.html(data.data.port_info);
                    $('#modifyModal').modal('show');
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
    });

    // 确认修改
    $('#saveInfoBtn').click(function () {
        let target = $(this).data('target');
        let type = $('#modifyModalTitle').data('type');
        let title = $('#postTitle').val();
        let info = editor.txt.html();
        // 获取时间戳
        let timestamps = [];
        $.each($('#selectTime span'),function (index,val) {
            timestamps.push(parseInt($(this).data('timestamp')));
        });
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($saveInfoURL)}}",
            data: {
                "type": type,
                "target": target,
                "title": title,
                "info": info,
                "timestamps":timestamps,
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
            text: "你将要删除站点\" " + $(this).parent().parent().find('td:eq(0)').text() + " \"",
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
                    url: "{{url($deletePortInfoURL)}}",
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

    // 修改时间
    $('#modifyTime').click(function () {
        let id = $(this).data('target');
        $('#saveTimeBtn').data('target',id);
        let timeM = "";
        $.each($('#selectTime span'),function (index,val) {
            let vals = $(this).data('timestamp');
            timeM+="<a href=\"javascript:void(0);\" class=\"badge badge-primary mr-1\"" +
                " data-timestamp=\""+vals+"\">"+(new Date(vals*1000)).Format("MM月dd日 HH:mm") +
                " <i class=\"fas fa-times\"></i></a>";
        });
        $("#selectedTime").html(timeM);
        $('#timeModifyModal').modal('show');
    });

    // 保存时间信息
    $('#saveTimeBtn').click(function () {
        let timestamps = [];
        let times = "";
        $.each($('#selectedTime a'),function (index,val) {
            let vals = $(this).data('timestamp');
            times+="<span class=\"badge badge-primary mr-1\" data-timestamp=\"" +
                vals +"\">" + (new Date(vals*1000)).Format("MM月dd日 HH:mm")+"</span>";
            timestamps.push($(this).data('timestamp'));
        });
        $("#selectTime").html(times===""?"暂无时间段":times);
        $('#timeModifyModal').modal('hide');
    });

    // 点击时间删除
    $("#selectedTime").on("click","a",function () {
        $(this).remove();
    });

    // 添加时间
    $("#addTimeBtn").click(function () {
        let time = $.trim($("#addTime").val());
        if(time==="") return;
        let timeM = "<a href=\"javascript:void(0);\" class=\"badge badge-primary mr-1\"" +
            " data-timestamp=\""+DateToUnix(time)+"\">"+time +
            " <i class=\"fas fa-times\"></i></a>";
        $("#selectedTime").append(timeM);
    });
    
    $("#exportInfo").click(function () {
        window.open("{{url('/admin/navExcel')}}");
    });

</script>
</body>

</html>