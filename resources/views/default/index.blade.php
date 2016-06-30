@extends('default.layouts.layouts')

@section('content')
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">首页</a></li>
            <li><a href="#">超能阿布</a></li>
            <li><a href="#">芦荟系列</a></li>
            <li><a href="#">韩专系列</a></li>
            <li><a href="#">加盟代理</a></li>
            <li><a href="#">联系我们</a></li>
            <li><a href="#">关于我们</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{asset('/data/ad_img/1.jpg')}}" alt="01">
                <div class="carousel-caption">
                </div>
            </div>
            <div class="item">
                <img src="{{asset('/data/ad_img/2.jpg')}}" alt="02">
                <div class="carousel-caption">
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endsection