@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">@lang('sys.home')</a></li>
        <li class="active">@lang('goods.list')</li>
    </ol>
    <table id="dt" class="table table-bordered table-striped table-hover">
        <thead>
        <tr align="center">
            <th class="text-center" width="40">@lang('sys.id')</th>
            <th class="text-center">@lang('goods.goods_name')</th>
            <th class="text-center">@lang('goods.goods_sn')</th>
            <th class="text-center" width="60">@lang('goods.shop_price')</th>
            <th class="text-center" width="40">@lang('goods.is_on_sale')</th>
            <th class="text-center" width="40">@lang('goods.is_hot')</th>
            <th class="text-center" width="40">@lang('goods.is_new')</th>
            <th class="text-center" width="40">@lang('goods.is_best')</th>
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
                    url: "{{URL::route('admin.goods.ajax',['_token'=>csrf_token()])}}"
                },
                columns: [
                    {data: 'goods_id',className:'text-center'},
                    {data: 'goods_name'},
                    {data: 'goods_sn'},
                    {
                        data: 'shop_price',
                        className: 'text-right',
                    },
                    {
                        data: 'is_on_sale',
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
                        data: 'is_hot',
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
                        data: 'is_new',
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
                        data: 'is_best',
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
                        data: 'goods_id',
                        className: 'text-center',
                        orderable: false,
                        render: function (data, type, row) {
                            data = "<a href='/admin/goods/edit/" + data + "' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.edit') }}'><i class='fa fa-edit'></i></a>"
                                    + "<a href='/admin/goods/del/" + data + "' class='text-danger' data-toggle='tooltip' data-placement='bottom' title='{{ trans('sys.del') }}'><i class='fa fa-remove'></i></a>";
                            return data;
                        }
                    }
                ],
                order: [[0, "desc"]]
            });
            $('#btn').append("<a class='btn btn-primary' href='{{URL::route('admin.goods.create')}}'>@lang('goods.add')</a>");
        });
    </script>
@endsection