@extends('admin.layouts.index')

@section('content')
    <div class="row" style="margin-top:120px;">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$title}}
                </div>
                <div class="panel-body">
                    @if($type!='error')
                        <p class="text-success">{{$content}}</p>
                    @else
                        <p class="text-danger">{{$content}}</p>
                        @if(count($errors)>0)
                            @foreach($errors->all() as $error)
                                <p class=" text-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                    @endif
                    <p>等待<b id="wait">{{$wait}}</b>秒之后自动跳转<br><a id="href" href="{{$link}}">如果页面没有跳转，请点击这里</a></p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            var wait = document.getElementById('wait');
            var href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        });
    </script>
@endsection