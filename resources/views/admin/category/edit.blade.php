@extends('admin.layouts.index')

@section('content')
<ol class="breadcrumb">
    <li><a href="">@lang('sys.home')</a></li>
    <li><a href="{{url('admin/category/index')}}">@lang('category.list')</a></li>
    <li class="active">@lang('category.edit')</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/category/save') }}"  enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cat_name">@lang('category.cat_name')</label>
                    <div class="col-md-4"><input type="text" class="form-control input-sm" name="cat_name" id="cat_name" value="{{$cat->cat_name}}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="parent_id">@lang('category.parent')</label>
                    <div class="col-md-4">
                        <select id="parent_id" class="form-control input-sm" name="parent_id">
                            <option value="0">@lang('category.topcat')</option>
                            @foreach($goods_cat as $item)
                                <option value="{{$item->cat_id}}" @if($item->cat_id==$cat->parent_id) selected @endif>{{$item->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="show_img_upload">{{trans('category.show_img')}}</label>
                    <div class="col-md-3"><input type="file" class="input-sm" name="show_img_upload" id="show_img_upload"></div>
                    @if($cat->show_img)
                        <div class="col-md-1"><i class="fa fa-picture-o fa-lg input-sm" data-toggle="popover" data-trigger="hover" data-content='<img src="{{$cat->show_img}}" width="500">'></i></div>
                        <script>
                            $('[data-toggle="popover"]').popover({html:true});
                        </script>
                    @endif
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="is_show">@lang('category.is_show')</label>
                    <div class="col-md-4"><input class="checkbox" type="checkbox" name="is_show" id="is_show" @if($cat->is_show==1) checked @endif value="1"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="show_in_nav">@lang('category.show_in_nav')</label>
                    <div class="col-md-4"><input class="checkbox" type="checkbox" name="show_in_nav" id="show_in_nav" @if($cat->show_in_nav==1) checked @endif value="1"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="sort_order">@lang('sys.sort')</label>
                    <div class="col-md-4"><input type="text" class="form-control input-sm" name="sort_order" id="sort_order" value="{{$cat->sort_order}}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="keywords">@lang('category.keywords')</label>
                    <div class="col-md-4"><input type="text" class="form-control input-sm" name="keywords" id="keywords" value="{{$cat->keywords}}"></div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="cat_desc">@lang('category.cat_desc')</label>
                    <div class="col-md-4"><textarea class="form-control input-sm" rows="3" name="cat_desc" id="cat_desc">{{$cat->cat_desc}}</textarea></div>
                </div>
                <div>
                    <div class="col-md-2"></div>
                    <input type="hidden" name="cat_id" value="{{$cat->cat_id}}">
                    <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                    <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection