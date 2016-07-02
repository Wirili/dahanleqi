@extends('wechat.layouts.layouts')
@section('content')
<div class="main-top">
    <h3 class="logo text-center"><i class="fa fa-home"></i> 公众号管理</h3>
    <ul class="notification-menu">
        <li><a class="dropdown-toggle" href="{{ URL::route('admin.logout') }}"><i class="fa fa-sign-out"></i> 注销</a></li>
        <li><a class="dropdown-toggle" href="{{ URL::route('admin.get_setting') }}" target="mainframe"><i class="fa fa-gear"></i> 设置</a></li>
        <li><a class="dropdown-toggle" href="{{ URL::route('admin.index') }}" target="_self"><i class="fa fa-tv"></i> 后台管理</a></li>
        <li><a class="dropdown-toggle" href="javascript:void(0);"><i class="fa fa-user"></i> {{ Auth::guard('admin')->user()->name }}</a></li>
    </ul>
</div>
<div class="main-left">
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="menu-list nav-stacked">
            <a href="javascript:void(0);"><i class="fa fa-file-text-o"></i><span>功能</span><b class="fa fa-angle-down"></b></a>
            <ul class="sub-menu-list">
                <li><a href="{{URL::route('admin.goods.index')}}" target="mainframe">群发消息</a></li>
                <li><a href="{{URL::route('admin.category.index')}}" target="mainframe">自动回复</a></li>
                <li><a href="{{URL::route('admin.brand.index')}}" target="mainframe">自定义菜单</a></li>
            </ul>
        </li>
        <li class="menu-list">
            <a href="javascript:void(0);"><i class="fa fa-wpforms"></i><span>管理</span><b class="fa fa-angle-down"></b></a>
            <ul class="sub-menu-list">
                <li><a href="{{URL::route('admin.article.index')}}" target="mainframe">用户管理</a></li>
                <li><a href="{{URL::route('admin.article_cat.index')}}" target="mainframe">素材管理</a></li>
                <li><a href="{{URL::route('admin.article_cat.index')}}" target="mainframe">渠道二维码</a></li>
            </ul>
        </li>
        <li class="menu-list">
            <a href="javascript:void(0);"><i class="fa fa-users"></i><span>扩展</span><b class="fa fa-angle-down"></b></a>
            <ul class="sub-menu-list">
                <li><a href="{{URL::route('admin.admin.index')}}" target="mainframe">功能扩展</a></li>
            </ul>
        </li>
        <li class="menu-list">
            <a href="javascript:void(0);"><i class="fa fa-users"></i><span>其他</span><b class="fa fa-angle-down"></b></a>
            <ul class="sub-menu-list">
                <li><a href="{{URL::route('admin.admin.index')}}" target="mainframe">提醒设置</a></li>
                <li><a href="{{URL::route('admin.admin.index')}}" target="mainframe">多客服设置</a></li>
                <li><a href="{{URL::route('admin.admin.index')}}" target="mainframe">扫码引荐</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="main-container">
    <iframe id="mainframe" name="mainframe" src="{{URL::route('admin.welcome')}}" frameborder="0" scrolling="yes" ></iframe>
</div>
@endsection