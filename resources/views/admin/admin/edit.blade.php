@extends('admin.layouts.index')

@section('content')
<ol class="breadcrumb">
    <li><a href="">@lang('sys.home')</a></li>
    <li><a href="{{url('admin/admin/index')}}">@lang('admin.list')</a></li>
    <li class="active">@lang('admin.edit')</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div style="padding: 5px;">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/admin/save') }}">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('sys.tab_main')</a></li>
                <li role="presentation"><a href="#tab_permission" aria-controls="tab_permission" role="tab" data-toggle="tab">@lang('admin.tab_permission')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">@lang('admin.name')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="name" id="name" value="{{$admin->name}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="email">@lang('admin.email')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="email" id="email" value="{{$admin->email}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password">@lang('admin.password')</label>
                        <div class="col-md-4"><input type="password" class="form-control input-sm" name="password" id="password"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="password_confirm">@lang('admin.password_confirm')</label>
                        <div class="col-md-4"><input type="password" class="form-control input-sm" name="password_confirm" id="password_confirm"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">@lang('admin.roles')</label>
                        <div class="col-md-4">
                            @foreach($roles as $item)
                            <label class="checkbox-inline"><input type="checkbox" name="data[]" id="{{$item->name}}" value="{{$item->id}}" @if(isset($admin_roles[$item->id])) checked @endif>{{$item->display_name}}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_permission">
                    <div class="form-group">
                        <label class="col-md-2 control-label">@lang('role.permission')</label>
                        <div class="col-md-4">
                            <table class="table table-bordered">
                                @foreach($permission as $item)
                                    <tr data-permission="{{$item->id}}">
                                        <td style="background: #f9f9f9;"><label class="checkbox-inline"><input type="checkbox" disabled="disabled" name="data[]" data-parent="{{$item->id}}"  id="{{$item->name}}" value="{{$item->id}}" @if(isset($perms[$item->id])) checked @endif>{{$item->display_name}}</label></td>
                                        <td>
                                            @foreach($item->children as $child)
                                                <label class="checkbox-inline"><input type="checkbox" disabled="disabled" name="data[]" data-child="{{$child->id}}" id="{{$child->name}}" value="{{$child->id}}" @if(isset($perms[$child->id])) checked @endif>{{$child->display_name}}</label>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin: 10px 0 0;">
                <div class="col-md-2"></div>
                <input type="hidden" name="user_id" value="{{$admin->user_id}}">
                <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
            </div>
            </form>
        </div>
    </div>
</div>
@endsection