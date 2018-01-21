@extends('layouts.manage')

@section('title','編輯使用者')

@section('content')
<div class="row">
    <div class="col-md-6">
        <a href="{{ route('users.index') }}" class="btn btn-default" role="button">< 所有使用者</a>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">編輯使用者</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/users/'.$user->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    帳號
                </label>

                <div class="col-md-6">
                    <input id="email" type="account" class="form-control" name="email" value="{{ $user->email }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">
                    <span class="label label-default">至少6字</span>
                    密碼
                </label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">
                    密碼確認
                </label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    姓名
                </label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>

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
                        <option value ="NTHU" @if($user->school == 'NTHU') selected @endif>國立清華大學</option>
                        <option value ="NCTU" @if($user->school == 'NCTU') selected @endif>國立交通大學</option>
                        <option value="other" @if($user->school == 'other') selected @endif>其他</option>
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
                        <option value ="committee" @if($user->group == 'committee') selected @endif>梅竹賽籌備委員會</option>
                        <option value="cheer" @if($user->group == 'cheer') selected @endif>後援組織（梅工、梅後）</option>
                        <option value ="media" @if($user->group == 'media') selected @endif>媒體（電台、喀報等）</option>
                        <option value="admin" @if($user->group == 'admin') selected @endif>管理員</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="note" class="col-md-4 control-label">
                    備註
                </label>

                <div class="col-md-6">
                    <input id="note" type="text" class="form-control" name="note" value="{{ $user->note }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        更新資訊
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection