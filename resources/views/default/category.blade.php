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
                        <li role="presentation" @if($item->cat_id == $cat->cat_id)class="active"@endif><a
                                    href="{{URL::route('category',['id'=>$item->cat_id])}}">{{$item->cat_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                <ol class="breadcrumb col-md-12">
                    <li><a href="{{URL::route('index')}}">首页</a></li>
                    <li class="active">{{$cat->cat_name}}</li>
                </ol>
                @if(!$goods->isEmpty())
                    @foreach($goods as $good)
                        <div class="col-md-4">
                            <a class="img-thumbnail" href="{{URL::route('goods',['id'=>$good->goods_id])}}" style="width:100%; margin-bottom:30px;">
                                <img src="@if($good->covers) {{\App\models\GoodsImage::getImage($good->covers->thumb_url)}} @else {{asset('\data\no_picture.gif')}} @endif" alt="{{$good->goods_name}}" style="width:100%;">
                                <div class="text-center"><span>{{$good->goods_name}}</span></div>
                            </a>
                        </div>
                    @endforeach
                    <div class="row text-right">{!! with(new \Illuminate\Pagination\SimpleBootstrapThreePresenter($goods))->render() !!}</div>
                @else
                    <div class="text-center">没有数据</div>
                @endif
            </div>
        </div>
    </div>
@endsection