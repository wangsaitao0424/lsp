<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>后台 - 注册</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">h</h1>

        </div>
        <h3>欢迎使用 注册</h3>

        <form class="m-t" role="form" action="{{url('/admin/login/register_do')}}" method="post">
            <div class="form-group">
                <input type="text-muted" class="form-control" id="username" name="user_name" placeholder="用户名">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="pwd" name="user_pwd" placeholder="密码">
            </div>
            <div class="form-group">
                <input type="text-muted" class="form-control" id="username" name="user_email" placeholder="用户名">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">注 册</button>

            <p class="text-muted text-center">  <a href="{{url('/admin/login/login')}}">已有账号点击登录</a>
            </p>
        </form>
    </div>
</div>
<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>
</body>
</html>
