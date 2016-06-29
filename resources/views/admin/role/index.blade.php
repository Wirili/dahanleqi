@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">@lang('sys.home')</a></li>
        <li class="active">@lang('role.list')</li>
    </ol>
    <table id="dt" class="table table-bordered table-striped table-hover">
        <thead>
        <tr align="center">
            <th class="text-center" width="60">@lang('sys.id')</th>
            <th class="text-center">@lang('role.display_name')</th>
            <th class="text-center">@lang('role.name')</th>
            <th class="text-center">@lang('role.description')</th>
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
                    url: "{{URL::route('admin.role.ajax',['_token'=>csrf_token()])}}"
                },
                columns: [
                    {data: 'id',className:'text-center'},
                    {data: 'display_name'},
                    {data: 'name'},
                    {data: 'description'},
                    {
                        data: 'id',
                        className: 'text-center',
                        orderable: false,
                        render: function (data, type, row) {
                            data = "<a href='/admin/role/edit/" + data + "' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.edit') }}'><i class='fa fa-edit'></i></a>"
                                    + "<a href='/admin/role/del/" + data + "' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.del') }}'><i class='fa fa-remove'></i></a>";
                            return data;
                        }
                    }
                ],
                order: [[0, "desc"]]
            });
            $('#btn').append("<a class='btn btn-primary' href='{{URL::route('admin.role.create')}}'>@lang('role.add')</a>");
        });
    </script>
@endsection