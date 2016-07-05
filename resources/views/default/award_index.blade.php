@extends('default.layouts.layouts')

@section('header')
    <script src="{{asset('default/js/award/jquery.easing.min.js')}}"></script>
    <script src="{{asset('default/js/award/jQueryRotate.2.2.js')}}"></script>
    <style>
        /* ======================
        抽奖
        ====================== */
        .award{width:100%; height:417px; position:relative; margin:50px auto}
        #disk{width:310px; height:310px; margin: 0 auto;}
        #disk img{max-width: 100%;  display: block;   margin: 0 auto;}
        #start{width:100%;  position:absolute; top:23px; left: 2px; }
        #start .start{width:135px; margin: 0 auto;}
        #start img{cursor:pointer; max-width: 100%;}
    </style>
@endsection

@section('content')
    <div class="main-body">
        <div class="award">
            <div id="disk"><img src="{{asset('default/images/disk.jpg')}}"></div>
            <div id="start">
                <div class="start"><img src="{{asset('default/images/start.png')}}" id="startbtn"></div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $("#startbtn").click(function () {
                $("#startbtn").rotate({
                    animateTo:0
                });
                award();
            });
        });
        function award() {
            $.ajax({
                type: 'POST',
                url: '{{URL::route('award.ajax',['_token'=>csrf_token()])}}',
                dataType: 'json',
                cache: false,
                error: function () {
                    alert('出错了！');
                    return false;
                },
                success: function (json) {
                    //$("#startbtn").unbind('click').css("cursor", "default");
                    var a = json.angle; //角度
                    var p = json.prize; //奖项
                    $("#startbtn").rotate({
                        duration: 5000, //转动时间
                        angle: 0,
                        animateTo: 1800 + a, //转动角度
                        easing: $.easing.easeOutSine,
                        callback: function () {
                            alert('恭喜你，中得' + p);
                            /*var con = confirm('恭喜你，中得'+p);
                             if(con){
                             award();
                             }else{
                             window.location.reload();
                             } */
                        }
                    });
                }
            });
        }
    </script>
@endsection