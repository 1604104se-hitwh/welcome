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
        <li class="nav-item active">
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
                    <a class="collapse-item active" href="{{url('/admin/manageAdminInfo')}}">管理员信息</a>
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

            <!-- Begin Page Content -->-
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">管理员信息</h1>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">管理员人数
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$adminTotal}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <h6 class="m-auto font-weight-bold text-primary align-content-center col-6">
                                管理员信息
                            </h6>
                            <div class="m-auto text-right col-6">
                                <button type="button" id="addAdmin" onclick="addAdmin()"
                                        class="btn btn-primary btn-sm m-0">
                                    <i class="fas fa-plus"></i>
                                    添加管理员
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr role="row">
                                <th>用户名</th>
                                <th>角色</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($adminList)==0)
                                <tr role="row">
                                    <td colspan="4">还没有管理员</td>
                                </tr>
                            @else @foreach($adminList as $admin)
                                <tr role="row">
                                    <td>{{$admin->adm_name}}</td>
                                    <td>{{$admin->permission}}</td>
                                    <td>
                                        <button type="button" class="m-1 btn btn-info btn-sm modifyAdmin"
                                                data-target="{{strval($admin->id)}}">编辑
                                        </button>
                                        <button type="button" class="m-1 btn btn-danger btn-sm deleteAdmin"
                                                data-target="{{strval($admin->id)}}">删除
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                        {{ $adminList->links() }}
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

<!-- Add Modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">新建管理员</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <label>输入用户名</label>
                    <input type="text" class="form-control" id="m_new_admin_name" placeholder="输入用户名" required>
                </div>
                <div class="py-1">
                    <label>输入密码</label>
                    <input type="password" class="form-control" id="m_new_admin_pass" placeholder="输入密码" required>
                </div>
                <div class="py-1">
                    <label>确认密码</label>
                    <input type="password" class="form-control" id="m_new_admin_pass_confirm" placeholder="确认密码"
                           required>
                </div>
                <div class="py-1">
                    <label>角色</label>
                    <select class="form-control" id="m_new_admin_roles" required>
                        <option data-permissionID="1">暂无</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="addAdminCommit()">新建</button>
            </div>
        </div>
    </div>
</div>

<!-- Modify Modal-->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">修改管理员</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <label>输入用户名</label>
                    <input type="text" class="form-control" id="m_admin_name" placeholder="输入用户名" required>
                </div>
                <div class="py-1">
                    <label>输入密码</label>
                    <input type="password" class="form-control" id="m_admin_pass" placeholder="输入密码" required>
                </div>
                <div class="py-1">
                    <label>确认密码</label>
                    <input type="password" class="form-control" id="m_admin_pass_confirm" placeholder="确认密码" required>
                </div>
                <div class="py-1">
                    <label>角色</label>
                    <select class="form-control" id="m_admin_roles" required>
                        <option data-permissionID="1">暂无</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="modifyAdminCommit()">保存</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.12.0/dist/sweetalert2.all.min.js" integrity="sha256-wWhZbmmAXb1JDP1U+ywgt4FHA4XIxzcYyGEFnInYJMQ=" crossorigin="anonymous"></script><!-- Custom scripts for all pages-->
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

    $(".deleteAdmin").click(function () {
        var thisTable = $(this);
        Swal.fire({
            title: '确定要删除吗',
            text: "你将要删除管理员\" " + $(this).parent().parent().find('td:first').text() + " \"",
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
                    url: "{{url($deleteAdminURL)}}",
                    data: {"deleteID": $(this).data("target")},

                    success: function (data) {
                        if (data.code === 200) {
                            Swal.fire(
                                '成功删除',
                                '管理员已经被成功删除',
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

    function addAdmin() {
        // 请求权限信息
        // 清空下拉框
        $("#m_new_admin_roles").empty();
        $("#m_new_admin_name").val('');
        $("#m_new_admin_pass").val('');
        $("#m_new_admin_pass_confirm").val('');
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($getPermissionListURL)}}",
            success: function (data) {
                if (data.code === 200) {
                    let rolesModel = $("#m_new_admin_roles");
                    let getData = data.data;
                    // 获取数据
                    getData.forEach(function (val) {
                        rolesModel.append("<option data-permissionID='" + val.id + "'>" + val.pms_name + "</option>");
                    });
                    $("#addModal").modal('show');
                } else {
                    spop({
                        template: "<h4>信息获取失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "addAdmin",
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
                    template: "信息获取失败（" + XMLHttpRequest.status + "）",
                    style: 'error',
                    autoclose: false,
                    position: 'bottom-right',
                    icon: true,
                    group: "addAdmin",
                });
            }
        });
    }

    function addAdminCommit() {
        var adm_name = $("#m_new_admin_name").val();
        var adm_password = $("#m_new_admin_pass").val();
        var adm_pass_confirm = $("#m_new_admin_pass_confirm").val();
        var adm_roles = $("#m_new_admin_roles option:selected").attr('data-permissionID');
        if (adm_password === "" || adm_name === "") {
            spop({
                template: "<h4>添加失败</h4>" +
                    "<p>用户名和密码都不可为空哦</p>",
                style: 'warning',
                autoclose: 5000,
                position: 'bottom-right',
                icon: true,
                group: "addAdminCommit",
            });
            return;
        }
        if (adm_password !== adm_pass_confirm) {
            spop({
                template: "<h4>添加失败</h4>" +
                    "<p>两次输入的密码不相同</p>",
                style: 'warning',
                autoclose: 5000,
                position: 'bottom-right',
                icon: true,
                group: "addAdminCommit",
            });
            return;
        }
        // 开始提交
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($addAdminURL)}}",
            data: {"adm_name": adm_name, "adm_password": adm_password, "adm_permission": adm_roles},

            success: function (data) {
                if (data.code === 200) {
                    spop({
                        template: "<h4>已添加管理员信息</h4>" +
                            "<p>信息已经更新，刷新页面就可以看到啦</p>",
                        style: 'success',
                        autoclose: 5000,
                        position: 'bottom-right',
                        icon: true,
                        group: "addAdminCommit",
                    });
                    $("#addModal").modal('hide');
                } else {
                    spop({
                        template: "<h4>提交失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "addAdminCommit",
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
                    group: "addAdminCommit",
                });
            }
        });
    }

    let modifyID = 0;

    $(".modifyAdmin").click(function () {
        // 获取管理员id
        modifyID = $(this).data("target");
        // 请求管理员信息
        // 清空下拉框
        $("#m_admin_roles").empty();
        $("#m_admin_name").val('');
        $("#m_admin_pass").val('');
        $("#m_admin_pass_confirm").val('');
        $.ajax({
            async: true,   	//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            data: {"requestID": modifyID},
            url: "{{url($getAdminURL)}}",
            success: function (data) {
                if (data.code === 200) {
                    $("#m_admin_name").val(data.data.name);
                    let permissionID = data.data.permission;
                    // 请求权限信息
                    $.ajax({
                        async: true,   	//是否为异步请求
                        cache: false,  		//是否缓存结果
                        type: "POST", 		//请求方式
                        dataType: "jsonp", 	//服务器返回的数据是什么类型
                        url: "{{url($getPermissionListURL)}}",
                        success: function (data) {
                            if (data.code === 200) {
                                let rolesModel = $("#m_admin_roles");
                                let getData = data.data;

                                // 获取数据
                                getData.forEach(function (val) {
                                    if (val.id === permissionID)
                                        rolesModel.append("<option data-permissionID='" + val.id + "' selected>" + val.pms_name + "</option>");
                                    else
                                        rolesModel.append("<option data-permissionID='" + val.id + "'>" + val.pms_name + "</option>");
                                });
                            } else {
                                spop({
                                    template: "<h4>信息获取失败（" + data.code + "）</h4>" +
                                        "<p>" + data.data + "</p>",
                                    style: 'warning',
                                    autoclose: false,
                                    position: 'bottom-right',
                                    icon: true,
                                    group: "addAdminCommit",
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
                                template: "信息获取失败（" + XMLHttpRequest.status + "）",
                                style: 'error',
                                autoclose: false,
                                position: 'bottom-right',
                                icon: true,
                                group: "addAdminCommit",
                            });
                        }
                    });
                } else {
                    spop({
                        template: "<h4>信息获取失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "addAdminCommit",
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
                    template: "信息获取失败（" + XMLHttpRequest.status + "）",
                    style: 'error',
                    autoclose: false,
                    position: 'bottom-right',
                    icon: true,
                    group: "addAdminCommit",
                });
            }
        });

        $('#modifyModal').modal('show');
    });

    function modifyAdminCommit() {
        var adm_name = $("#m_admin_name").val();
        var adm_password = $("#m_admin_pass").val();
        var adm_pass_confirm = $("#m_admin_pass_confirm").val();
        var adm_roles = $("#m_admin_roles option:selected").attr('data-permissionID');
        if (adm_password === "" || adm_name === "") {
            spop({
                template: "<h4>修改失败</h4>" +
                    "<p>用户名和密码都不可为空哦</p>",
                style: 'warning',
                autoclose: 5000,
                position: 'bottom-right',
                icon: true,
                group: "modifyAdminCommit",
            });
            return;
        }
        if (adm_password !== adm_pass_confirm) {
            spop({
                template: "<h4>修改失败</h4>" +
                    "<p>两次输入的密码不相同</p>",
                style: 'warning',
                autoclose: 5000,
                position: 'bottom-right',
                icon: true,
                group: "modifyAdminCommit",
            });
            return;
        }
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($modifyAdminURL)}}",
            data: {
                "modifyID": modifyID,
                "adm_name": adm_name,
                "adm_password": adm_password,
                "adm_permission": adm_roles
            },

            success: function (data) {
                if (data.code === 200) {
                    spop({
                        template: "<h4>已修改管理员信息</h4>" +
                            "<p>信息已经更新，刷新页面就可以看到啦</p>",
                        style: 'success',
                        autoclose: 5000,
                        position: 'bottom-right',
                        icon: true,
                        group: "modifyAdminCommit",
                    });
                    $('#modifyModal').modal('hide');
                } else {
                    spop({
                        template: "<h4>提交失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "modifyAdminCommit",
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
                    group: "modifyAdminCommit",
                });
            }
        });
    }

</script>
</body>

</html>