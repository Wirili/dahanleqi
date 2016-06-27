@extends('admin.layouts.index')

@section('content')
<ol class="breadcrumb">
    <li><a href="">@lang('sys.home')</a></li>
    <li><a href="{{url('admin/article/index')}}">@lang('article.list')</a></li>
    <li class="active">@lang('article.edit')</li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div style="padding: 5px;">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/article/save') }}">
                {!! csrf_field() !!}
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">@lang('sys.tab_main')</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">@lang('article.contents')</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 8px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="title">@lang('article.title')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="title" id="title" value="{{$article->title}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="cat_id">@lang('article.cat_id')</label>
                        <div class="col-md-4">
                            <select id="cat_id" class="form-control input-sm" name="cat_id">
                                <option value="0">@lang('article.pls')</option>
                                @foreach($article_cat as $item)
                                    <option value="{{$item->cat_id}}" @if($item->cat_id==$article->cat_id) selected @endif>{{$item->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="is_open">@lang('article.is_open')</label>
                        <div class="col-md-4"><input class="checkbox" type="checkbox" name="is_open" id="is_open" @if($article->is_open==1) checked @endif value="1"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="author">@lang('article.author')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="author" id="author" value="{{$article->author}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="author_email">@lang('article.author_email')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="author_email" id="author_email" value="{{$article->author_email}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="keywords">@lang('article.keywords')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="keywords" id="keywords" value="{{$article->keywords}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="description">@lang('article.description')</label>
                        <div class="col-md-4"><textarea class="form-control input-sm" rows="3" name="description" id="description" value="{{$article->description}}"></textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="link">@lang('article.link')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="link" id="link" value="{{$article->link}}"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="file_url">@lang('article.link')</label>
                        <div class="col-md-4"><input type="text" class="form-control input-sm" name="file_url" id="file_url" value="{{$article->file_url}}"></div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="contents" style="height: 400px;" type="text/plain">{!! $article->contents !!}</script>

                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container');
                        ue.ready(function() {
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                        });
                    </script>
                </div>
            </div>
            <div style="margin: 10px 0 0;">
                <div class="col-md-2"></div>
                <input type="hidden" name="article_id" value="{{$article->article_id}}">
                <input type="submit" class="btn btn-primary" value="@lang('sys.submit')">
                <input type="reset" class="btn btn-default" value="@lang('sys.reset')">
            </div>
            </form>
        </div>
    </div>
</div>
@endsection