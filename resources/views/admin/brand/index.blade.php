@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">{{trans('sys.home')}}</a></li>
        <li class="active">{{trans('article.list')}}</li>
    </ol>
    <table id="dt" class="table table-bordered table-striped table-hover">
        <thead>
        <tr align="center">
            <th class="text-center" width="60">{{trans('sys.id')}}</th>
            <th class="text-center">{{trans('brand.brand_name')}}</th>
            <th class="text-center" width="60">{{trans('brand.is_show')}}</th>
            <th class="text-center" width="60">{{trans('sys.sort')}}</th>
            <th class="text-center" width="100">{{trans('sys.handle')}}</th>
        </tr>
        </thead>
    </table>
    <script>
        $(function () {
            var table = $('#dt').on('draw.dt',function(e, settings){
                $('[data-toggle="tooltip"]').tooltip();
            })
            .DataTable({
                dom:"<'row'<'col-sm-6'l><'#btn.col-sm-6'>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
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
                    url: "{{URL::action('Admin\BrandController@ajax',['_token'=>csrf_token()])}}"
                },
                columns: [
                    {data: 'brand_id'},
                    {data: 'brand_name'},
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
                    {
                        data: 'sort_order',
                        className:'text-center'
                    },
                    {
                        data: 'brand_id',
                        className: 'text-center',
                        orderable: false,
                        render: function (data, type, row) {
                            data = "<a href='/admin/brand/edit/" + data + "' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.edit') }}'><i class='fa fa-edit'></i></a>"
                                    + "<a href='/admin/brand/del/" + data + "' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.del') }}'><i class='fa fa-remove'></i></a>";
                            return data;
                        }
                    }
                ],
                order: [[0, "desc"]]
            });
            $('#btn').append("<a class='btn btn-primary pull-right' href='{{URL::route('admin.brand.create')}}'>@lang('brand.add')</a>");
        });
    </script>
@endsection