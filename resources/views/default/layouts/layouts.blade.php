<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$config['web_name']}}</title>

    <!-- Styles -->
    <link href="{{asset('common/css/bootstrap.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('common/css/font-awesome.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('default/css/default.css')}}" rel="stylesheet" type='text/css'>

    <!-- JavaScripts -->
    <script src="{{asset('common/js/jquery-1.12.3.min.js')}}"></script>
    <script src="{{asset('common/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('default/js/app.js')}}"></script>

    <!-- layer -->
    <link href="{{asset('common/plugin/layer/need/layer.css')}}" rel="stylesheet" type='text/css'>
    <script src="{{asset('common/plugin/layer/layer.js')}}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('header')
</head>
<body style="padding-top: 50px;">
    <nav class="navbar navbar-default navbar-fixed-top">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-home" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::route('index')}}">优乐柔</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-home">
                <ul class="nav navbar-nav">
                    <li @if(URL::current()==URL::route('index')) class="active" @endif><a href="{{URL::route('index')}}">首页</a></li>
                    @foreach(\App\Models\Category::where('show_in_nav',1)->get() as $item)
                        <li @if(URL::current()==URL::route('category',['id'=>$item->cat_id])) class="active" @endif><a href="{{URL::route('category',['id'=>$item->cat_id])}}">{{$item->cat_name}}</a></li>
                    @endforeach
                    @foreach(\App\Models\Article::where('show_in_nav',1)->orderBy('article_id','asc')->get() as $item)
                        <li @if(URL::current()==URL::route('article',['id'=>$item->article_id])) class="active" @endif><a href="{{URL::route('article',['id'=>$item->article_id])}}">{{$item->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
@yield('content')
<footer class="text-center">
    <p>{{$config['web_icp']}} | 大韩乐奇 版权所有</p>
</footer>
</body>
</html>
