@extends('layouts.manage')

@section('title','編輯使用者')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">編輯使用者</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/m/users/'.$user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">帳號</label>

                            <div class="col-md-6">
                                <input id="email" type="account" class="form-control" name="email" value="{{ $user->email }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密碼</label>

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
                            <label for="password-confirm" class="col-md-4 control-label">確認密碼</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">姓名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
                            <label for="school" class="col-md-4 control-label">學校</label>

                            <div class="col-md-6">
                                <select id="school" class="form-control" name="school" required>
                                    <option value ="NTHU">國立清華大學</option>
                                    <option value ="NCTU">國立交通大學</option>
                                    <option value="other">其他</option>
                                </select>
                                @if ($errors->has('school'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                            <label for="group" class="col-md-4 control-label">身分</label>

                            <div class="col-md-6">
                                <select id="group" class="form-control" name="group" required>
                                    <option value ="committee">梅竹賽籌備委員會</option>
                                    <option value="cheer">後援組織（梅工、梅後）</option>
                                    <option value ="media">媒體（電台、喀報等）</option>
                                    <option value="admin">管理員</option>
                                </select>
                                @if ($errors->has('group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">備註</label>

                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control" name="note" value="{{ $user->note }}">

                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
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
        </div>
    </div>
</div>

<script>
$('#school')
     .removeAttr('selected')
     .filter('[value={{ $user->school }}]')
         .attr('selected', true)
$('#group')
     .removeAttr('selected')
     .filter('[value={{ $user->group }}]')
         .attr('selected', true)
</script>
@endsection