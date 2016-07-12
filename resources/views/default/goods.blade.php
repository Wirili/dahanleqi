@extends('default.layouts.layouts')

@section('content')
    <div class="container" style="margin-top:10px;">
        <div class="row">
            <div class="col-md-3 hidden-xs">
                <ul class="nav nav-pills nav-stacked">
                    @foreach(\App\Models\Category::all() as $item)
                        <li role="presentation" @if($item->cat_id == $goods->cat_id)class="active"@endif>
                            <a href="{{URL::route('category',['id'=>$item->cat_id])}}">{{$item->cat_name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                <ol class="breadcrumb hidden-xs col-md-12">
                    <li><a href="{{URL::route('index')}}">首页</a></li>
                    <li class="active">{{$goods->goods_name}}</li>
                </ol>
            <!-- Swiper -->
                @if(!$goods->images->isEmpty())
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($goods->images as $key=>$img)
                        <div class="swiper-slide"><img src="{{asset($img->thumb_url)}}" alt="{{$key}}" style="width:100%;"></div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                @endif
                <script>
                    $(function(){
                        var swiper = new Swiper('.swiper-container', {
                            pagination: '.swiper-pagination',
                            paginationClickable: true,
                            loop: true
                        });
                    });
                </script>
                @if($goods)
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_main" aria-controls="tab_main" role="tab" data-toggle="tab">@lang('sys.tab_main')</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" style="margin-top:8px;">
                            <div role="tabpanel" class="tab-pane active" id="tab_main">
                                {!! $goods->goods_desc !!}
                            </div>
                        </div>
                    </div>
                @else
                        没有数据
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection