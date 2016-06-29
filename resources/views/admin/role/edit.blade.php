@extends('admin.layouts.index')

@section('content')
<ol class="breadcrumb">
    <li><a href="">@lang('sys.home')</a></li>
    <li><a href="{{URL::route('admin.role.index')}}">@lang('role.list')</a></li>
    <li class="active">@lang('role.edit')</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div style="padding: 5px;">
            <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.role.save') }}">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('sys.tab_main')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="display_name">@lang('role.display_name')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="display_name" id="display_name" value="{{$role->display_name}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="name">@lang('role.name')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="name" id="name" value="{{$role->name}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('role.description')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="description" id="description" value="{{$role->description}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">@lang('role.permission')</label>
                        <div class="col-md-4">
                            <div class="checkbox"><label style="margin:0 0 7px 10px ;"><input id="select_all" type="checkbox">全选</label></div>
                            <table class="table table-bordered">
                                @foreach($permission as $item)
                                <tr>
                                    <td style="background: #f9f9f9;"><label class="checkbox-inline"><input type="checkbox" name="data[]" id="{{$item->name}}" value="{{$item->id}}" @if(isset($perms[$item->id])) checked @endif>{{$item->display_name}}</label></td>
                                    <td>
                                        @foreach($item->children as $child)
                                            <label class="checkbox-inline"><input type="checkbox" name="data[]" id="{{$child->name}}" value="{{$child->id}}" @if(isset($perms[$child->id])) checked @endif>{{$child->display_name}}</label>
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
                <input type="hidden" name="id" value="{{$role->id}}">
                <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#select_all').on('click',function(){
        if(this.checked==true)
            $("input[name='data[]']").each(function(){
                debugger;
                $(this).attr('checked','true');
            })
        else
            $("input[name='data[]']").each(function(){
                $(this).removeAttr('checked');
            })
    });
</script>
@endsection