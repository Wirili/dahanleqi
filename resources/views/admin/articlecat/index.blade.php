@extends('admin.layouts.index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">@lang('sys.home')</a></li>
        <li class="active">@lang('article.cat.list')</li>
    </ol>
    <div class="pull-right mb5">
        <a class="btn btn-primary" href="{{url('admin/article_cat/create')}}">@lang('article.cat.add')</a>
    </div>
    <table id="dt" class="table table-bordered table-striped table-hover">
        <thead>
        <tr align="center">
            <th class="text-center">@lang('article.cat.name')</th>
            <th class="text-center">@lang('article.cat.desc')</th>
            <th class="text-center">@lang('sys.sort')</th>
            <th class="text-center" width="100">@lang('sys.handle')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cat_list as $item)
        <tr align="center" class="{{$item['level']}} treechange">
        <td class="text-left"><i class="fa fa-minus-square-o" style="margin-left: {{intval($item['level'])*10}}px"></i>{{$item['cat_name']}}</td>
        <td>{{$item['cat_desc']}}</td>
        <td>{{$item['sort_order']}}</td>
        <td>
        <a data-toggle="tooltip" data-placement="bottom" title="@lang('sys.edit')" href="{{url('admin/article_cat/edit',['id'=>$item['cat_id']])}}"><i class="fa fa-edit"></i></a>
        <a class="text-danger" data-toggle="tooltip" data-placement="bottom" title="@lang('sys.del')" href="{{url('admin/article_cat/del',['id'=>$item['cat_id']])}}"><i class="fa fa-remove"></i></a>
        </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $(function(){
           $('.treechange').on('click','.fa-minus-square-o',function(a){
               var lvl=parseInt(a.delegateTarget.className);
               $.each($(a.delegateTarget).nextAll(),function(){
                   if(parseInt(this.className)>lvl) {
                       $(this).hide();
                   }else{
                       return false;
                   }
               });
               $(this).removeClass('fa-minus-square-o');
               $(this).addClass('fa-plus-square-o');
           });
           $('.treechange').on('click','.fa-plus-square-o',function(a,b,c){
               var lvl=parseInt(a.delegateTarget.className);
               $.each($(a.delegateTarget).nextAll(),function(){
                   if(parseInt(this.className)>lvl) {
                       $(this).show();
                       var me1=$(this).children('td:eq(0)').children('i');
                       if(me1.hasClass('fa-plus-square-o')){
                           me1.addClass('fa-minus-square-o');
                           me1.removeClass('fa-plus-square-o');
                       }
                   }else {
                       return false;
                   }
               });
               $(this).addClass('fa-minus-square-o');
               $(this).removeClass('fa-plus-square-o');
           });
        });
    </script>
@endsection