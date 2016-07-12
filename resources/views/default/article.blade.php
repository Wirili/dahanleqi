@extends('default.layouts.layouts')

@section('content')
    <div class="container" style="margin-top:10px;">
        <div class="row">
            @if($article)
                <ol class="breadcrumb">
                    <li><a href="{{URL::route('index')}}">首页</a></li>
                    <li class="active">{{$article->title}}</li>
                </ol>
                <div class="col-md-12">
                    {!! $article->contents !!}
                </div>
            @else
                <div class="text-center">没有数据</div>
            @endif
        </div>
    </div>
@endsection