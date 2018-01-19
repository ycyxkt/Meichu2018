@extends('layouts.manage')

@section('title','編輯活動')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('events.index') }}" class="btn btn-default" role="button">< 所有活動</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">編輯活動</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/m/events/'.$event->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">名稱</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $event->title }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="group" class="col-md-4 control-label">組織</label>

                            <div class="col-md-6">
                                @switch(Auth::user()->group)
                                    @case('committee')
                                        <input id="group" type="text" class="form-control" name="group" value="梅竹賽籌備委員會" readonly required>
                                        @break
                                    @case('cheer')
                                        @if(Auth::user()->school == 'NCTU')
                                            <input id="group" type="text" class="form-control" name="group" value="交大梅竹後援會" readonly required>
                                        @elseif(Auth::user()->school == 'NTHU')
                                            <input id="group" type="text" class="form-control" name="group" value="清大梅竹工作會" readonly required>
                                        @endif
                                        @break
                                    @case('media')
                                        @if(Auth::user()->school == 'NCTU')
                                            <input id="group" type="text" class="form-control" name="group" value="交大喀報" readonly required>
                                        @elseif(Auth::user()->school == 'NTHU')
                                            <input id="group" type="text" class="form-control" name="group" value="清華電台" readonly required>
                                        @endif
                                        @break
                                    @case('admin')
                                        <input id="group" type="text" class="form-control" name="group" value="{{ $event->group }}" required>
                                        @break
                                @endswitch
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="tag" class="col-md-4 control-label">分類</label>

                            <div class="col-md-6">
                                <select id="tag" class="form-control" name="tag" required>
                                    <option value=""></option>
                                    @switch(Auth::user()->group)
                                        @case('committee')
                                            @if(Auth::user()->school == 'NCTU')
                                                <option value="交大索票活動" @if($event->tag == "交大索票活動") selected @endif>交大索票活動</option>
                                            @elseif(Auth::user()->school == 'NTHU')
                                                <option value="清大索票活動" @if($event->tag == "清大索票活動") selected @endif>清大索票活動</option>
                                            @endif
                                            <option value="賽事相關活動" @if($event->tag == "賽事相關活動") selected @endif>賽事相關活動</option>
                                            @break
                                        @case('admin')
                                            <option value="交大索票活動" @if($event->tag == "交大索票活動") selected @endif>交大索票活動</option>
                                            <option value="清大索票活動" @if($event->tag == "清大索票活動") selected @endif>清大索票活動</option>
                                            <option value="賽事相關活動" @if($event->tag == "賽事相關活動") selected @endif>賽事相關活動</option>
                                            <option value="交大造勢活動" @if($event->tag == "交大造勢活動") selected @endif>交大造勢活動</option>
                                            <option value="清大造勢活動" @if($event->tag == "清大造勢活動") selected @endif>清大造勢活動</option>
                                            <option value="兩校造勢活動" @if($event->tag == "兩校造勢活動") selected @endif>兩校造勢活動</option>
                                            @break
                                        @default
                                            @if(Auth::user()->school == 'NCTU')
                                                <option value="交大造勢活動" @if($event->tag == "交大造勢活動") selected @endif>交大造勢活動</option>
                                            @elseif(Auth::user()->school == 'NTHU')
                                                <option value="清大造勢活動" @if($event->tag == "清大造勢活動") selected @endif>清大造勢活動</option>
                                            @endif
                                            <option value="兩校造勢活動" @if($event->tag == "兩校造勢活動") selected @endif>兩校造勢活動</option>
                                            @break
                                    @endswitch
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">日期</label>

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
                            <label for="time" class="col-md-4 control-label">時間</label>

                            <div class="col-md-6">
                                <input id="time" type="time" class="form-control" name="time" value="{{ $event->time }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">地點</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ $event->location }}" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">連結</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="link" value="{{ $event->link }}">
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
                                    編輯活動
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection