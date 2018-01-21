@extends('layouts.manage')

@section('title','變更密碼')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">變更密碼</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/changepassword') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">您的帳號</label>

                <div class="col-md-6 form-control-static">{{ $user -> email }}</div>
            </div>

            <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                <label for="oldpassword" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    舊密碼
                </label>

                <div class="col-md-6">
                    <input id="oldpassword" type="password" class="form-control" name="oldpassword" required>

                    @if ($errors->has('oldpassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('oldpassword') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">至少6字</span>
                    新密碼
                </label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    新密碼確認
                </label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        更改密碼
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
