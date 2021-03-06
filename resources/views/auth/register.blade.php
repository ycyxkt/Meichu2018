@extends('layouts.manage')

@section('title','建立帳號')

@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('users.index') }}" class="btn btn-default" role="button">< 所有使用者</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">建立帳號</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    帳號
                </label>

                <div class="col-md-6">
                    <input id="email" type="account" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">至少6字</span>
                    密碼
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
                    密碼確認
                </label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    姓名
                </label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="school" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    學校
                </label>

                <div class="col-md-6">
                    <select id="school" class="form-control" name="school" required>
                        <option value ="NTHU">國立清華大學</option>
                        <option value ="NCTU">國立交通大學</option>
                        <option value="other">其他</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="group" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    身分
                </label>

                <div class="col-md-6">
                    <select id="group" class="form-control" name="group" required>
                        <option value ="committee">梅竹賽籌備委員會</option>
                        <option value="cheer">後援組織（梅工、梅後）</option>
                        <option value ="media">媒體（電台、喀報等）</option>
                        <option value="admin">管理員</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="note" class="col-md-4 control-label">備註</label>

                <div class="col-md-6">
                    <input id="note" type="text" class="form-control" name="note" value="{{ old('note') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        建立帳號
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
