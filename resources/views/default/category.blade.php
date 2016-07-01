@extends('default.layouts.layouts')

@section('content')
    @if($cat->show_img)
        <div class="container-fluid">
            <div class="row"><img src="{{$cat->show_img}}" alt="" style="width:100%;"></div>
        </div>
    @endif
    <div class="container" style="margin-top:10px;">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    @foreach(\App\Models\Category::all() as $item)
                        <li role="presentation" @if($item->cat_id == $cat->id)class="active"@endif><a
                                    href="{{URL::route('category',['id'=>$item->cat_id])}}">{{$item->cat_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="row col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{URL::route('index')}}">首页</a></li>
                    <li class="active">{{$cat->cat_name}}</li>
                </ol>
                @if(!$goods->isEmpty())
                    @foreach($goods as $good)
                        <div class="col-md-4">
                            <img src="@if($good->covers) {{$good->covers->thumb_url}} @endif" alt="..."
                                 class="img-thumbnail">
                            <div><span>{{$good->goods_name}}</span></div>
                        </div>
                    @endforeach
                    <div class="row text-right">{!! with(new \Illuminate\Pagination\SimpleBootstrapThreePresenter($goods))->render() !!}</div>
                @else
                        没有数据
                @endif
            </div>
        </div>
    </div>
@endsection