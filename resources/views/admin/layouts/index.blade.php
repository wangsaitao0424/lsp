<!doctype html>
<html class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.2</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="stylesheet" href="{{asset('/layui/css/font.css')}}">
	<link rel="stylesheet" href="{{asset('/layui/css/xadmin.css')}}">
	<!-- <link rel="stylesheet" href="./css/theme5.css"> -->
	<script src="{{asset('/layui/lib/layui/layui.js')}}" charset="utf-8"></script>
	<script type="text/javascript" src="{{asset('/layui/js/xadmin.js')}}"></script>
	<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
	<!--[if lt IE 9]>
	<script src="{{asset('/layui/html5.min.js')}}"></script>
	<script src="{{asset('/layui/respond.min.js')}}"></script>
	<![endif]-->
	<script>
		// 是否开启刷新记忆tab功能
		// var is_remember = false;
	</script>
</head>
<body class="index">
<!-- 顶部开始 -->
<div class="container">
	<div class="logo">
		<a href="/admin/index" style="color: red;font-size:18px;"><b>China&nbsp;&nbsp;&nbsp;&nbsp;北京</b></a>
	</div>
	<div class="left_open">
		<a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
	</div>
	<ul class="layui-nav left fast-add" lay-filter="">
		<li class="layui-nav-item">
			<a href="javascript:;">+新增</a>
			<dl class="layui-nav-child">
				<!-- 二级菜单 -->
				<dd>
					<a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
						<i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>
				<dd>
					<a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
						<i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
				<dd>
					<a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
						<i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
				<dd>
					<a onclick="xadmin.add_tab('在tab打开','member-list.html')">
						<i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
				<dd>
					<a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
						<i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
			</dl>
		</li>
	</ul>
	<ul class="layui-nav right" lay-filter="">
		<li class="layui-nav-item">
			<a href="javascript:;" ><b style="color: red;font-size: 16px;">{{session('loginData')['user_name']}}</b></a>
			<dl class="layui-nav-child">
				<!-- 二级菜单 -->

				@if(empty(session('loginData')['user_name']))
					<a href="/admin/login/login" onclick="xadmin.open('个人信息','http://www.baidu.com')">请先登录</a></dd>
				@else
					{{--                    <dd>--}}
					<a href="/admin/login/login_lout">退出</a></dd>
				@endif
			</dl>
		</li>
		<li class="layui-nav-item to-index">
			<a href="/">前台首页</a></li>
	</ul>
</div>

<!-- 顶部结束 -->
<!-- 中部开始 -->

<!-- 左侧菜单开始 -->
<div class="left-nav">

	<div id="side-nav">
		<ul id="nav">
			<li>
{{--				<a href="javascript:;">--}}
{{--					<i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>--}}
{{--					<cite>商品模块</cite>--}}
{{--					<i class="iconfont nav_right">&#xe697;</i>--}}
{{--				</a>--}}
				<ul class="sub-menu">
					<li>
						<a href="javascript:;">
							<i class="iconfont">&#xe70b;</i>
							<cite>一级菜单</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('会员删除','member-del.html')" href="{{url('admin/shop_brand_add')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>一级菜单添加</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('等级管理','member-list1.html')" href="{{url('admin/shop_brand_list')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>一级菜单展示</cite></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
							<i class="iconfont">&#xe70b;</i>
							<cite>商品</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('会员删除','member-del.html')" href="{{url('admin/shop_goods_add')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>商品添加</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('等级管理','member-list1.html')" href="{{url('admin/shop_goods_list')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>商品展示</cite></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
							<i class="iconfont">&#xe70b;</i>
							<cite>商品详情</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('会员删除','member-del.html')" href="{{url('admin/goods_par_add')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>商品详情添加</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('等级管理','member-list1.html')" href="{{url('admin/goods_par_list')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>商品详情展示</cite></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:;">
							<i class="iconfont">&#xe70b;</i>
							<cite>优惠劵</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('会员删除','member-del.html')" href="{{url('admin/discounts_add')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>优惠券添加</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('等级管理','member-list1.html')" href="{{url('admin/discounts_list')}}">
									<i class="iconfont">&#xe6a7;</i>
									<cite>优惠券展示</cite></a>
							</li>
						</ul>
					</li>
                    <li>
						<a href="javascript:;">
							<i class="iconfont">&#xe70b;</i>
							<cite>轮播图管理</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a onclick="xadmin.add_tab('会员删除','member-del.html')" href="char">
									<i class="iconfont">&#xe6a7;</i>
									<cite >轮播图添加</cite></a>
							</li>
							<li>
								<a onclick="xadmin.add_tab('等级管理','member-list1.html')" href="list_char">
									<i class="iconfont">&#xe6a7;</i>
									<cite>轮播图展示</cite></a>
							</li>
						</ul>
					</li>
{{--					 <li>--}}
{{--						<a href="javascript:;">--}}
{{--							<i class="iconfont">&#xe70b;</i>--}}
{{--							<cite>用户留言管理</cite>--}}
{{--							<i class="iconfont nav_right">&#xe697;</i></a>--}}
{{--						<ul class="sub-menu">--}}
{{--							<li>--}}
{{--								<a onclick="xadmin.add_tab('会员删除','member-del.html')" href="tb_leaveword">--}}
{{--									<i class="iconfont">&#xe6a7;</i>--}}
{{--									<cite >用户留言添加</cite></a>--}}
{{--							</li>--}}
{{--							<li>--}}
{{--								<a onclick="xadmin.add_tab('等级管理','member-list1.html')">--}}
{{--									<i class="iconfont">&#xe6a7;</i>--}}
{{--									<cite>用户留言展示展示</cite></a>--}}
{{--							</li>--}}
{{--						</ul>--}}
{{--					</li>--}}
{{--					<li>--}}
{{--						<a href="javascript:;">--}}
{{--							<i class="iconfont">&#xe70b;</i>--}}
{{--							<cite>会员管理</cite>--}}
{{--							<i class="iconfont nav_right">&#xe697;</i></a>--}}
{{--						<ul class="sub-menu">--}}
{{--							<li>--}}
{{--								<a onclick="xadmin.add_tab('会员删除','member-del.html')">--}}
{{--									<i class="iconfont">&#xe6a7;</i>--}}
{{--									<cite>会员删除</cite></a>--}}
{{--							</li>--}}
{{--							<li>--}}
{{--								<a onclick="xadmin.add_tab('等级管理','member-list1.html')">--}}
{{--									<i class="iconfont">&#xe6a7;</i>--}}
{{--									<cite>等级管理</cite></a>--}}
{{--							</li>--}}
{{--						</ul>--}}
{{--					</li>--}}
				</ul>
				<ul class="sub-menu">
					<li>
						<a href="javascript:;">
							<i class="iconfont">&#xe70b;</i>
							<cite>广告模块</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a href="/admin/adver/adver_add" onclick="xadmin.add_tab('会员删除','member-del.html')">
									<i class="iconfont">&#xe6a7;</i>
									<cite>广告 — 添加</cite>
								</a>
							</li>
							<li>
								<a href="/admin/adver/adver_list" onclick="xadmin.add_tab('等级管理','member-list1.html')">
									<i class="iconfont">&#xe6a7;</i>
									<cite>广告 — 展示</cite>
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<ul class="sub-menu">
					<li>
						<a href="javascript:;">
							<i class="iconfont">&#xe70b;</i>
							<cite>RBAC</cite>
							<i class="iconfont nav_right">&#xe697;</i></a>
						<ul class="sub-menu">
							<li>
								<a href="/admin/rbac/jue_list" onclick="xadmin.add_tab('会员删除','member-del.html')">
									<i class="iconfont">&#xe6a7;</i>
									<cite>角色 — 展示</cite>
								</a>
							</li>
							<li>
								<a href="/admin/rbac/userJue_list" onclick="xadmin.add_tab('等级管理','member-list1.html')">
									<i class="iconfont">&#xe6a7;</i>
									<cite>用户角色 — 展示</cite>
								</a>
							</li>
							<li>
								<a href="/admin/rbac/quan_list" onclick="xadmin.add_tab('等级管理','member-list1.html')">
									<i class="iconfont">&#xe6a7;</i>
									<cite>权限 — 展示</cite>
								</a>
							</li>
							<li>
								<a href="/admin/rbac/quanJue_list" onclick="xadmin.add_tab('等级管理','member-list1.html')">
									<i class="iconfont">&#xe6a7;</i>
									<cite>权限角色 — 展示</cite>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				{{--				<a href="javascript:;">--}}
				{{--					<i class="iconfont left-nav-li" lay-tips="会员管理">&#xe6b8;</i>--}}
				{{--					<cite>广告模块</cite>--}}
				{{--					<i class="iconfont nav_right">&#xe697;</i>--}}
				{{--				</a>--}}

			</li>
		</ul>
	</div>
</div>

<div class="x-slide_left"></div>
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
	{{--<div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">--}}
		{{--<ul class="layui-tab-title">--}}
			{{--<li class="home">--}}
				{{--<i class="layui-icon">&#xe68e;</i>我的桌面</li></ul>--}}
		{{--<div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">--}}
			{{--<dl>--}}
				{{--<dd data-type="this">关闭当前</dd>--}}
				{{--<dd data-type="other">关闭其它</dd>--}}
				{{--<dd data-type="all">关闭全部</dd></dl>--}}
		{{--</div>--}}
		{{--<div class="layui-tab-content">--}}
			{{--<div class="layui-tab-item layui-show">--}}
				{{--<iframe src='./welcome.html' frameborder="0" scrolling="yes" class="x-iframe"></iframe>--}}
			{{--</div>--}}
		{{--</div>--}}
		{{--<div id="tab_show"></div>--}}
	{{--</div>--}}
	{{----}}
    <center>
	    @yield('content')
    </center>
</div>
<div class="page-content-bg"></div>
<style id="theme_style"></style>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<script>//百度统计可去掉
	var _hmt = _hmt || []; (function() {
		var hm = document.createElement("script");
		hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
		var s = document.getElementsByTagName("script")[0];
		s.parentNode.insertBefore(hm, s);
	})();</script>
</body>

</html>