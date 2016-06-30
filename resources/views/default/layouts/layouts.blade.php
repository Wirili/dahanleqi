<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>首页</title>

    <!-- Styles -->
    <link href="{{asset('common/css/bootstrap.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('common/css/font-awesome.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('default/css/default.css')}}" rel="stylesheet" type='text/css'>

    <!-- JavaScripts -->
    <script src="{{asset('common/js/jquery-1.12.3.min.js')}}"></script>
    <script src="{{asset('common/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('default/js/app.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@yield('content')
</body>
</html>
