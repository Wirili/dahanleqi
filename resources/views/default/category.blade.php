@extends('default.layouts.layouts')

@section('content')
    @if($cat->show_img)
    <div class="container-fluid">
        <div class="row"><img src="{{$cat->show_img}}" alt="" style="width:100%;"></div>
    </div>
    @endif
    <div class="container">
        <div class="row">
            @if($goods)
                <ul>
                    @foreach($goods as $good)
                        <li>{{$good->goods_name}}</li>
                    @endforeach
                </ul>
            @else
                没有数据
            @endif
        </div>
    </div>
@endsection