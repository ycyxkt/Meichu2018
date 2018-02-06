@extends('layouts.manage')

@section('title','編輯活動')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('events.index') }}" class="btn btn-default" role="button">< 所有活動</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">編輯活動</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/events/'.$event->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="title" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    名稱
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $event->title }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="group" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    組織
                </label>

                <div class="col-md-6">
                    <input id="group" type="text" class="form-control" name="group" value="{{ $event->group }}" required>
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
                                <option value="清大索票活動" @if($event->tag == "清大索票活動") selected @endif>清大索票活動</option>
                                <option value="交大索票活動" @if($event->tag == "交大索票活動") selected @endif>交大索票活動</option>
                                <option value="賽事相關活動" @if($event->tag == "賽事相關活動") selected @endif>賽事相關活動</option>
                                @break
                            @case('admin')
                                <option value="交大索票活動" @if($event->tag == "交大索票活動") selected @endif>交大索票活動</option>
                                <option value="清大索票活動" @if($event->tag == "清大索票活動") selected @endif>清大索票活動</option>
                                <option value="賽事相關活動" @if($event->tag == "賽事相關活動") selected @endif>賽事相關活動</option>
                                <option value="交大賽前活動" @if($event->tag == "交大賽前活動") selected @endif>交大賽前活動</option>
                                <option value="清大賽前活動" @if($event->tag == "清大賽前活動") selected @endif>清大賽前活動</option>
                                <option value="兩校賽前活動" @if($event->tag == "兩校賽前活動") selected @endif>兩校賽前活動</option>
                                @break
                            @default
                                @if(Auth::user()->school == 'NCTU')
                                    <option value="交大賽前活動" @if($event->tag == "交大賽前活動") selected @endif>交大賽前活動</option>
                                @elseif(Auth::user()->school == 'NTHU')
                                    <option value="清大賽前活動" @if($event->tag == "清大賽前活動") selected @endif>清大賽前活動</option>
                                @endif
                                <option value="兩校賽前活動" @if($event->tag == "兩校賽前活動") selected @endif>兩校賽前活動</option>
                                @break
                        @endswitch
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">1/1 - 3/31 間</span>
                    日期
                </label>

                <div class="col-md-6">
                    <input id="date" type="date" class="form-control" name="date" value="{{ $event->date }}" required>
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
                    <input id="time" type="time" class="form-control" name="time" value="{{ $event->time }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    地點
                </label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control" name="location" value="{{ $event->location }}" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label for="link" class="col-md-4 control-label">
                    <span class="label label-default">網址</span>
                    活動連結
                </label>

                <div class="col-md-6">
                    <input id="link" type="url" class="form-control" name="link" value="{{ $event->link }}">
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
                        更新資訊
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection