@extends('layouts.manage')

@section('title','新增活動')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('events.index') }}" class="btn btn-default" role="button">< 所有活動</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">新增活動</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/events/') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    名稱
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="group" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    組織
                </label>

                <div class="col-md-6">
                    @switch(Auth::user()->group)
                        @case('committee')
                            <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '梅竹賽籌備委員會' }}" required>
                            @break
                        @case('cheer')
                            @if(Auth::user()->school == 'NCTU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '交大梅竹後援會' }}" required>
                            @elseif(Auth::user()->school == 'NTHU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '清大梅竹工作會' }}" required>
                            @endif
                            @break
                        @case('media')
                            @if(Auth::user()->school == 'NCTU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '交大喀報' }}" required>
                            @elseif(Auth::user()->school == 'NTHU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '清華電台' }}" required>
                            @endif
                            @break
                        @case('admin')
                            <input id="group" type="text" class="form-control" name="group" value="{{ old('group') }}" required>
                            @break
                    @endswitch
                </div>
            </div>


            <div class="form-group">
                <label for="tag" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    分類
                </label>

                <div class="col-md-6">
                    <select id="tag" class="form-control" name="tag" required>
                        <option value=""></option>
                        @switch(Auth::user()->group)
                            @case('committee')
                                <option value="清大索票活動">清大索票活動</option>
                                <option value="交大索票活動">交大索票活動</option>
                                <option value="賽事相關活動">賽事相關活動</option>
                                @break
                            @case('admin')
                                <option value="交大索票活動">交大索票活動</option>
                                <option value="清大索票活動">清大索票活動</option>
                                <option value="賽事相關活動">賽事相關活動</option>
                                <option value="交大賽前活動">交大賽前活動</option>
                                <option value="清大賽前活動">清大賽前活動</option>
                                <option value="兩校賽前活動">兩校賽前活動</option>
                                @break
                            @default
                                @if(Auth::user()->school == 'NCTU')
                                    <option value="交大賽前活動">交大賽前活動</option>
                                @elseif(Auth::user()->school == 'NTHU')
                                    <option value="清大賽前活動">清大賽前活動</option>
                                @endif
                                <option value="兩校賽前活動">兩校賽前活動</option>
                                @break
                        @endswitch
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">今天 - 3/31 間</span>
                    日期
                </label>

                <div class="col-md-6">
                    <input id="date" type="date" class="form-control" name="date" value="{{ old('date')!=NULL ? old('date') : date('Y-m-d') }}" required>
                    @if ($errors->has('date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="time" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    時間
                </label>

                <div class="col-md-6">
                    <input id="time" type="time" class="form-control" name="time" value="{{ old('time') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    地點
                </label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label for="link" class="col-md-4 control-label">
                    <span class="label label-default">網址</span>
                    活動連結
                </label>

                <div class="col-md-6">
                    <input id="link" type="url" class="form-control" name="link" value="{{ old('link') }}">
                    @if ($errors->has('link'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        新增活動
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection