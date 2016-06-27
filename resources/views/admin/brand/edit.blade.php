@extends('admin.layouts.index')

@section('content')
<ol class="breadcrumb">
    <li><a href="">{{trans('sys.home')}}</a></li>
    <li><a href="{{url('admin/brand/index')}}">{{trans('brand.list')}}</a></li>
    <li class="active">{{trans('brand.edit')}}</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div style="padding: 5px;">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/brand/save') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_main" aria-controls="tab_main" role="tab" data-toggle="tab">{{trans('brand.tab_main')}}</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                <div role="tabpanel" class="tab-pane active" id="tab_main">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="brand_name">{{trans('brand.brand_name')}}</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="brand_name" id="brand_name" value="{{$brand->brand_name}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="is_show">{{trans('brand.is_show')}}</label>
                        <div class="col-md-4"><input class="checkbox" type="checkbox" name="is_show" id="is_show" @if($brand->is_show==1) checked @endif value="1"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="brand_logo_img">{{trans('brand.brand_logo')}}</label>
                        <div class="col-md-3"><input type="file" class="input-sm" name="brand_logo_img" id="brand_logo_img"></div>
                        @if($brand->brand_logo)
                        <div class="col-md-1"><i class="fa fa-picture-o fa-lg input-sm" data-toggle="popover" data-trigger="hover" data-content='<img src="{{$brand->brand_logo}}" width="500">'></i></div>
                        <script>
                            $('[data-toggle="popover"]').popover({html:true});
                        </script>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="sort_order">{{trans('sys.sort')}}</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="sort_order" id="sort_order" value="{{$brand->sort_order}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="site_url">{{trans('brand.site_url')}}</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="site_url" id="site_url" value="{{$brand->site_url}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="brand_desc">{{trans('brand.brand_desc')}}</label>
                        <div class="col-md-4"><textarea rows="3" class="form-control input-sm" name="brand_desc" id="brand_desc" >{{$brand->brand_desc}}</textarea></div>
                    </div>
                </div>
            </div>
            <div style="margin: 10px 0 0;">
                <div class="col-md-2"></div>
                <input type="hidden" name="brand_id" value="{{$brand->brand_id}}">
                <input type="submit" class="btn btn-primary" value="{{trans('sys.submit')}}">
                <input type="reset" class="btn btn-default" value="{{trans('sys.reset')}}">
            </div>
            </form>
        </div>
    </div>
</div>
@endsection