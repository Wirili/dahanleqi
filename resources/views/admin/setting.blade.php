@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">@lang('sys.home')</a></li>
        <li class="active">@lang('sys.sys_setting')</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-body">
            <div style="padding: 5px;">
                <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.post_setting') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($config as $item)
                        <li role="presentation" @if($item->code=='info')class="active"@endif><a href="#{{$item->code}}" aria-controls="{{$item->code}}" role="tab" data-toggle="tab">@lang('config.'.$item->code)</a></li>
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" style="margin-top: 8px;">
                        @foreach($config as $item)
                        <div role="tabpanel" class="tab-pane @if($item->code=='info') active @endif" id="{{$item->code}}">
                            @foreach($item->children as $child)
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="{{$child->id}}">@lang('config.'.$child->code)</label>
                                    <div class="col-md-4">
                                        @if($child->type=='text')
                                            <input class="form-control input-sm" id="{{$child->id}}" name="data[{{$child->id}}]" type="text" value="{{$child->value}}">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    <div style="margin: 10px 0 0;">
                        <div class="col-md-2"></div>
                        <input type="hidden" name="brand_id" value="">
                        <input type="submit" class="btn btn-primary" value="{{trans('sys.submit')}}">
                        <input type="reset" class="btn btn-default" value="{{trans('sys.reset')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection