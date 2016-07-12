@extends('default.layouts.layouts')

@section('content')
    <div class="container" style="margin-top:10px;">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    @foreach(\App\Models\Category::all() as $item)
                        <li role="presentation" @if($item->cat_id == $goods->cat_id)class="active"@endif>
                            <a href="{{URL::route('category',['id'=>$item->cat_id])}}">{{$item->cat_name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{URL::route('index')}}">首页</a></li>
                    <li class="active">{{$goods->goods_name}}</li>
                </ol>
                @if(!$goods->images->isEmpty())
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($goods->images as $key=>$img)
                            <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" @if($key==0) class="active"@endif></li>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($goods->images as $key=>$img)
                            <div  class="item @if($key==0) active @endif">
                                <img src="{{asset($img->thumb_url)}}" alt="{{$key}}">
                                <div class="carousel-caption"></div>
                            </div>
                            @endforeach
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
                @endif
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
@endsection