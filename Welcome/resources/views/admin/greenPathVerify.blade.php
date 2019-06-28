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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.8.1/css/all.min.css"
          integrity="sha256-7rF6RaSKyh16288E3hVdzQtHyzatA2MQRGu0cf6pqqM=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="{{asset('css/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">

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
        <li class="nav-item active">
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
                    <h1 class="h3 mb-0 text-gray-800">“绿色通道”审核</h1>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">申请人数
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$applyTotal}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">未审核人数
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$needVerify}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">全部申请信息</h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr role="row">
                                <th>姓名</th>
                                <th>专业</th>
                                <th>审核状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($greenPathLists)==0)
                                <tr role="row">
                                    <td colspan="4">还没有人员申请</td>
                                </tr>
                            @else @foreach($greenPathLists as $greenPathList)
                                <tr role="row">
                                    <td>{{$greenPathList->name}}</td>
                                    <td>{{$greenPathList->major}}</td>
                                    <td>{{$greenPathList->verify}}</td>
                                    <td>
                                        <button type="button" class="m-1 btn btn-info btn-sm watchInfo"
                                                data-target="{{strval($greenPathList->id)}}">查看信息
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                        {{ $greenPathLists->links() }}
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

<!-- InformationModal Modal-->
<div class="modal fade" id="informationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">提交信息</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card border-left-primary mb-2 mt-2">
                    <div class="p-2 text-gray-700">
                        <i class="fas fa-fw fa-columns"></i> 个人信息
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>姓名</th>
                        <td id="name"></td>
                        <th>学号</th>
                        <td id="schoolID"></td>
                        <th>性别</th>
                        <td id="gender"></td>
                    </tr>
                    <tr>
                        <th>身份证</th>
                        <td id="cid" colspan="2"></td>
                        <th>政治面貌</th>
                        <td id="party" colspan="2"></td>
                    </tr>
                    <tr>
                        <th>学院</th>
                        <td id="dept"></td>
                        <th>专业</th>
                        <td id="major"></td>
                        <th>民族</th>
                        <td id="nation"></td>
                    </tr>
                    <tr>
                        <th>家庭住址</th>
                        <td id="homeLocation" colspan="5"></td>
                    </tr>
                    </tbody>
                </table>

                <div class="card border-left-primary mb-2 mt-2">
                    <div class="p-2 text-gray-700">
                        <i class="fas fa-fw fa-file"></i> 提交文件
                    </div>
                </div>
                <div id="downloadFiles">
                    <a href="" class="btn btn-outline-primary btn-sm btn-block text-left">
                        <i class="fas fa-fw fa-download"></i>
                        文件
                    </a>
                </div>

                <div class="card border-left-primary mb-2 mt-2">
                    <div class="p-2 text-gray-700">
                        <i class="fas fa-fw fa-check"></i> 审核信息
                    </div>
                </div>
                <div class="pt-2">
                    <div class="form-group">
                        <label for="verifySelect">审核选项</label>
                        <select class="form-control" id="verifySelect">
                            <option value="1">审核通过</option>
                            <option value="2">申请驳回</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="verifyInfo">审核原因</label>
                        <textarea class="form-control" id="verifyInfo" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" data-target="" id="commitVerify">提交</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.0/dist/sweetalert2.all.min.js" integrity="sha256-wWhZbmmAXb1JDP1U+ywgt4FHA4XIxzcYyGEFnInYJMQ=" crossorigin="anonymous"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

<!-- Smallpop -->
<script src="https://cdn.jsdelivr.net/gh/RioHsc/Smallpop/dist/spop.min.js"></script>

<!-- modify and delete -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(".watchInfo").click(function () {
        let id = $(this).data('target');
        $("#commitVerify").data('target',id);
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($getGreenPathInfo)}}",
            data: {target:id},
            success: function (data) {
                if (data.code === 200) {
                    // 获取个人信息
                    let datas = data.data;
                    $("#name").text(datas.name);
                    $("#schoolID").text(datas.schoolID);
                    $("#gender").text(datas.gender);
                    $("#cid").text(datas.cid);
                    $("#party").text(datas.party);
                    $("#dept").text(datas.dept);
                    $("#major").text(datas.major);
                    $("#nation").text(datas.nation);
                    $("#homeLocation").text(datas.homeLocation);
                    // 获取文件信息
                    let files = $.parseJSON(datas.files);
                    let showHTML = "";
                    if(files.length===0){
                        showHTML = "<p>暂无文件</p>"
                    }else
                    $.each(files,function (index,val) {
                        showHTML+="<a href=\"{{url('/')}}/"+val.file+"\" class=\"btn btn-outline-primary btn-sm btn-block text-left\">\n" +
                            "<i class=\"fas fa-fw fa-download\"></i>\n" +
                            val.name +" ("+formatFileSize(val.size)+")"
                            "</a>"
                    });
                    $("#downloadFiles").html(showHTML);
                    // 修改审核信息
                    $("#verifySelect option[value='"+datas.verify+"']").attr('selected',true);
                    $("#verifyInfo").text(datas.verifyInfo);
                    $("#informationModal").modal('show');
                } else {
                    spop({
                        template: "<h4>获取失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "getVerifyInfo",
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
                    group: "getVerifyInfo",
                });
            }
        });
    });

    $("#commitVerify").click(function () {
        let id = $(this).data('target');
        let verify = $("#verifySelect option:selected").val();
        let verifyInfo = $("#verifyInfo").val();
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($commitVerifyInfo)}}",
            data: {target:id, verify:verify, verifyInfo:verifyInfo},
            success: function (data) {
                if (data.code === 200) {
                    spop({
                        template: "已成功提交",
                        style: 'success',
                        autoclose: 5000,
                        position: 'bottom-right',
                        icon: true,
                        group: "saveVerify",
                    });
                    $("#informationModal").modal('hide');
                } else {
                    spop({
                        template: "<h4>获取失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "saveVerify",
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
                    group: "saveVerify",
                });
            }
        });
    });

    // 文件大小转化
    function formatFileSize(fileSize) {
        if (fileSize < 1024) {
            return fileSize + 'B';
        } else if (fileSize < (1024*1024)) {
            var temp = fileSize / 1024;
            temp = temp.toFixed(2);
            return temp + 'KB';
        } else if (fileSize < (1024*1024*1024)) {
            var temp = fileSize / (1024*1024);
            temp = temp.toFixed(2);
            return temp + 'MB';
        } else {
            var temp = fileSize / (1024*1024*1024);
            temp = temp.toFixed(2);
            return temp + 'GB';
        }
    }

</script>
</body>

</html>