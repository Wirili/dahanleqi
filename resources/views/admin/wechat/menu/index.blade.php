@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">@lang('sys.home')</a></li>
        <li class="active">@lang('wechat_menu.list')</li>
    </ol>
    <table id="dt" class="table table-bordered table-striped table-hover">
        <thead>
        <tr align="center">
            <th class="text-center" width="60">@lang('sys.id')</th>
            <th class="text-center">@lang('wechat_menu.name')</th>
            <th class="text-center">@lang('wechat_menu.type')</th>
            <th class="text-center" width="60">@lang('wechat_menu.is_show')</th>
            <th class="text-center" width="100">@lang('sys.create_time')</th>
            <th class="text-center" width="100">@lang('sys.handle')</th>
        </tr>
        </thead>
    </table>
    <script>
        $(function () {
            var table = $('#dt').on('draw.dt',function(e, settings){
                $('[data-toggle="tooltip"]').tooltip();
            })
            .DataTable({
                dom:"<'row'<'col-sm-6'l><'col-sm-6'<'#btn'>>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                pagingType: "full_numbers",
                pageLength: 10,
                autoWidth: false,
                processing: true,
                serverSide: true,
                lengthChange: true,
                searching: false,
                stateSave: true,
                ajax: {
                    type:'POST',
                    url: "{{URL::route('admin.wechat.menu.ajax',['_token'=>csrf_token()])}}"
                },
                columns: [
                    {data: 'menus_id',className:'text-center'},
                    {data: 'name'},
                    { data: 'type'},
                    {
                        data: 'is_show',
                        className: 'text-center',
                        render:function(data,type,row){
                            if(data==1){
                                data="<i class='fa fa-check text-success'></i>";
                            }else{
                                data="<i class='fa fa-remove text-danger'></i>"
                            }
                            return data;
                        }
                    },
                    {data: 'created_at'},
                    {
                        data: 'menus_id',
                        className: 'text-center',
                        orderable: false,
                        render: function (data, type, row) {
                            data = "<a href='/admin/wechat/menu/edit/" + data + "' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.edit') }}'><i class='fa fa-edit'></i></a>"
                                    + "<a href='/admin/wechat/menu/del/" + data + "' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.del') }}'><i class='fa fa-remove'></i></a>";
                            return data;
                        }
                    }
                ],
                order: [[0, "desc"]]
            });
            $('#btn').append("<a class='btn btn-primary' href='{{URL::route('admin.wechat.menu.upload')}}'>@lang('wechat_menu.upload')</a> <a class='btn btn-primary' href='{{URL::route('admin.wechat.menu.create')}}'>@lang('wechat_menu.add')</a>");
        });
    </script>
@endsection