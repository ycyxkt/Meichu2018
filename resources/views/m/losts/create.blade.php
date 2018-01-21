@extends('layouts.manage')

@section('title','新增遺失物')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('losts.index') }}" class="btn btn-default" role="button">< 所有遺失物</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">新增遺失物</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/losts/') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">10字內</span>
                    名稱
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
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
                        <option value="清大索票活動">清大索票活動</option>
                        <option value="交大索票活動">交大索票活動</option>
                        <option value="清大賽前活動">清大賽前活動</option>
                        <option value="交大賽前活動">交大賽前活動</option>
                        <option value="兩校賽前活動">兩校賽前活動</option>
                        @foreach($games as $data)    
                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                        @endforeach
                        <option value="其他">其他</option>
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">1/1 - 今天</span>
                    拾獲日期
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
                <label for="location" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    拾獲地點
                </label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content" class="col-md-4 control-label">
                    <span class="label label-default">100字內</span>
                    描述
                </label>

                <div class="col-md-6">
                    <textarea id="content" class="form-control" name="content" rows="4">{{ old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            
            <div class="form-group{{ $errors->has('file_photo') ? ' has-error' : '' }}">
                <label for="file_photo" class="col-md-4 control-label">
                    <span class="label label-default">圖像格式</span>
                    <span class="label label-default">不大於5MB</span>
                    物品照片
                </label>

                <div class="col-md-6">
                    <input id="file_photo" type="file" class="form-control" name="file_photo">
                    @if ($errors->has('file_photo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file_photo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        新增遺失物
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection