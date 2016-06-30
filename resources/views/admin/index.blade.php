<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>后台管理</title>

    <!-- Styles -->
    <link href="{{asset('common/css/bootstrap.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('common/css/font-awesome.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('default_admin/css/app.css')}}" rel="stylesheet" type='text/css'>
    {{--<link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" type='text/css'>--}}
    <link href="{{asset('default_admin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type='text/css'>

    <!-- JavaScripts -->
    <script src="{{asset('common/js/jquery-1.12.3.min.js')}}"></script>
    <script src="{{asset('common/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('default_admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('default_admin/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('default_admin/js/app.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="">

<div class="main-top">
    <h3 class="logo text-center"><i class="fa fa-home"></i> 后台管理</h3>
    <ul class="notification-menu">
        <li><a class="dropdown-toggle" href="{{ URL::route('admin.logout') }}"><i class="fa fa-sign-out"></i> 注销</a></li>
        <li><a class="dropdown-toggle" href="{{ URL::route('admin.get_setting') }}" target="mainframe"><i class="fa fa-gear"></i> 设置</a></li>
        <li><a class="dropdown-toggle" href="javascript:void(0);"><i class="fa fa-user"></i> {{ Auth::guard('admin')->user()->name }}</a></li>
    </ul>
</div>
<div class="main-left">
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="menu-list nav-stacked">
            <a href="javascript:void(0);"><i class="fa fa-file-text-o"></i><span>商品管理</span><b class="fa fa-angle-down"></b></a>
            <ul class="sub-menu-list">
                <li><a href="{{URL::route('admin.goods.index')}}" target="mainframe">商品列表</a></li>
                <li><a href="{{URL::route('admin.category.index')}}" target="mainframe">商品分类</a></li>
                <li><a href="{{URL::route('admin.brand.index')}}" target="mainframe">商品品牌</a></li>
            </ul>
        </li>
        <li class="menu-list">
            <a href="javascript:void(0);"><i class="fa fa-wpforms"></i><span>文章管理</span><b class="fa fa-angle-down"></b></a>
            <ul class="sub-menu-list">
                <li><a href="{{URL::route('admin.article.index')}}" target="mainframe">文章列表</a></li>
                <li><a href="{{URL::route('admin.article_cat.index')}}" target="mainframe">文章类别</a></li>
            </ul>
        </li>
        <li class="menu-list">
            <a href="javascript:void(0);"><i class="fa fa-users"></i><span>权限管理</span><b class="fa fa-angle-down"></b></a>
            <ul class="sub-menu-list">
                <li><a href="{{URL::route('admin.admin.index')}}" target="mainframe">管理员列表</a></li>
                <li><a href="{{URL::route('admin.role.index')}}" target="mainframe">角色管理</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="main-container">
    <iframe id="mainframe" name="mainframe" src="{{URL::route('admin.welcome')}}" frameborder="0" scrolling="yes" ></iframe>
</div>

@yield('content')
</body>
</html>
