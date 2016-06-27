@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">@lang('sys.home')</a></li>
        <li class="active">@lang('admin.list')</li>
    </ol>
    <table id="dt" class="table table-bordered table-striped table-hover">
        <thead>
        <tr align="center">
            <th class="text-center" width="60">@lang('sys.id')</th>
            <th class="text-center">@lang('admin.name')</th>
            <th class="text-center">@lang('admin.email')</th>
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
                    url: "{{URL::action('Admin\AdminController@ajax',['_token'=>csrf_token()])}}"
                },
                columns: [
                    {data: 'user_id'},
                    {data: 'name'},
                    {data: 'email'},
                    {
                        data: 'user_id',
                        className: 'text-center',
                        orderable: false,
                        render: function (data, type, row) {
                            data = "<a href='/admin/admin/edit/" + data + "' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.edit') }}'><i class='fa fa-edit'></i></a>"
                                    + "<a href='/admin/admin/del/" + data + "' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.del') }}'><i class='fa fa-remove'></i></a>";
                            return data;
                        }
                    }
                ],
                order: [[0, "desc"]]
            });
        });
    </script>
@endsection