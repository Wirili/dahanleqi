<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>后台管理</title>

    <!-- Styles -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type='text/css'>
    <!-- 上传样式 -->
    <link href="{{asset('css/fileinput.min.css')}}" rel="stylesheet" type='text/css'>
    <!-- end -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type='text/css'>
    {{--<link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" type='text/css'>--}}
    <link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet" type='text/css'>

    <!-- JavaScripts -->
    <script src="{{asset('js/jquery-1.12.3.min.js')}}"></script>
    <!-- 上传js -->
    <script src="{{asset('js/plugins/canvas-to-blob.min.js')}}"></script>
    <script src="{{asset('js/plugins/sortable.min.js')}}"></script>
    <script src="{{asset('js/plugins/purify.min.js')}}"></script>
    <script src="{{asset('js/fileinput.min.js')}}"></script>
    <!-- end -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttons.bootstrap.min.js')}}"></script>
    <!-- 上传js -->
    <script src="{{asset('themes/fa/fa.js')}}"></script>
    <script src="{{asset('js/locales/zh.js')}}"></script>
    <!-- end -->
    <script src="{{asset('js/app.js')}}"></script>

    @include('UEditor::head')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body{font-size:12px;}
    </style>
</head>
<body style="padding:5px;">

@yield('content')

</body>
</html>
