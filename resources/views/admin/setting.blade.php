@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">@lang('sys.home')</a></li>
        <li class="active">@lang('sys.sys_setting')</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-body">
            <div style="padding: 5px;">
                <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.brand.save') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_main" aria-controls="tab_main" role="tab" data-toggle="tab">{{trans('brand.tab_main')}}</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" style="margin-top: 8px;">

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