@extends('default.layouts.layouts')

@section('header')
    <script src="{{asset('common/js/jweixin-1.0.0.js')}}"></script>
    <script>
        wx.config({!! \Wechat::js()->config(array('scanQRCode'), false) !!});
        wx.ready(function(){
            $('#goods_code').on('click',function(){
                var falt=true;
                sc(falt);
            });
        });
        function sc(falt){
            wx.scanQRCode({
                needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    if(res) {
                        var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                        $("#goods_code").val($("#goods_code").val()+'\n'+result.split("-")[1]);
                    }else
                        falt=false;
                    sc(falt);
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <form class="form-horizontal" style="margin-top:15px;">
            {{--<div class="form-group">--}}
                {{--<div class="col-md-12"><input class="form-control" id="goods_code" name="goods_code" type="text" readonly placeholder="产品编号-点击扫码"/></div>--}}
            {{--</div>--}}
            <div class="form-group">
                <div class="col-md-12"><textarea class="form-control" id="goods_code" name="goods_code" rows="10" readonly placeholder="产品编号-点击扫码"></textarea></div>
            </div>
            <div class="form-group">
                <div class="col-md-12"><input class="form-control" id="goods_password" name="goods_password" type="text" placeholder="刮涂码"/></div>
            </div>
            <div class="form-group">
                <div class="col-md-12 text-center"><button class="btn btn-default">正品查询</button></div>
            </div>
        </form>
    </div>
@endsection