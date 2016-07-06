@extends('default.layouts.layouts')

@section('header')
    <script src="{{asset('common/js/jweixin-1.0.0.js')}}"></script>
    <script>
        wx.config({!! \Wechat::js()->config(array('onMenuShareQQ', 'onMenuShareWeibo'), true) !!});
        wx.ready(function(){
            wx.hideOptionMenu();
        });
    </script>
@endsection

@section('content')
@endsection