@extends('default.layouts.layouts')

@section('header')
    <script src="{{asset('common/js/jweixin-1.0.0.js')}}"></script>
    <script>
        wx.config({!! \Wechat::js()->config(array('scanQRCode'), true) !!});
        wx.ready(function(){
        });
        function sc(){
            wx.scanQRCode({
                needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                    $("#goods_code").val(result.split("-")[1]);
                }
            });
        }
    </script>
@endsection

@section('content')
    <div>
        <span>产品编号：</span>
        <div><input id="goods_code" name="goods_code" type="text" onClick="sc();" readonly /></div>
        <p><img src="images/qr.jpg" style="width:25px;padding:8px 5px;" onClick="sc();" /></p>
    </div>
@endsection