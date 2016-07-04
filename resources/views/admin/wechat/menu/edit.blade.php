@extends('admin.layouts.index')

@section('content')
<ol class="breadcrumb">
    <li><a href="">@lang('sys.home')</a></li>
    <li><a href="{{URL::route('admin.wechat.menu.index')}}">@lang('wechat_menu.list')</a></li>
    <li class="active">@lang('wechat_menu.edit')</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div style="padding: 5px;">
            <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.wechat.menu.save') }}">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('sys.tab_main')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">@lang('wechat_menu.name')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="name" id="title" value="{{$menu->name}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="parent_id">@lang('wechat_menu.parent')</label>
                        <div class="col-md-4">
                            <select id="parent_id" class="form-control input-sm" name="parent_id">
                                <option value="0">@lang('wechat_menu.topcat')</option>
                                @foreach($menu_cat as $item)
                                    <option value="{{$item->menus_id}}" @if($item->menus_id==$menu->parent_id) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="type">@lang('wechat_menu.type')</label>
                        <div class="col-md-4">
                            <select id="cat_id" class="form-control input-sm" name="type">
                                    <option value="click" @if($menu->type=='click') selected @endif>click</option>
                                    <option value="view" @if($menu->type=='view') selected @endif>view</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="is_show">@lang('wechat_menu.is_show')</label>
                        <div class="col-md-4"><input class="checkbox" type="checkbox" name="is_show" id="is_show" @if($menu->is_show==1) checked @endif value="1"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="key">@lang('wechat_menu.key')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="key" id="key" value="{{$menu->key}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="url">@lang('wechat_menu.url')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="url" id="url" value="{{$menu->url}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="sort_order">@lang('sys.sort')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="sort_order" id="sort_order" value="{{$menu->sort_order}}"></div>
                    </div>
                </div>
            </div>
            <div style="margin: 10px 0 0;">
                <div class="col-md-2"></div>
                <input type="hidden" name="menus_id" value="{{$menu->menus_id}}">
                <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
            </div>
            </form>
        </div>
    </div>
</div>
@endsection