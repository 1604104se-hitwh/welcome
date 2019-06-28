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
            <a class="nav-link" href="{{url('/admin/personalInfo')}}">
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
        <li class="nav-item active">
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
                    <h1 class="h3 mb-0 text-gray-800">发布通知</h1>
                </div>

                <!-- Content Row -->
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">新建通知</h6>
                    </div>
                    <div class="card-header py-3">
                        <input type="text" class="form-control" name="post_title" id="post_title" placeholder="输入通知标题"
                               required>
                    </div>
                    <div class="card-body">
                        <div id="postEditor" class="mb-4">

                        </div>
                        <button type="button" class="btn btn-primary" id="submitPost">发布</button>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">所有通知</h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr role="row">
                                <th>通知标题</th>
                                <th>发布时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($posts)==0)
                                <tr role="row">
                                    <td colspan="4">还没有通知</td>
                                </tr>
                            @else @foreach($posts as $post)
                                <tr role="row">
                                    <td><a class="nav-link" href="javascript:modifyPost({{strval($post->id)}})">
                                            <span>{{$post->post_title}}</span></a></td>
                                    <td>{{$post->post_timestamp}}</td>
                                    <td>
                                        <button type="button" class="m-1 btn btn-info btn-sm modifyPost"
                                                data-target="{{strval($post->id)}}"> 修改
                                        </button>
                                        <button type="button" class="m-1 btn btn-danger btn-sm deletePost"
                                                data-target="{{strval($post->id)}}" data-title="{{$post->post_title}}">
                                            删除
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                        {{ $posts->links() }}
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

<!-- Change notification Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">修改通知内容</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3">
                    <input type="text" class="form-control" name="post_title" id="m_post_title" placeholder="输入通知标题"
                           data-postid="" required>
                </div>
                <div id="postModifyEditor" class="mb-4">
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-check abc-checkbox abc-checkbox-info abc-checkbox-circle">
                    <input type="checkbox" class="form-check-input" id="readAgain">
                    <label class="form-check-label" for="readAgain">再次提醒阅读</label>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="modifyConfirm()">保存</button>
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


<!-- Custom scripts for Editor -->
<script type="text/javascript" src="https://unpkg.com/wangeditor/release/wangEditor.min.js"></script>
<script type="text/javascript">
    var E = window.wangEditor;
    var editor = new E('#postEditor');
    editor.customConfig.uploadImgShowBase64 = true;
    editor.customConfig.zIndex = 1;
    editor.create();
    var modifyeditor = new E('#postModifyEditor');
    modifyeditor.customConfig.uploadImgShowBase64 = true;
    editor.customConfig.zIndex = 1;
    modifyeditor.create();

</script>

<!-- modify and delete -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".modifyPost").click(function () {
        modifyPost($(this).data("target"));
    });

    $(".deletePost").click(function () {
        var thisTable = $(this);
        Swal.fire({
            title: '确定要删除吗',
            text: "你将要删除通知\" " + $(this).data("title") + " \"",
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
                    url: "{{url($deletePostURL)}}",
                    data: {"deleteID": $(this).data("target")},

                    success: function (data) {
                        if (data.code === 200) {
                            Swal.fire(
                                '成功删除',
                                '通知已经被成功删除',
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
</script>

<script>
    function modifyPost(id) {
        // 获取信息
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($getPostURL)}}",
            data: {"requestID": id},
            success: function (data) {
                if (data.code === 200) {
                    var input = $("#m_post_title");
                    input.val(data.data.title);
                    input.data("postid", id);
                    modifyeditor.txt.html(data.data.context);
                    $("#modifyModal").modal('show');
                } else {
                    Swal.fire(
                        '获取失败（' + data.code + '）',
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
                    '获取失败（' + XMLHttpRequest.status + '）',
                    textStatus,
                    'error'
                );
            }
        });
    }

    function modifyConfirm() {
        var thisTable = $("#m_post_title");
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($modifyPostURL)}}",
            data: {
                "modifyID": thisTable.data("postid"),
                "title": thisTable.val(),
                "context": modifyeditor.txt.html(),
                "readAgain": $("#readAgain").prop('checked')
            },
            success: function (data) {
                if (data.code === 200) {
                    Swal.fire({
                        title: '修改完成',
                        text: '完成了修改',
                        type: 'success',
                        onClose: function () {
                            window.location.reload();
                        }
                    });
                    $("#modifyModal").modal('hide');

                } else {
                    Swal.fire(
                        '修改失败（' + data.code + '）',
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
                    '修改失败（' + XMLHttpRequest.status + '）',
                    textStatus,
                    'error'
                );
            }
        });
    }
</script>

<!-- ajax post -->
<script>
    $('#submitPost').click(function () {
        // var postTitle = document.getElementById("post_title").value;
        var postTitle = $("#post_title").val();
        if (postTitle === "" || editor.txt.html() === "") {
            spop({
                template: "<h4>发布失败</h4>" +
                    "<p>标题和内容都必须填写哦</p>",
                style: 'warning',
                autoclose: 5000,
                position: 'bottom-right',
                icon: true,
                group: "submitPost",
            });
            return;
        }
        $.ajax({
            async: true,   		//是否为异步请求
            cache: false,  		//是否缓存结果
            type: "POST", 		//请求方式
            dataType: "jsonp", 	//服务器返回的数据是什么类型
            url: "{{url($storePostURL)}}",
            data: {"postTitle": postTitle, "newPost": editor.txt.html()},

            success: function (data) {
                if (data.code === 200) {
                    spop({
                        template: "<h4>发布成功</h4>" +
                            "<p>信息已经更新，刷新页面就可以看到啦</p>",
                        style: 'success',
                        autoclose: 5000,
                        position: 'bottom-right',
                        icon: true,
                        group: "submitPost",
                    });
                    $("#post_title").val("");
                    editor.txt.html("");
                } else {
                    spop({
                        template: "<h4>提交失败（" + data.code + "）</h4>" +
                            "<p>" + data.data + "</p>",
                        style: 'warning',
                        autoclose: false,
                        position: 'bottom-right',
                        icon: true,
                        group: "submitPost",
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
                    group: "submitPost",
                });
            }
        });
    });
</script>
</body>

</html>