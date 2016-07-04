@extends('admin.layouts.index')

@section('content')
<ol class="breadcrumb">
    <li><a href="">@lang('sys.home')</a></li>
    <li><a href="{{URL::route('admin.goods.index')}}">@lang('goods.list')</a></li>
    <li class="active">@lang('goods.edit')</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div style="padding: 5px;">
            <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin.goods.save') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_main" aria-controls="tab_main" role="tab" data-toggle="tab">@lang('sys.tab_main')</a></li>
                <li role="presentation"><a href="#tab_desc" aria-controls="tab_desc" role="tab" data-toggle="tab">@lang('goods.tab_desc')</a></li>
                <li role="presentation"><a href="#tab_other" aria-controls="tab_other" role="tab" data-toggle="tab">@lang('goods.tab_other')</a></li>
                <li role="presentation"><a href="#tab_gallery" aria-controls="tab_gallery" role="tab" data-toggle="tab">@lang('goods.tab_gallery')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top:8px;">
                <div role="tabpanel" class="tab-pane active" id="tab_main">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="goods_name">@lang('goods.goods_name')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="goods_name" id="goods_name" value="{{$goods->goods_name}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="goods_sn">@lang('goods.goods_sn')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="goods_sn" id="goods_sn" value="{{$goods->goods_sn}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="cat_id">@lang('goods.cat_id')</label>
                        <div class="col-md-4">
                            <select id="cat_id" class="form-control input-sm" name="cat_id">
                                <option value="0">@lang('goods.pls')@lang('goods.cat_id')</option>
                                @foreach($goods_cat as $item)
                                    <option value="{{$item->cat_id}}" @if($item->cat_id==$goods->cat_id) selected @endif>{{$item->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="brand_id">@lang('goods.brand_id')</label>
                        <div class="col-md-4">
                            <select id="cat_id" class="form-control input-sm" name="brand_id">
                                <option value="0">@lang('goods.pls')@lang('goods.brand_id')</option>
                                @foreach($brands as $item)
                                    <option value="{{$item->brand_id}}" @if($item->brand_id==$goods->brand_id) selected @endif>{{$item->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="shop_price">@lang('goods.shop_price')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="shop_price" id="shop_price" value="{{$goods->shop_price}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="market_price">@lang('goods.market_price')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="market_price" id="market_price" value="{{$goods->market_price}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">@lang('goods.is_on_sale')</label>
                        <div class="col-md-4">
                            <label class="checkbox-inline"><input type="checkbox" name="is_on_sale" id="is_on_sale" @if($goods->is_on_sale==1) checked @endif value="1">@lang('goods.is_on_sale')</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">@lang('goods.recommend')</label>
                        <div class="col-md-4">
                            <label class="checkbox-inline"><input type="checkbox" name="is_hot" id="is_hot" @if($goods->is_hot==1) checked @endif value="1">@lang('goods.is_hot')&nbsp;</label>
                            <label class="checkbox-inline"><input type="checkbox" name="is_new" id="is_new" @if($goods->is_new==1) checked @endif value="1">@lang('goods.is_new')&nbsp;</label>
                            <label class="checkbox-inline"><input type="checkbox" name="is_best" id="is_best" @if($goods->is_best==1) checked @endif value="1">@lang('goods.is_best')</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="sort_order">@lang('sys.sort')</label>
                        <div class="col-md-2"><input type="text" class="form-control input-sm" name="sort_order" id="sort_order" value="{{$goods->sort_order}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="click_count">@lang('sys.click_count')</label>
                        <div class="col-md-2"><input type="text" class="form-control input-sm" name="click_count" id="click_count" value="{{$goods->click_count}}"></div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_desc">
                    <!-- 加载编辑器的容器 -->
                    <script id="goods_desc" name="goods_desc" style="height: 400px; padding: 8px 0;" type="text/plain">{!! $goods->goods_desc !!}</script>

                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('goods_desc');
                        ue.ready(function() {
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                        });
                    </script>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_other">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="keywords">@lang('goods.keywords')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="keywords" id="keywords" value="{{$goods->keywords}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('goods.goods_desc_short')</label>
                        <div class="col-md-4"><textarea class="form-control input-sm" rows="3" name="goods_desc_short" id="goods_desc_short" value="{{$goods->goods_desc_short}}"></textarea></div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_gallery">
                    <div class="row">
                    @foreach($goods->images as $item)
                        <div class="file-preview-frame" data-imgid="{{$item->img_id}}">
                            <div class="kv-file-content">
                                <img src="{{$item->thumb_url}}" alt="{{$item->img_desc}}" style="width:auto;height:160px;">
                            </div>
                            <div class="file-thumbnail-footer">
                                <div class="file-actions">
                                    <div class="file-footer-buttons">
                                        <button type="button" class="file-remove btn btn-xs btn-default" title="删除文件"><i class="glyphicon glyphicon-trash text-danger"></i></button>
                                        <button type="button" class="file-covers btn btn-xs btn-default" title="设置封面"><i class="glyphicon glyphicon-bookmark @if($goods->img_id==$item->img_id) text-primary @endif"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <input id="img_id" type="hidden" name="img_id" value="{{$goods->img_id}}">
                        <input id="img_id_del" type="hidden" name="img_id_del" value="">
                    </div>
                    <div class="row">
                        <label class="control-label">选择图片</label>
                        <input id="input-4" name="input4[]" type="file" multiple class="file-loading">
                        <script>
                            $(document).on('ready', function() {
                                $("#input-4").fileinput({
                                    language:'zh',
                                    showCaption: false,
                                    showUpload:false,
                                    {{--uploadAsync:false,--}}
                                    {{--uploadExtraData:{_token:'{{csrf_token()}}',goods_id:'{{$goods->goods_id}}'},--}}
                                    {{--uploadUrl:'{{URL::route('admin.goods.ajax_img')}}'--}}
                                });
                                $("div[data-imgid]").on('click','.file-covers',function(btn){
                                    $("div[data-imgid] .file-covers i").each(function(e){
                                        $(this).removeClass('text-primary');
                                    });
                                    $(this).find('i').addClass('text-primary');
                                    debugger;
                                    $('#img_id').val($(btn.delegateTarget).data('imgid'));
                                });

                                $("div[data-imgid]").on('click','.file-remove',function(btn){
                                    debugger;
                                    var del=$('#img_id_del').val();
                                    $.trim(del)==''?del=[]:del=del.split(',');
                                    del.push($(btn.delegateTarget).data('imgid'));
                                    $('#img_id_del').val(del.toString());
                                    $(btn.delegateTarget).remove();
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div style="margin: 10px 0 0;">
                <div class="col-md-2"></div>
                <input type="hidden" name="goods_id" value="{{$goods->goods_id}}">
                <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
            </div>
            </form>
        </div>
    </div>
</div>
@endsection