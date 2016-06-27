@extends('admin.layouts.app')

@section('content')
    <div class="login-wrap">
        <div class="login-logo">后台管理系统</div>
        <div class="login-form">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}">
                {!! csrf_field() !!}
                <div class="col">
                    <input class="login-input" id="email" type="email" name="email" placeholder="管理员账号" title="管理员账号" value="{{ old('email') }}">
                    <label class="fa fa-user" for="email"></label>
                </div>
                <div class="col">
                    <input class="login-input" id="password" type="password" name="password" placeholder="管理员密码" title="管理员密码">
                    <label class="fa fa-lock" for="password"></label>
                </div>
                <div>
                    <label class="login-checkbox">
                        <input type="checkbox" name="remember"> 下次自动登录
                    </label>
                    <a href="{{ url('admin/password/reset') }}">忘记密码</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block">登 陆</button>
                </div>
                <div class="col">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </form>
        </div>
        <div class="login-tip"></div>
    </div>
    {{--<div class="container-fluid">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Login</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}">--}}
                            {{--{!! csrf_field() !!}--}}

                            {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                                {{--<label class="col-md-4 control-label">E-Mail Address</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input type="email" class="form-control" name="email" value="{{ old('email') }}">--}}

                                    {{--@if ($errors->has('email'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                {{--<label class="col-md-4 control-label">Password</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input type="password" class="form-control" name="password">--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<div class="checkbox">--}}
                                        {{--<label>--}}
                                            {{--<input type="checkbox" name="remember"> Remember Me--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--<i class="fa fa-btn fa-sign-in"></i>Login--}}
                                    {{--</button>--}}

                                    {{--<a class="btn btn-link" href="{{ url('admin/password/reset') }}">Forgot Your Password?</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
